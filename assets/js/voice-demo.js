/**
 * Voice Demo Widget
 * Interactive voice agent demo with WebSocket connection
 */

(function() {
    'use strict';

    // Provider configurations
    const PROVIDERS = [
        {
            id: 'openai',
            name: 'OpenAI',
            description: 'GPT-4o Realtime'
        },
        {
            id: 'xai',
            name: 'xAI',
            description: 'Grok Voice'
        }
    ];

    // Agent configurations
    const AGENTS = [
        {
            id: 'tpv',
            name: 'VERIFICATION',
            description: 'Third-party verification calls'
        },
        {
            id: 'fitness',
            name: 'FITNESS',
            description: 'Gym & fitness center support'
        },
        {
            id: 'home-services',
            name: 'HOME SERVICES',
            description: 'Contractor booking & scheduling'
        },
        {
            id: 'contact-center',
            name: 'CONTACT CENTER',
            description: 'General customer support'
        }
    ];

    // Default config display values per provider
    const DEFAULT_CONFIGS = {
        openai: {
            vad: 'Silero',
            stt: 'Whisper',
            sttModel: 'large-v3',
            llm: 'OpenAI',
            llmModel: 'GPT-4o-realtime',
            tts: 'OpenAI',
            ttsModel: 'realtime'
        },
        xai: {
            vad: 'Server VAD',
            stt: 'xAI',
            sttModel: 'grok',
            llm: 'xAI',
            llmModel: 'grok-2',
            tts: 'xAI',
            ttsModel: 'grok-voice'
        }
    };

    class VoiceDemo {
        constructor() {
            this.overlay = null;
            this.status = 'idle'; // idle, connecting, connected, error
            this.agentState = 'idle'; // idle, listening, thinking, speaking
            this.selectedAgent = 'fitness';
            this.selectedProvider = 'openai'; // 'openai' or 'xai'
            this.transcript = [];
            this.isMuted = false;
            this.error = null;

            // WebSocket
            this.ws = null;
            this.sessionId = null;

            // Audio
            this.audioContext = null;
            this.mediaStream = null;
            this.workletNode = null;
            this.audioQueue = [];
            this.isPlaying = false;
            this.audioLevel = 0;

            // Visualizer
            this.canvas = null;
            this.ctx = null;
            this.animationFrame = null;
            this.orbOffset = 0;
            this.smoothLevel = 0;

            // Latency tracking
            this.latency = {
                stt: null,
                llm: null,
                tts: null
            };

            // Config from WordPress
            this.config = window.voiceDemoConfig || {
                wsEndpoint: 'wss://app.automatdo.com/browser-voice-agent'
            };

            this.init();
        }

        init() {
            this.createModal();
            this.bindEvents();
        }

        createModal() {
            // Create overlay
            this.overlay = document.createElement('div');
            this.overlay.className = 'voice-demo-overlay';
            this.overlay.setAttribute('data-status', 'idle');
            this.overlay.innerHTML = this.getModalHTML();
            document.body.appendChild(this.overlay);

            // Cache DOM references
            this.modal = this.overlay.querySelector('.voice-demo-modal');
            this.canvas = this.overlay.querySelector('.voice-demo-orb');
            this.ctx = this.canvas.getContext('2d');
            this.statusEl = this.overlay.querySelector('.voice-demo-status');
            this.transcriptScroll = this.overlay.querySelector('.voice-demo-transcript-scroll');
        }

        getModalHTML() {
            const config = DEFAULT_CONFIGS[this.selectedProvider];
            return `
                <div class="voice-demo-modal">
                    <button class="voice-demo-close" aria-label="Close demo">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 6L6 18M6 6l12 12"/>
                        </svg>
                    </button>

                    <div class="voice-demo-header">
                        <div class="voice-demo-provider-toggle">
                            ${PROVIDERS.map(provider => `
                                <button class="voice-demo-provider ${provider.id === this.selectedProvider ? 'active' : ''}"
                                        data-provider="${provider.id}">
                                    <span class="voice-demo-provider-name">${provider.name}</span>
                                    <span class="voice-demo-provider-desc">${provider.description}</span>
                                </button>
                            `).join('')}
                        </div>
                    </div>

                    <div class="voice-demo-tabs">
                        ${AGENTS.map(agent => `
                            <button class="voice-demo-tab ${agent.id === this.selectedAgent ? 'active' : ''}"
                                    data-agent="${agent.id}">
                                <span class="voice-demo-tab-name">${agent.name}</span>
                                <span class="voice-demo-tab-desc">${agent.description}</span>
                            </button>
                        `).join('')}
                    </div>

                    <div class="voice-demo-content">
                        <div class="voice-demo-visualizer">
                            <div class="voice-demo-orb-container">
                                <canvas class="voice-demo-orb" width="440" height="440"></canvas>
                            </div>

                            <div class="voice-demo-status" data-state="idle">
                                <span class="voice-demo-status-dot"></span>
                                <span class="voice-demo-status-text">Ready to start</span>
                            </div>

                            <div class="voice-demo-controls">
                                <button class="voice-demo-start">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                                        <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                                        <line x1="12" y1="19" x2="12" y2="23"/>
                                        <line x1="8" y1="23" x2="16" y2="23"/>
                                    </svg>
                                    <span>Start Conversation</span>
                                </button>

                                <div class="voice-demo-btn-group">
                                    <button class="voice-demo-mic" aria-label="Toggle microphone">
                                        <svg class="mic-on" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                                            <line x1="12" y1="19" x2="12" y2="23"/>
                                            <line x1="8" y1="23" x2="16" y2="23"/>
                                        </svg>
                                        <svg class="mic-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none">
                                            <line x1="1" y1="1" x2="23" y2="23"/>
                                            <path d="M9 9v3a3 3 0 0 0 5.12 2.12M15 9.34V4a3 3 0 0 0-5.94-.6"/>
                                            <path d="M17 16.95A7 7 0 0 1 5 12v-2m14 0v2a7 7 0 0 1-.11 1.23"/>
                                            <line x1="12" y1="19" x2="12" y2="23"/>
                                            <line x1="8" y1="23" x2="16" y2="23"/>
                                        </svg>
                                    </button>
                                    <button class="voice-demo-end" aria-label="End call">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72"/>
                                            <line x1="1" y1="1" x2="23" y2="23"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="voice-demo-error"></div>
                        </div>

                        <div class="voice-demo-panel">
                            <div class="voice-demo-config">
                                <div class="voice-demo-panel-header">Agent Configuration</div>
                                <div class="voice-demo-config-row">
                                    <span class="voice-demo-config-label">VAD</span>
                                    <span class="voice-demo-config-value" data-config="vad">${config.vad}</span>
                                </div>
                                <div class="voice-demo-config-row">
                                    <span class="voice-demo-config-label">Speech-to-text</span>
                                    <span class="voice-demo-config-value" data-config="stt">${config.stt}</span>
                                </div>
                                <div class="voice-demo-config-row">
                                    <span class="voice-demo-config-label indent">model</span>
                                    <span class="voice-demo-config-value" data-config="sttModel">${config.sttModel}</span>
                                </div>
                                <div class="voice-demo-config-row">
                                    <span class="voice-demo-config-label">LLM</span>
                                    <span class="voice-demo-config-value" data-config="llm">${config.llm}</span>
                                </div>
                                <div class="voice-demo-config-row">
                                    <span class="voice-demo-config-label indent">model</span>
                                    <span class="voice-demo-config-value" data-config="llmModel">${config.llmModel}</span>
                                </div>
                                <div class="voice-demo-config-row">
                                    <span class="voice-demo-config-label">Text-to-speech</span>
                                    <span class="voice-demo-config-value" data-config="tts">${config.tts}</span>
                                </div>
                                <div class="voice-demo-config-row">
                                    <span class="voice-demo-config-label indent">model</span>
                                    <span class="voice-demo-config-value" data-config="ttsModel">${config.ttsModel}</span>
                                </div>
                            </div>

                            <div class="voice-demo-enhancements">
                                <div class="voice-demo-panel-header">Enhancements</div>
                                <div class="voice-demo-enhancement-row">
                                    <span class="voice-demo-enhancement-label">Turn detection</span>
                                    <span class="voice-demo-enhancement-value">TRUE</span>
                                </div>
                                <div class="voice-demo-enhancement-row">
                                    <span class="voice-demo-enhancement-label">Noise cancellation</span>
                                    <span class="voice-demo-enhancement-value">TRUE</span>
                                </div>
                            </div>

                            <div class="voice-demo-latency">
                                <div class="voice-demo-panel-header">Latency</div>
                                <div class="voice-demo-latency-row">
                                    <span class="voice-demo-latency-label">Speech-to-text</span>
                                    <span class="voice-demo-latency-value pending" data-metric="stt">—</span>
                                </div>
                                <div class="voice-demo-latency-row">
                                    <span class="voice-demo-latency-label">LLM</span>
                                    <span class="voice-demo-latency-value pending" data-metric="llm">—</span>
                                </div>
                                <div class="voice-demo-latency-row">
                                    <span class="voice-demo-latency-label">Text-to-speech</span>
                                    <span class="voice-demo-latency-value pending" data-metric="tts">—</span>
                                </div>
                            </div>

                            <div class="voice-demo-transcript">
                                <div class="voice-demo-panel-header">Transcription</div>
                                <div class="voice-demo-transcript-scroll">
                                    <p class="voice-demo-transcript-empty">Conversation will appear here...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        bindEvents() {
            // Trigger buttons
            document.querySelectorAll('.voice-demo-trigger').forEach(btn => {
                btn.addEventListener('click', () => this.open());
            });

            // Close button
            this.overlay.querySelector('.voice-demo-close').addEventListener('click', () => this.close());

            // Click outside to close
            this.overlay.addEventListener('click', (e) => {
                if (e.target === this.overlay) this.close();
            });

            // Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.overlay.classList.contains('active')) {
                    this.close();
                }
            });

            // Provider toggle
            this.overlay.querySelectorAll('.voice-demo-provider').forEach(btn => {
                btn.addEventListener('click', () => {
                    if (this.status !== 'connected') {
                        this.selectProvider(btn.dataset.provider);
                    }
                });
            });

            // Agent tabs
            this.overlay.querySelectorAll('.voice-demo-tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    if (this.status !== 'connected') {
                        this.selectAgent(tab.dataset.agent);
                    }
                });
            });

            // Start button
            this.overlay.querySelector('.voice-demo-start').addEventListener('click', () => this.connect());

            // Mic toggle
            this.overlay.querySelector('.voice-demo-mic').addEventListener('click', () => this.toggleMute());

            // End button
            this.overlay.querySelector('.voice-demo-end').addEventListener('click', () => this.disconnect());
        }

        open() {
            this.overlay.classList.add('active');
            document.body.classList.add('voice-demo-open');
            this.startVisualizer();
        }

        close() {
            if (this.status === 'connected') {
                this.disconnect();
            }
            this.overlay.classList.remove('active');
            document.body.classList.remove('voice-demo-open');
            this.stopVisualizer();
            this.reset();
        }

        reset() {
            this.status = 'idle';
            this.agentState = 'idle';
            this.transcript = [];
            this.error = null;
            this.latency = { stt: null, llm: null, tts: null };
            this.overlay.setAttribute('data-status', 'idle');
            this.updateStatus('idle', 'Ready to start');
            this.updateTranscript();
            this.updateLatency();
        }

        selectProvider(providerId) {
            this.selectedProvider = providerId;
            this.overlay.querySelectorAll('.voice-demo-provider').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.provider === providerId);
            });
            this.updateConfigDisplay();
        }

        selectAgent(agentId) {
            this.selectedAgent = agentId;
            this.overlay.querySelectorAll('.voice-demo-tab').forEach(tab => {
                tab.classList.toggle('active', tab.dataset.agent === agentId);
            });
        }

        updateConfigDisplay() {
            const config = DEFAULT_CONFIGS[this.selectedProvider];
            Object.keys(config).forEach(key => {
                const el = this.overlay.querySelector(`[data-config="${key}"]`);
                if (el) {
                    el.textContent = config[key];
                }
            });
        }

        async connect() {
            if (this.status === 'connecting' || this.status === 'connected') return;

            this.setStatus('connecting');
            this.updateStatus('idle', 'Connecting...');

            try {
                // Check for secure context (required for getUserMedia)
                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    throw new Error('Microphone access requires HTTPS. Please access this site via https:// or localhost.');
                }

                // Request microphone permission
                console.log('[VoiceDemo] Requesting microphone...');
                this.mediaStream = await navigator.mediaDevices.getUserMedia({
                    audio: {
                        sampleRate: 16000,
                        channelCount: 1,
                        echoCancellation: true,
                        noiseSuppression: true,
                        autoGainControl: true
                    }
                });
                console.log('[VoiceDemo] Microphone access granted');

                // Initialize audio context
                this.audioContext = new (window.AudioContext || window.webkitAudioContext)({
                    sampleRate: 16000
                });

                // Resume audio context (required after user interaction)
                if (this.audioContext.state === 'suspended') {
                    await this.audioContext.resume();
                }
                console.log('[VoiceDemo] AudioContext state:', this.audioContext.state, 'sampleRate:', this.audioContext.sampleRate);

                // Load audio worklet
                const workletUrl = this.config.audioProcessorUrl ||
                    (window.voiceDemoConfig?.themeUrl || '') + '/assets/js/audio-processor.js';
                console.log('[VoiceDemo] Loading AudioWorklet from:', workletUrl);

                await this.audioContext.audioWorklet.addModule(workletUrl);
                console.log('[VoiceDemo] AudioWorklet loaded');

                // Create worklet node
                const source = this.audioContext.createMediaStreamSource(this.mediaStream);
                this.workletNode = new AudioWorkletNode(this.audioContext, 'voice-demo-processor');
                console.log('[VoiceDemo] WorkletNode created');

                let audioChunkCount = 0;
                this.workletNode.port.onmessage = (e) => {
                    if (e.data.type === 'audio') {
                        audioChunkCount++;
                        if (audioChunkCount <= 3 || audioChunkCount % 50 === 0) {
                            console.log('[VoiceDemo] Audio chunk', audioChunkCount, 'size:', e.data.buffer.byteLength);
                        }
                        if (this.ws?.readyState === WebSocket.OPEN && !this.isMuted) {
                            this.sendAudio(e.data.buffer);
                        }
                    } else if (e.data.type === 'level') {
                        this.audioLevel = e.data.level;
                    }
                };

                source.connect(this.workletNode);
                console.log('[VoiceDemo] Audio pipeline connected');

                // Connect WebSocket
                await this.connectWebSocket();

                // Disable agent tabs and provider toggle during call
                this.overlay.querySelectorAll('.voice-demo-tab').forEach(tab => {
                    tab.disabled = true;
                });
                this.overlay.querySelectorAll('.voice-demo-provider').forEach(btn => {
                    btn.disabled = true;
                });

                this.setStatus('connected');
                this.updateStatus('listening', 'Listening...');

            } catch (err) {
                console.error('Voice demo connection error:', err);
                this.setError(err.message || 'Failed to connect');
                this.cleanup();
            }
        }

        connectWebSocket() {
            return new Promise((resolve, reject) => {
                const url = new URL(this.config.wsEndpoint);
                url.searchParams.set('agent', this.selectedAgent);
                url.searchParams.set('provider', this.selectedProvider);

                this.ws = new WebSocket(url.toString());
                this.ws.binaryType = 'arraybuffer';

                const timeout = setTimeout(() => {
                    reject(new Error('Connection timeout'));
                    this.ws.close();
                }, 10000);

                this.ws.onopen = () => {
                    clearTimeout(timeout);
                    // Send start message with provider
                    this.ws.send(JSON.stringify({
                        type: 'start',
                        agent_id: this.selectedAgent,
                        provider: this.selectedProvider,
                        config: { sample_rate: 16000 }
                    }));
                };

                this.ws.onmessage = (event) => {
                    if (event.data instanceof ArrayBuffer) {
                        // Binary audio data
                        console.log('[VoiceDemo] Received binary audio, size:', event.data.byteLength);
                        this.queueAudio(event.data);
                    } else {
                        // JSON message
                        const msg = JSON.parse(event.data);

                        // Check if this is an audio message in JSON format
                        if (msg.type === 'audio' && msg.data) {
                            const audioData = Uint8Array.from(atob(msg.data), c => c.charCodeAt(0));
                            if (!this._jsonAudioCount) this._jsonAudioCount = 0;
                            this._jsonAudioCount++;
                            if (this._jsonAudioCount <= 3 || this._jsonAudioCount % 20 === 0) {
                                console.log('[VoiceDemo] Received JSON audio chunk', this._jsonAudioCount, 'size:', audioData.byteLength);
                            }
                            this.queueAudio(audioData.buffer);
                        } else {
                            this.handleMessage(msg);
                        }

                        if (msg.type === 'session_started') {
                            this.sessionId = msg.session_id;
                            resolve();
                        }
                    }
                };

                this.ws.onerror = () => {
                    clearTimeout(timeout);
                    reject(new Error('WebSocket error'));
                };

                this.ws.onclose = () => {
                    if (this.status === 'connected') {
                        this.disconnect();
                    }
                };
            });
        }

        handleMessage(msg) {
            switch (msg.type) {
                case 'agent_state':
                    this.setAgentState(msg.state);
                    break;

                case 'transcript':
                    this.addTranscript(msg.speaker, msg.text, msg.final);
                    break;

                case 'latency':
                    this.latency = {
                        stt: msg.stt_ms,
                        llm: msg.llm_ms,
                        tts: msg.tts_ms
                    };
                    this.updateLatency();
                    break;

                case 'config':
                    // Could update config panel if server sends different values
                    break;

                case 'error':
                    this.setError(msg.message);
                    break;

                case 'session_ended':
                    this.disconnect();
                    break;
            }
        }

        setAgentState(state) {
            this.agentState = state;
            const statusTexts = {
                idle: 'Ready',
                listening: 'Listening...',
                thinking: 'Thinking...',
                speaking: 'Speaking...'
            };
            this.updateStatus(state, statusTexts[state] || state);
        }

        addTranscript(speaker, text, isFinal = true) {
            // Update last entry if same speaker and not final
            const last = this.transcript[this.transcript.length - 1];
            if (last && last.speaker === speaker && !last.final) {
                last.text = text;
                last.final = isFinal;
            } else if (isFinal || !last || last.speaker !== speaker) {
                this.transcript.push({
                    speaker,
                    text,
                    final: isFinal,
                    timestamp: Date.now()
                });
            }
            this.updateTranscript();
        }

        sendAudio(buffer) {
            if (this.ws?.readyState === WebSocket.OPEN) {
                // Convert to base64 and send as JSON
                const base64 = this.arrayBufferToBase64(buffer);
                if (!this._audioSendCount) this._audioSendCount = 0;
                this._audioSendCount++;
                if (this._audioSendCount <= 3 || this._audioSendCount % 50 === 0) {
                    console.log('[VoiceDemo] Sending audio chunk', this._audioSendCount, 'to WebSocket');
                }
                this.ws.send(JSON.stringify({
                    type: 'audio',
                    data: base64
                }));
            } else {
                console.warn('[VoiceDemo] WebSocket not open, state:', this.ws?.readyState);
            }
        }

        queueAudio(buffer) {
            if (!this._audioQueueCount) this._audioQueueCount = 0;
            this._audioQueueCount++;
            if (this._audioQueueCount <= 3 || this._audioQueueCount % 20 === 0) {
                console.log('[VoiceDemo] Queueing audio chunk', this._audioQueueCount, 'size:', buffer.byteLength, 'queue length:', this.audioQueue.length + 1);
            }
            this.audioQueue.push(buffer);
            if (!this.isPlaying) {
                this.playNextAudio();
            }
        }

        async playNextAudio() {
            if (this.audioQueue.length === 0) {
                this.isPlaying = false;
                return;
            }

            this.isPlaying = true;
            const buffer = this.audioQueue.shift();

            try {
                // Decode PCM16 to Float32
                const int16 = new Int16Array(buffer);
                const float32 = new Float32Array(int16.length);
                for (let i = 0; i < int16.length; i++) {
                    float32[i] = int16[i] / 32768;
                }

                if (!this._audioPlayCount) this._audioPlayCount = 0;
                this._audioPlayCount++;
                if (this._audioPlayCount <= 3 || this._audioPlayCount % 20 === 0) {
                    console.log('[VoiceDemo] Playing audio chunk', this._audioPlayCount, 'samples:', float32.length);
                }

                // Create audio buffer (assuming 24kHz from server)
                const audioBuffer = this.audioContext.createBuffer(1, float32.length, 24000);
                audioBuffer.getChannelData(0).set(float32);

                const source = this.audioContext.createBufferSource();
                source.buffer = audioBuffer;
                source.connect(this.audioContext.destination);
                source.onended = () => this.playNextAudio();
                source.start();
            } catch (err) {
                console.error('[VoiceDemo] Audio playback error:', err);
                this.playNextAudio();
            }
        }

        toggleMute() {
            this.isMuted = !this.isMuted;
            const micBtn = this.overlay.querySelector('.voice-demo-mic');
            micBtn.classList.toggle('muted', this.isMuted);
            micBtn.querySelector('.mic-on').style.display = this.isMuted ? 'none' : 'block';
            micBtn.querySelector('.mic-off').style.display = this.isMuted ? 'block' : 'none';
        }

        disconnect() {
            // Send stop message
            if (this.ws?.readyState === WebSocket.OPEN) {
                this.ws.send(JSON.stringify({ type: 'stop' }));
            }

            this.cleanup();
            this.setStatus('idle');
            this.updateStatus('idle', 'Call ended');

            // Re-enable agent tabs and provider toggle
            this.overlay.querySelectorAll('.voice-demo-tab').forEach(tab => {
                tab.disabled = false;
            });
            this.overlay.querySelectorAll('.voice-demo-provider').forEach(btn => {
                btn.disabled = false;
            });
        }

        cleanup() {
            // Close WebSocket
            if (this.ws) {
                this.ws.close();
                this.ws = null;
            }

            // Stop media stream
            if (this.mediaStream) {
                this.mediaStream.getTracks().forEach(track => track.stop());
                this.mediaStream = null;
            }

            // Close audio context
            if (this.audioContext) {
                this.audioContext.close();
                this.audioContext = null;
            }

            this.workletNode = null;
            this.audioQueue = [];
            this.isPlaying = false;
        }

        setStatus(status) {
            this.status = status;
            this.overlay.setAttribute('data-status', status);
        }

        setError(message) {
            this.error = message;
            this.setStatus('error');
            this.overlay.querySelector('.voice-demo-error').textContent = message;
        }

        updateStatus(state, text) {
            this.statusEl.setAttribute('data-state', state);
            this.statusEl.querySelector('.voice-demo-status-text').textContent = text;
        }

        updateTranscript() {
            const container = this.transcriptScroll;

            if (this.transcript.length === 0) {
                container.innerHTML = '<p class="voice-demo-transcript-empty">Conversation will appear here...</p>';
                return;
            }

            container.innerHTML = this.transcript.map(entry => `
                <div class="voice-demo-transcript-entry">
                    <span class="voice-demo-transcript-speaker ${entry.speaker}">${entry.speaker === 'agent' ? 'AGENT:' : 'YOU:'}</span>
                    <span class="voice-demo-transcript-text">${this.escapeHtml(entry.text)}</span>
                </div>
            `).join('');

            // Scroll to bottom
            container.scrollTop = container.scrollHeight;
        }

        updateLatency() {
            ['stt', 'llm', 'tts'].forEach(metric => {
                const el = this.overlay.querySelector(`[data-metric="${metric}"]`);
                if (el) {
                    const value = this.latency[metric];
                    if (value !== null) {
                        el.textContent = `${value}MS`;
                        el.classList.remove('pending');
                    } else {
                        el.textContent = '—';
                        el.classList.add('pending');
                    }
                }
            });
        }

        // Visualizer
        startVisualizer() {
            if (this.animationFrame) return;

            const draw = () => {
                this.drawOrb();
                this.animationFrame = requestAnimationFrame(draw);
            };
            draw();
        }

        stopVisualizer() {
            if (this.animationFrame) {
                cancelAnimationFrame(this.animationFrame);
                this.animationFrame = null;
            }
        }

        drawOrb() {
            const canvas = this.canvas;
            const ctx = this.ctx;
            const size = 220;
            const dpr = window.devicePixelRatio || 1;

            // Ensure canvas size
            if (canvas.width !== size * dpr) {
                canvas.width = size * dpr;
                canvas.height = size * dpr;
                canvas.style.width = size + 'px';
                canvas.style.height = size + 'px';
                ctx.scale(dpr, dpr);
            }

            ctx.clearRect(0, 0, size, size);

            const centerX = size / 2;
            const centerY = size / 2;

            // Smooth audio level
            this.smoothLevel += (this.audioLevel - this.smoothLevel) * 0.15;
            const level = this.status === 'connected' ? this.smoothLevel : 0;

            // Determine colors based on state
            let color;
            switch (this.agentState) {
                case 'listening':
                    color = '#22c55e'; // Green
                    break;
                case 'thinking':
                    color = '#d4a530'; // Gold
                    break;
                case 'speaking':
                    color = '#3b82f6'; // Blue
                    break;
                default:
                    color = this.status === 'connected' ? '#d4a530' : '#666666';
            }

            // Pulse speed
            const pulseSpeed = this.agentState === 'thinking' ? 0.05 : 0.02;

            // Draw layers
            const layers = [
                { radius: 35, opacity: 0.9 },
                { radius: 50, opacity: 0.6 },
                { radius: 65, opacity: 0.4 },
                { radius: 80, opacity: 0.2 }
            ];

            layers.forEach((layer, i) => {
                const scale = 1 + level * 0.5;
                const radius = layer.radius * scale;

                // Gradient
                const gradient = ctx.createRadialGradient(centerX, centerY, 0, centerX, centerY, radius);
                gradient.addColorStop(0, color + this.toHex(layer.opacity));
                gradient.addColorStop(0.7, color + '40');
                gradient.addColorStop(1, color + '00');

                // Organic blob shape
                ctx.beginPath();
                const points = 60;
                for (let j = 0; j <= points; j++) {
                    const angle = (j / points) * Math.PI * 2;
                    const noise = Math.sin(angle * 3 + this.orbOffset + i) * 8 * (1 + level);
                    const r = radius + noise;
                    const x = centerX + Math.cos(angle) * r;
                    const y = centerY + Math.sin(angle) * r;
                    j === 0 ? ctx.moveTo(x, y) : ctx.lineTo(x, y);
                }
                ctx.closePath();
                ctx.fillStyle = gradient;
                ctx.fill();
            });

            this.orbOffset += pulseSpeed;
        }

        // Utilities
        arrayBufferToBase64(buffer) {
            const bytes = new Uint8Array(buffer);
            let binary = '';
            for (let i = 0; i < bytes.byteLength; i++) {
                binary += String.fromCharCode(bytes[i]);
            }
            return btoa(binary);
        }

        toHex(opacity) {
            return Math.floor(opacity * 255).toString(16).padStart(2, '0');
        }

        escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    }

    // Initialize on DOM ready
    document.addEventListener('DOMContentLoaded', () => {
        window.voiceDemo = new VoiceDemo();
    });

})();
