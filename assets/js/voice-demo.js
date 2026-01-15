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

    const CONNECT_TIMEOUT_MS = 10000;
    const SESSION_TIMEOUT_MS = 10000;
    const MAX_PLAYBACK_LAG_SEC = 12;

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
            this.audioLevel = 0;
            this.inputSampleRate = 16000;
            this.outputSampleRate = 24000;
            this.playbackTime = 0;
            this.scheduledSources = new Set();
            this.lastAgentSpeechAt = null;
            this.lastBargeInAt = null;
            this.ignoreAudioUntil = 0;

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
            this.useBinaryAudio = this.config.useBinaryAudio !== false;
            this.enableBargeIn = this.config.enableBargeIn !== false;
            this.dropLaggingAudio = this.config.dropLaggingAudio === true;
            this.bargeInMinSpeakingMs = Number.isFinite(this.config.bargeInMinSpeakingMs)
                ? this.config.bargeInMinSpeakingMs
                : 200;
            this.bargeInMinLevel = Number.isFinite(this.config.bargeInMinLevel)
                ? this.config.bargeInMinLevel
                : 0;
            this.bargeInCooldownMs = Number.isFinite(this.config.bargeInCooldownMs)
                ? this.config.bargeInCooldownMs
                : 500;
            this.bargeInDropMs = Number.isFinite(this.config.bargeInDropMs)
                ? this.config.bargeInDropMs
                : 1200;

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
            this.barsContainer = this.overlay.querySelector('.voice-demo-bars-container');
            this.bars = this.overlay.querySelectorAll('.voice-demo-bar');
            this.statusEl = this.overlay.querySelector('.voice-demo-status');
            this.transcriptScroll = this.overlay.querySelector('.voice-demo-transcript-scroll');

            // Initialize bar heights array for smooth animation
            this.barHeights = new Array(this.bars.length).fill(15);
            this.targetHeights = new Array(this.bars.length).fill(15);
        }

        getModalHTML() {
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

                    <div class="voice-demo-content-centered">
                        <div class="voice-demo-main">
                            <!-- Audio Bar Visualizer -->
                            <div class="voice-demo-audio-visualizer">
                                <div class="voice-demo-bars-container">
                                    ${Array.from({length: 32}, (_, i) => `<span class="voice-demo-bar" data-bar="${i}"></span>`).join('')}
                                </div>
                                <div class="voice-demo-visualizer-glow"></div>
                            </div>

                            <div class="voice-demo-status" data-state="idle">
                                <span class="voice-demo-status-dot"></span>
                                <span class="voice-demo-status-text">Ready to start</span>
                            </div>

                            <!-- Transcript Section -->
                            <div class="voice-demo-transcript-panel">
                                <div class="voice-demo-transcript-header">
                                    <span class="voice-demo-transcript-label">Live Transcript</span>
                                    <span class="voice-demo-transcript-indicator">
                                        <span class="indicator-dot"></span>
                                    </span>
                                </div>
                                <div class="voice-demo-transcript-scroll">
                                    <div class="voice-demo-transcript-empty">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="empty-icon">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                        </svg>
                                        <span>Your conversation will appear here</span>
                                    </div>
                                </div>
                            </div>

                            <div class="voice-demo-error"></div>

                            <!-- Controls at Bottom -->
                            <div class="voice-demo-controls-bottom">
                                <button class="voice-demo-start">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                                        <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                                        <line x1="12" y1="19" x2="12" y2="23"/>
                                        <line x1="8" y1="23" x2="16" y2="23"/>
                                    </svg>
                                    <span>Start Live Conversation</span>
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
                    this.selectProvider(btn.dataset.provider);
                });
            });

            // Agent tabs
            this.overlay.querySelectorAll('.voice-demo-tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    this.selectAgent(tab.dataset.agent);
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
            } else {
                this.cleanup();
            }
            this.overlay.classList.remove('active');
            document.body.classList.remove('voice-demo-open');
            this.stopVisualizer();
            this.reset();
        }

        reset() {
            this.status = 'idle';
            this.agentState = 'idle';
            this.sessionId = null;
            this.transcript = [];
            this.error = null;
            this.latency = { stt: null, llm: null, tts: null };
            this.overlay.setAttribute('data-status', 'idle');
            this.updateStatus('idle', 'Ready to start');
            this.isMuted = false;
            this.updateMicUI();
            this.resetPlayback('reset');
            this.stopWordHighlighting();
            this.overlay.querySelectorAll('.voice-demo-tab').forEach(tab => {
                tab.disabled = false;
            });
            this.overlay.querySelectorAll('.voice-demo-provider').forEach(btn => {
                btn.disabled = false;
            });
            const errorEl = this.overlay.querySelector('.voice-demo-error');
            if (errorEl) {
                errorEl.textContent = '';
            }
            this.updateTranscript();
        }

        selectProvider(providerId) {
            if (this.status === 'connected' || this.status === 'connecting') {
                this.disconnect();
            }
            this.selectedProvider = providerId;
            this.overlay.querySelectorAll('.voice-demo-provider').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.provider === providerId);
            });
            this.updateConfigDisplay();
            this.prepareNewSession('provider-switch');
        }

        selectAgent(agentId) {
            if (this.status === 'connected' || this.status === 'connecting') {
                this.disconnect();
            }
            this.selectedAgent = agentId;
            this.overlay.querySelectorAll('.voice-demo-tab').forEach(tab => {
                tab.classList.toggle('active', tab.dataset.agent === agentId);
            });
            this.prepareNewSession('agent-switch');
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

        applyServerConfig(config) {
            const mapping = {
                vad: 'vad',
                stt: 'stt',
                stt_model: 'sttModel',
                llm: 'llm',
                llm_model: 'llmModel',
                tts: 'tts',
                tts_model: 'ttsModel'
            };
            Object.keys(mapping).forEach(key => {
                if (config[key]) {
                    const el = this.overlay.querySelector(`[data-config="${mapping[key]}"]`);
                    if (el) {
                        el.textContent = String(config[key]);
                    }
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
                this.inputSampleRate = this.audioContext.sampleRate || 16000;
                console.log('[VoiceDemo] AudioContext state:', this.audioContext.state, 'sampleRate:', this.inputSampleRate);

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

                this.setStatus('connected');
                this.updateStatus('listening', 'Listening...');

                // Start agent intro timer - if user doesn't speak within a few seconds, prompt the agent
                this.startAgentIntroTimer();

            } catch (err) {
                console.error('Voice demo connection error:', err);
                this.setError(err.message || 'Failed to connect');
                this.cleanup();
            }
        }

        startAgentIntroTimer() {
            // Clear any existing timer
            this.clearAgentIntroTimer();

            // Trigger agent intro immediately (small delay to let connection settle)
            // The agent should always start with the demo introduction
            this.agentIntroTimer = setTimeout(() => {
                if (this.status === 'connected') {
                    console.log('[VoiceDemo] Prompting agent to start with demo introduction');
                    this.promptAgentIntro();
                }
            }, 500);
        }

        clearAgentIntroTimer() {
            if (this.agentIntroTimer) {
                clearTimeout(this.agentIntroTimer);
                this.agentIntroTimer = null;
            }
        }

        promptAgentIntro() {
            if (this.ws?.readyState === WebSocket.OPEN) {
                this.ws.send(JSON.stringify({
                    type: 'prompt_intro'
                }));
            }
        }

        connectWebSocket() {
            return new Promise((resolve, reject) => {
                const url = new URL(this.config.wsEndpoint);
                url.searchParams.set('agent', this.selectedAgent);
                url.searchParams.set('provider', this.selectedProvider);

                let settled = false;
                let sessionTimeout = null;

                const finalize = (fn, arg) => {
                    if (settled) return;
                    settled = true;
                    clearTimeout(connectTimeout);
                    clearTimeout(sessionTimeout);
                    fn(arg);
                };

                const fail = (error) => {
                    try {
                        if (this.ws && this.ws.readyState <= WebSocket.OPEN) {
                            this.ws.close();
                        }
                    } catch (err) {
                        // noop
                    }
                    finalize(reject, error);
                };

                this.ws = new WebSocket(url.toString());
                this.ws.binaryType = 'arraybuffer';

                const connectTimeout = setTimeout(() => {
                    fail(new Error('Connection timeout'));
                }, CONNECT_TIMEOUT_MS);

                this.ws.onopen = () => {
                    clearTimeout(connectTimeout);
                    sessionTimeout = setTimeout(() => {
                        fail(new Error('Session start timeout'));
                    }, SESSION_TIMEOUT_MS);
                    // Send start message with provider
                    this.ws.send(JSON.stringify({
                        type: 'start',
                        agent_id: this.selectedAgent,
                        provider: this.selectedProvider,
                        config: { sample_rate: this.inputSampleRate }
                    }));
                };

                this.ws.onmessage = (event) => {
                    if (event.data instanceof ArrayBuffer) {
                        this.queueAudio(event.data);
                        return;
                    }
                    if (event.data instanceof Blob) {
                        event.data.arrayBuffer().then(buffer => this.queueAudio(buffer));
                        return;
                    } else {
                        if (typeof event.data !== 'string') {
                            return;
                        }

                        let msg;
                        try {
                            msg = JSON.parse(event.data);
                        } catch (err) {
                            console.warn('[VoiceDemo] Invalid JSON message:', err);
                            return;
                        }

                        // Check if this is an audio message in JSON format
                        if (msg.type === 'audio' && msg.data) {
                            if (msg.sample_rate) {
                                this.outputSampleRate = msg.sample_rate;
                            }
                            this.queueAudio(this.base64ToArrayBuffer(msg.data));
                        } else {
                            this.handleMessage(msg);
                        }

                        if (msg.type === 'session_started') {
                            this.sessionId = msg.session_id;
                            finalize(resolve);
                        } else if (!settled && msg.type === 'error') {
                            fail(new Error(msg.message || 'WebSocket error'));
                        }
                    }
                };

                this.ws.onerror = () => {
                    fail(new Error('WebSocket error'));
                };

                this.ws.onclose = () => {
                    if (!settled) {
                        fail(new Error('WebSocket closed'));
                        return;
                    }
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
                    // Skip empty or whitespace-only transcripts
                    if (msg.text && msg.text.trim()) {
                        console.log('[VoiceDemo] Transcript:', msg.speaker, msg.final ? '(final)' : '(partial)', JSON.stringify(msg.text));
                        this.addTranscript(msg.speaker, msg.text, msg.final);
                    }
                    break;

                case 'latency':
                    this.latency = {
                        stt: msg.stt_ms ?? this.latency.stt,
                        llm: msg.llm_ms ?? this.latency.llm,
                        tts: msg.tts_ms ?? this.latency.tts
                    };
                    this.updateLatency();
                    break;

                case 'config':
                    this.applyServerConfig(msg);
                    break;

                case 'user_speech_started':
                    // User started speaking, cancel agent intro timer
                    this.clearAgentIntroTimer();
                    if (this.shouldBargeIn()) {
                        this.resetPlayback('interrupt');
                    }
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
            const prevState = this.agentState;
            this.agentState = state;

            // Clear intro timer once agent starts responding
            if (state === 'thinking' || state === 'speaking') {
                this.clearAgentIntroTimer();
            }

            if (state === 'speaking' && prevState !== 'speaking') {
                this.lastAgentSpeechAt = performance.now();
                // Trigger word highlighting for current transcript
                this.startWordHighlighting();
            } else if (state !== 'speaking') {
                this.lastAgentSpeechAt = null;
                this.stopWordHighlighting();
            }
            const statusTexts = {
                idle: 'Ready',
                listening: 'Listening...',
                thinking: 'Thinking...',
                speaking: 'Speaking...'
            };
            this.updateStatus(state, statusTexts[state] || state);
        }

        addTranscript(speaker, text, isFinal = true) {
            const last = this.transcript[this.transcript.length - 1];
            let isUpdate = false;

            // Update existing entry if same speaker and entry isn't finalized yet
            if (last && last.speaker === speaker && !last.final) {
                last.text = text;
                last.final = isFinal;
                isUpdate = true;
            }
            // Create new entry only if different speaker or last entry was already final
            else if (!last || last.speaker !== speaker || last.final) {
                // Don't create duplicate final entries with same text
                if (last && last.speaker === speaker && last.text === text) {
                    return; // Skip duplicate
                }
                this.transcript.push({
                    speaker,
                    text,
                    final: isFinal,
                    timestamp: Date.now()
                });
            }

            // Use smart update to avoid flickering
            this.updateTranscriptSmart(isUpdate);
        }

        sendAudio(buffer) {
            if (this.ws?.readyState === WebSocket.OPEN) {
                if (!this._audioSendCount) this._audioSendCount = 0;
                this._audioSendCount++;
                if (this._audioSendCount <= 3 || this._audioSendCount % 50 === 0) {
                    console.log('[VoiceDemo] Sending audio chunk', this._audioSendCount, 'to WebSocket');
                }
                if (this.useBinaryAudio) {
                    const payload = buffer instanceof ArrayBuffer
                        ? buffer
                        : buffer.buffer.slice(buffer.byteOffset, buffer.byteOffset + buffer.byteLength);
                    this.ws.send(payload);
                    return;
                }
                // Convert to base64 and send as JSON
                const base64 = this.arrayBufferToBase64(buffer);
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
                console.log('[VoiceDemo] Queueing audio chunk', this._audioQueueCount, 'size:', buffer.byteLength);
            }
            if (!this.audioContext) {
                return;
            }
            if (this.ignoreAudioUntil && performance.now() < this.ignoreAudioUntil) {
                if (!this._audioIgnoreLogged) {
                    this._audioIgnoreLogged = true;
                    console.log('[VoiceDemo] Ignoring agent audio due to barge-in');
                }
                return;
            }
            this._audioIgnoreLogged = false;

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

                const sampleRate = this.outputSampleRate || 24000;
                const audioBuffer = this.audioContext.createBuffer(1, float32.length, sampleRate);
                audioBuffer.getChannelData(0).set(float32);

                const now = this.audioContext.currentTime;
                if (!this.playbackTime || this.playbackTime < now) {
                    this.playbackTime = now;
                }

                const lag = this.playbackTime - now;
                if (lag > MAX_PLAYBACK_LAG_SEC) {
                    if (this.dropLaggingAudio) {
                        this.resetPlayback('lag');
                    } else if (!this._audioLagWarned) {
                        this._audioLagWarned = true;
                        console.warn('[VoiceDemo] Audio lag detected; keeping backlog to avoid drops');
                    }
                }

                const startTime = Math.max(this.playbackTime, this.audioContext.currentTime + 0.03);
                this.playbackTime = startTime + audioBuffer.duration;

                const source = this.audioContext.createBufferSource();
                source.buffer = audioBuffer;
                source.connect(this.audioContext.destination);
                this.scheduledSources.add(source);
                source.onended = () => this.scheduledSources.delete(source);
                source.start(startTime);
            } catch (err) {
                console.error('[VoiceDemo] Audio playback error:', err);
            }
        }

        toggleMute() {
            this.isMuted = !this.isMuted;
            this.updateMicUI();
        }

        disconnect() {
            console.log('[VoiceDemo] disconnect() called, stack:', new Error().stack.split('\n').slice(1,4).join(' -> '));
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
            this.resetPlayback('cleanup');
            this.stopWordHighlighting();
            this.clearAgentIntroTimer();

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
        }

        setStatus(status) {
            console.log('[VoiceDemo] setStatus:', status, 'from:', this.status, 'stack:', new Error().stack.split('\n')[2]);
            this.status = status;
            this.overlay.setAttribute('data-status', status);
        }

        setError(message) {
            this.error = message;
            this.setStatus('error');
            this.overlay.querySelector('.voice-demo-error').textContent = message;
            this.resetPlayback('error');
        }

        updateStatus(state, text) {
            this.statusEl.setAttribute('data-state', state);
            this.statusEl.querySelector('.voice-demo-status-text').textContent = text;
        }

        updateTranscriptSmart(isUpdate = false) {
            const container = this.transcriptScroll;

            if (this.transcript.length === 0) {
                container.innerHTML = `
                    <div class="voice-demo-transcript-empty">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="empty-icon">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                        <span>Your conversation will appear here</span>
                    </div>
                `;
                return;
            }

            const lastIndex = this.transcript.length - 1;
            const lastEntry = this.transcript[lastIndex];
            const existingEntry = container.querySelector(`[data-entry="${lastIndex}"]`);

            if (isUpdate && existingEntry) {
                // Just update the text of the existing entry (no flicker)
                const textEl = existingEntry.querySelector('.voice-demo-transcript-text');
                if (textEl) {
                    const isLatestAgent = lastEntry.speaker === 'agent' && this.agentState === 'speaking';
                    const words = this.escapeHtml(lastEntry.text).split(/(\s+)/);
                    const wordSpans = words.map((word, wordIndex) => {
                        if (word.trim() === '') return word;
                        const highlightClass = isLatestAgent ? 'voice-demo-word' : '';
                        return `<span class="${highlightClass}" data-word="${wordIndex}">${word}</span>`;
                    }).join('');
                    textEl.innerHTML = wordSpans;
                }
            } else {
                // Clear empty state if present
                const emptyState = container.querySelector('.voice-demo-transcript-empty');
                if (emptyState) {
                    emptyState.remove();
                }

                // Remove 'speaking' class from previous entries
                container.querySelectorAll('.voice-demo-transcript-entry.speaking').forEach(el => {
                    el.classList.remove('speaking');
                });

                // Add new entry
                const isLatestAgent = lastEntry.speaker === 'agent' && this.agentState === 'speaking';
                const words = this.escapeHtml(lastEntry.text).split(/(\s+)/);
                const wordSpans = words.map((word, wordIndex) => {
                    if (word.trim() === '') return word;
                    const highlightClass = isLatestAgent ? 'voice-demo-word' : '';
                    return `<span class="${highlightClass}" data-word="${wordIndex}">${word}</span>`;
                }).join('');

                const entryHtml = `
                    <div class="voice-demo-transcript-entry ${isLatestAgent ? 'speaking' : ''}" data-entry="${lastIndex}">
                        <span class="voice-demo-transcript-speaker ${lastEntry.speaker}">${lastEntry.speaker === 'agent' ? 'AI' : 'YOU'}</span>
                        <span class="voice-demo-transcript-text">${wordSpans}</span>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', entryHtml);

                // Start word highlighting for new agent entries
                if (isLatestAgent && !this.wordHighlightInterval) {
                    this.startWordHighlighting();
                }
            }

            // Scroll to bottom
            container.scrollTop = container.scrollHeight;
        }

        updateTranscript() {
            // Full re-render (used for reset)
            const container = this.transcriptScroll;

            if (this.transcript.length === 0) {
                container.innerHTML = `
                    <div class="voice-demo-transcript-empty">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="empty-icon">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                        <span>Your conversation will appear here</span>
                    </div>
                `;
                return;
            }

            container.innerHTML = this.transcript.map((entry, entryIndex) => {
                const isLatestAgent = entry.speaker === 'agent' &&
                    entryIndex === this.transcript.length - 1 &&
                    this.agentState === 'speaking';

                const words = this.escapeHtml(entry.text).split(/(\s+)/);
                const wordSpans = words.map((word, wordIndex) => {
                    if (word.trim() === '') return word;
                    const highlightClass = isLatestAgent ? 'voice-demo-word' : '';
                    return `<span class="${highlightClass}" data-word="${wordIndex}">${word}</span>`;
                }).join('');

                return `
                    <div class="voice-demo-transcript-entry ${isLatestAgent ? 'speaking' : ''}" data-entry="${entryIndex}">
                        <span class="voice-demo-transcript-speaker ${entry.speaker}">${entry.speaker === 'agent' ? 'AI' : 'YOU'}</span>
                        <span class="voice-demo-transcript-text">${wordSpans}</span>
                    </div>
                `;
            }).join('');

            container.scrollTop = container.scrollHeight;
        }

        startWordHighlighting() {
            // Cancel any existing highlighting
            if (this.wordHighlightInterval) {
                clearInterval(this.wordHighlightInterval);
            }

            const speakingEntry = this.transcriptScroll.querySelector('.voice-demo-transcript-entry.speaking');
            if (!speakingEntry) return;

            const words = speakingEntry.querySelectorAll('.voice-demo-word');
            if (!words.length) return;

            let currentWordIndex = 0;
            const wordsPerSecond = 3; // Approximate speaking rate

            // Highlight first word immediately
            words[0]?.classList.add('highlighted');

            this.wordHighlightInterval = setInterval(() => {
                // Check if still speaking
                if (this.agentState !== 'speaking') {
                    clearInterval(this.wordHighlightInterval);
                    this.wordHighlightInterval = null;
                    // Mark all words as spoken
                    words.forEach(w => {
                        w.classList.remove('highlighted');
                        w.classList.add('spoken');
                    });
                    return;
                }

                // Mark previous word as spoken, highlight next
                if (currentWordIndex < words.length) {
                    words[currentWordIndex]?.classList.remove('highlighted');
                    words[currentWordIndex]?.classList.add('spoken');
                }

                currentWordIndex++;

                if (currentWordIndex < words.length) {
                    words[currentWordIndex]?.classList.add('highlighted');
                } else {
                    clearInterval(this.wordHighlightInterval);
                    this.wordHighlightInterval = null;
                }
            }, 1000 / wordsPerSecond);
        }

        stopWordHighlighting() {
            if (this.wordHighlightInterval) {
                clearInterval(this.wordHighlightInterval);
                this.wordHighlightInterval = null;
            }
        }

        updateLatency() {
            ['stt', 'llm', 'tts'].forEach(metric => {
                const el = this.overlay.querySelector(`[data-metric="${metric}"]`);
                if (el) {
                    const value = this.latency[metric];
                    if (value !== null && value !== undefined) {
                        el.textContent = `${value}MS`;
                        el.classList.remove('pending');
                    } else {
                        el.textContent = '—';
                        el.classList.add('pending');
                    }
                }
            });
        }

        updateMicUI() {
            const micBtn = this.overlay.querySelector('.voice-demo-mic');
            if (!micBtn) return;
            micBtn.classList.toggle('muted', this.isMuted);
            const micOn = micBtn.querySelector('.mic-on');
            const micOff = micBtn.querySelector('.mic-off');
            if (micOn) micOn.style.display = this.isMuted ? 'none' : 'block';
            if (micOff) micOff.style.display = this.isMuted ? 'block' : 'none';
        }

        prepareNewSession(reason) {
            console.log('[VoiceDemo] prepareNewSession called:', reason, 'current status:', this.status, 'stack:', new Error().stack.split('\n')[2]);
            this.sessionId = null;
            this.error = null;
            this.latency = { stt: null, llm: null, tts: null };
            this.transcript = [];
            this.setStatus('idle');
            this.overlay.setAttribute('data-status', 'idle');
            this.updateStatus('idle', 'Ready to start');
            this.resetPlayback('session');
            this.stopWordHighlighting();
            this.updateTranscript();
            const errorEl = this.overlay.querySelector('.voice-demo-error');
            if (errorEl) {
                errorEl.textContent = '';
            }
        }

        shouldBargeIn() {
            if (!this.enableBargeIn) return false;
            if (this.agentState !== 'speaking' && this.scheduledSources.size === 0) return false;

            const now = performance.now();
            const speakingFor = this.lastAgentSpeechAt ? now - this.lastAgentSpeechAt : 0;
            if (speakingFor < this.bargeInMinSpeakingMs) return false;

            if (Number.isFinite(this.bargeInMinLevel) && this.bargeInMinLevel > 0) {
                if (this.audioLevel < this.bargeInMinLevel) return false;
            }

            if (this.lastBargeInAt && now - this.lastBargeInAt < this.bargeInCooldownMs) return false;

            this.lastBargeInAt = now;
            this.ignoreAudioUntil = now + this.bargeInDropMs;
            return true;
        }

        resetPlayback(reason) {
            if (reason) {
                console.log('[VoiceDemo] Resetting playback:', reason);
            }
            this._audioLagWarned = false;
            this._audioIgnoreLogged = false;
            this.lastBargeInAt = null;
            this.ignoreAudioUntil = 0;
            if (this.scheduledSources.size > 0) {
                this.scheduledSources.forEach(source => {
                    try {
                        source.stop();
                    } catch (err) {
                        // noop
                    }
                });
                this.scheduledSources.clear();
            }
            if (this.audioContext) {
                this.playbackTime = this.audioContext.currentTime;
            } else {
                this.playbackTime = 0;
            }
        }

        // Visualizer
        startVisualizer() {
            if (this.animationFrame) return;

            const draw = () => {
                this.drawBars();
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

        drawBars() {
            if (!this.bars || !this.bars.length) return;

            // Smooth audio level
            this.smoothLevel += (this.audioLevel - this.smoothLevel) * 0.15;
            const level = this.status === 'connected' ? this.smoothLevel : 0;

            // Determine state for color class
            const stateClass = this.agentState || 'idle';
            if (this.barsContainer) {
                this.barsContainer.setAttribute('data-state', stateClass);
            }

            // Calculate target heights based on audio level and state
            const numBars = this.bars.length;
            const time = performance.now() / 1000;

            for (let i = 0; i < numBars; i++) {
                // Create wave-like pattern from center
                const centerOffset = Math.abs(i - numBars / 2) / (numBars / 2);
                const wavePhase = time * 3 + i * 0.3;

                let targetHeight;

                if (this.status === 'connected' && level > 0.01) {
                    // Active audio - dynamic height based on level
                    const baseHeight = 20 + (1 - centerOffset) * 30;
                    const audioResponse = level * 50 * (1 - centerOffset * 0.5);
                    const waveOffset = Math.sin(wavePhase) * 15 * level;
                    targetHeight = baseHeight + audioResponse + waveOffset;
                } else if (this.status === 'connected') {
                    // Connected but quiet - gentle idle animation
                    const idleWave = Math.sin(wavePhase * 0.5) * 8;
                    targetHeight = 20 + (1 - centerOffset) * 15 + idleWave;
                } else {
                    // Not connected - minimal static heights
                    targetHeight = 15 + (1 - centerOffset) * 10;
                }

                // Smooth transition to target
                this.barHeights[i] += (targetHeight - this.barHeights[i]) * 0.2;

                // Apply height to bar
                const height = Math.max(8, Math.min(95, this.barHeights[i]));
                this.bars[i].style.setProperty('--bar-height', `${height}%`);
            }
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

        base64ToArrayBuffer(base64) {
            const binary = atob(base64);
            const bytes = new Uint8Array(binary.length);
            for (let i = 0; i < binary.length; i++) {
                bytes[i] = binary.charCodeAt(i);
            }
            return bytes.buffer;
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
