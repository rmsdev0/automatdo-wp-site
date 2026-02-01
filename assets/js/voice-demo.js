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
            shortName: 'TPV',
            description: 'Third-party verification calls'
        },
        {
            id: 'fitness',
            name: 'FITNESS',
            shortName: 'FITNESS',
            description: 'Gym & fitness center support'
        },
        {
            id: 'home-services',
            name: 'HOME SERVICES',
            shortName: 'SERVICES',
            description: 'Contractor booking & scheduling'
        },
        {
            id: 'contact-center',
            name: 'CONTACT CENTER',
            shortName: 'SUPPORT',
            description: 'General customer support'
        },
        {
            id: 'multilingual',
            name: 'MULTILINGUAL',
            shortName: 'GLOBAL',
            description: 'Hotel concierge in 50+ languages'
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

    // Voice options per provider
    const VOICES = {
        openai: [
            { id: 'alloy', name: 'Alloy', description: 'Neutral & balanced' },
            { id: 'ash', name: 'Ash', description: 'Soft & thoughtful' },
            { id: 'ballad', name: 'Ballad', description: 'Warm & expressive' },
            { id: 'coral', name: 'Coral', description: 'Clear & friendly' },
            { id: 'echo', name: 'Echo', description: 'Calm & composed' },
            { id: 'sage', name: 'Sage', description: 'Wise & measured' },
            { id: 'shimmer', name: 'Shimmer', description: 'Bright & energetic' },
            { id: 'verse', name: 'Verse', description: 'Dynamic & engaging' }
        ],
        xai: [
            { id: 'Charon', name: 'Charon', description: 'Deep & authoritative' },
            { id: 'Clio', name: 'Clio', description: 'Warm & welcoming' },
            { id: 'Puck', name: 'Puck', description: 'Playful & energetic' },
            { id: 'Sage', name: 'Sage', description: 'Calm & professional' },
            { id: 'Sol', name: 'Sol', description: 'Bright & optimistic' },
            { id: 'Vale', name: 'Vale', description: 'Gentle & soothing' }
        ]
    };

    // Default voices per agent per provider
    const AGENT_DEFAULT_VOICES = {
        tpv: { openai: 'alloy', xai: 'Charon' },
        fitness: { openai: 'shimmer', xai: 'Clio' },
        'home-services': { openai: 'echo', xai: 'Puck' },
        'contact-center': { openai: 'sage', xai: 'Sage' },
        'multilingual': { openai: 'nova', xai: 'Clio' }
    };

    // Introduction modes
    const INTRO_MODES = [
        { id: 'full', name: 'Full', description: 'Complete introduction with all features' },
        { id: 'brief', name: 'Brief', description: 'Quick greeting and prompt' },
        { id: 'none', name: 'None', description: 'Agent waits for you to speak' }
    ];

    // localStorage key for settings
    const STORAGE_KEY = 'automatdo_voice_demo_settings';
    const EXIT_CTA_STORAGE_KEY = 'automatdo_exit_cta_count';

    // Exit CTA frequency settings
    const EXIT_CTA_SHOW_EVERY_N = 1; // Show CTA every time

    // Engagement thresholds for showing exit CTA
    const MIN_ENGAGEMENT_SECONDS = 10; // Must have demo open for at least 10 seconds
    const MIN_TRANSCRIPT_LENGTH = 1; // Must have at least 1 transcript entry

    const CONNECT_TIMEOUT_MS = 10000;
    const SESSION_TIMEOUT_MS = 10000;
    const MAX_PLAYBACK_LAG_SEC = 12;

    class VoiceDemo {
        constructor() {
            this.overlay = null;
            this.status = 'idle'; // idle, connecting, connected, error
            this.agentState = 'idle'; // idle, listening, thinking, speaking
            this.selectedAgent = 'fitness';
            this.selectedProvider = 'xai'; // 'openai' or 'xai'
            this.selectedVoice = null; // null = use agent default
            this.introMode = 'full'; // 'full', 'brief', 'none'
            this.transcript = [];
            this.isMuted = false;
            this.error = null;
            this.settingsOpen = false;

            // Load saved settings from localStorage
            this.loadSettings();

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

            // Exit intent CTA tracking
            this.exitCtaShown = false;
            this.exitCtaOpen = false;
            this.demoOpenedAt = null;
            this.hasHadConversation = false;

            // Rate limit and timeout tracking
            this.rateLimitModalOpen = false;
            this.timeoutWarningActive = false;
            this.timeoutSecondsRemaining = 0;
            this.timeoutCountdownInterval = null;

            // CRM context for Solutions page integration
            this.crmContext = null;

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
            const currentVoice = this.getCurrentVoice();
            const voices = VOICES[this.selectedProvider] || [];

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
                                    data-agent="${agent.id}"
                                    aria-label="${agent.name} - ${agent.description}">
                                <span class="voice-demo-tab-name">
                                    <span class="voice-demo-tab-name-full">${agent.name}</span>
                                    <span class="voice-demo-tab-name-short">${agent.shortName}</span>
                                </span>
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
                                <div class="voice-demo-start-group">
                                    <button class="voice-demo-start">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                                            <line x1="12" y1="19" x2="12" y2="23"/>
                                            <line x1="8" y1="23" x2="16" y2="23"/>
                                        </svg>
                                        <span>Start Live Conversation</span>
                                    </button>
                                    <button class="voice-demo-settings-btn" aria-label="Settings">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="3"/>
                                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                                        </svg>
                                    </button>
                                </div>

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

                    <!-- Settings Modal -->
                    <div class="voice-demo-settings-modal">
                        <div class="voice-demo-settings-content">
                            <div class="voice-demo-settings-header">
                                <h3>Demo Settings</h3>
                                <button class="voice-demo-settings-close" aria-label="Close settings">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M18 6L6 18M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>

                            <div class="voice-demo-settings-body">
                                <!-- Voice Selection -->
                                <div class="voice-demo-settings-group">
                                    <label class="voice-demo-settings-label">Voice</label>
                                    <select class="voice-demo-settings-select voice-demo-voice-select">
                                        ${voices.map(v => `
                                            <option value="${v.id}" ${v.id === currentVoice ? 'selected' : ''}>
                                                ${v.name} - ${v.description}
                                            </option>
                                        `).join('')}
                                    </select>
                                </div>

                                <!-- Introduction Mode -->
                                <div class="voice-demo-settings-group">
                                    <label class="voice-demo-settings-label">Introduction</label>
                                    <div class="voice-demo-intro-options">
                                        ${INTRO_MODES.map(mode => `
                                            <label class="voice-demo-intro-option ${mode.id === this.introMode ? 'selected' : ''}">
                                                <input type="radio" name="intro_mode" value="${mode.id}"
                                                    ${mode.id === this.introMode ? 'checked' : ''}>
                                                <span class="voice-demo-intro-option-content">
                                                    <span class="voice-demo-intro-option-name">${mode.name}</span>
                                                    <span class="voice-demo-intro-option-desc">${mode.description}</span>
                                                </span>
                                            </label>
                                        `).join('')}
                                    </div>
                                </div>
                            </div>

                            <div class="voice-demo-settings-footer">
                                <button class="voice-demo-settings-done">Done</button>
                            </div>
                        </div>
                    </div>

                    <!-- Exit Intent CTA Modal -->
                    <div class="voice-demo-exit-cta" role="dialog" aria-labelledby="exit-cta-title" aria-describedby="exit-cta-desc">
                        <div class="voice-demo-exit-cta-content">
                            <div class="voice-demo-exit-cta-header">
                                <div class="voice-demo-exit-cta-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                                        <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                                        <line x1="12" y1="19" x2="12" y2="23"/>
                                        <line x1="8" y1="23" x2="16" y2="23"/>
                                        <circle cx="19" cy="5" r="3" fill="currentColor" stroke="none"/>
                                    </svg>
                                </div>
                                <h3 id="exit-cta-title" class="voice-demo-exit-cta-title">See Voice AI Built for Your Business</h3>
                            </div>

                            <p id="exit-cta-desc" class="voice-demo-exit-cta-description">
                                You've experienced our <span class="voice-demo-exit-cta-agent"></span> demo.
                                Now imagine voice AI customized for your exact workflows, terminology, and customer needs.
                            </p>

                            <ul class="voice-demo-exit-cta-benefits">
                                <li>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                        <polyline points="22 4 12 14.01 9 11.01"/>
                                    </svg>
                                    Personalized demo with your use cases
                                </li>
                                <li>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                        <polyline points="22 4 12 14.01 9 11.01"/>
                                    </svg>
                                    Custom voice and conversation flow
                                </li>
                                <li>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                        <polyline points="22 4 12 14.01 9 11.01"/>
                                    </svg>
                                    Integration with your existing systems
                                </li>
                            </ul>

                            <div class="voice-demo-exit-cta-actions">
                                <a href="#demo" class="voice-demo-exit-cta-primary">
                                    <span>Schedule Your Custom Demo</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M5 12h14M12 5l7 7-7 7"/>
                                    </svg>
                                </a>
                                <button type="button" class="voice-demo-exit-cta-secondary">
                                    No thanks, close demo
                                </button>
                            </div>

                            <p class="voice-demo-exit-cta-trust">
                                Trusted by businesses in energy, fitness, home services, and more.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Rate Limit / Session Timeout Modal (outside .voice-demo-modal for full overlay coverage) -->
                <div class="voice-demo-rate-limit-modal" role="dialog" aria-labelledby="rate-limit-title" aria-describedby="rate-limit-desc">
                    <div class="voice-demo-rate-limit-content">
                        <div class="voice-demo-rate-limit-header">
                            <div class="voice-demo-rate-limit-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/>
                                    <path d="M12 6v6l4 2"/>
                                </svg>
                            </div>
                            <h3 id="rate-limit-title" class="voice-demo-rate-limit-title">Thanks for Trying Our Demo!</h3>
                        </div>

                        <p id="rate-limit-desc" class="voice-demo-rate-limit-description">
                            We're a small team building something we're really proud of. While we'd love to let you explore endlessly, we need to keep our demo costs manageable as we grow.
                        </p>

                        <p class="voice-demo-rate-limit-message"></p>

                        <div class="voice-demo-rate-limit-highlight">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 12l2 2 4-4"/>
                                <circle cx="12" cy="12" r="10"/>
                            </svg>
                            <span>The good news? We'd love to show you a personalized demo built specifically for YOUR business needs.</span>
                        </div>

                        <div class="voice-demo-rate-limit-actions">
                            <a href="#demo" class="voice-demo-rate-limit-primary">
                                <span>Schedule a Demo</span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </a>
                            <button type="button" class="voice-demo-rate-limit-secondary">
                                Close
                            </button>
                        </div>

                        <p class="voice-demo-rate-limit-footer">
                            Questions? Reach out anytime - we're here to help.
                        </p>
                    </div>
                </div>

                <!-- Session Timeout Warning Toast -->
                <div class="voice-demo-timeout-toast" role="alert" aria-live="polite">
                    <div class="voice-demo-timeout-toast-content">
                        <div class="voice-demo-timeout-toast-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 6v6l4 2"/>
                            </svg>
                        </div>
                        <div class="voice-demo-timeout-toast-text">
                            <span class="voice-demo-timeout-toast-title">Session ending soon</span>
                            <span class="voice-demo-timeout-toast-countdown">
                                <span class="voice-demo-timeout-seconds">60</span> seconds remaining
                            </span>
                        </div>
                    </div>
                </div>
            `;
        }

        getCurrentVoice() {
            if (this.selectedVoice) {
                // Verify the voice exists for current provider
                const providerVoices = VOICES[this.selectedProvider] || [];
                if (providerVoices.find(v => v.id === this.selectedVoice)) {
                    return this.selectedVoice;
                }
            }
            // Fall back to agent default
            return AGENT_DEFAULT_VOICES[this.selectedAgent]?.[this.selectedProvider] ||
                   VOICES[this.selectedProvider]?.[0]?.id || 'alloy';
        }

        loadSettings() {
            try {
                const saved = localStorage.getItem(STORAGE_KEY);
                if (saved) {
                    const settings = JSON.parse(saved);
                    this.selectedProvider = settings.provider || 'xai';
                    this.selectedVoice = settings.voice || null;
                    this.introMode = settings.introMode || 'full';
                }
            } catch (e) {
                console.warn('[VoiceDemo] Failed to load settings:', e);
            }
        }

        saveSettings() {
            try {
                localStorage.setItem(STORAGE_KEY, JSON.stringify({
                    provider: this.selectedProvider,
                    voice: this.selectedVoice,
                    introMode: this.introMode
                }));
            } catch (e) {
                console.warn('[VoiceDemo] Failed to save settings:', e);
            }
        }

        /**
         * Set CRM context for the voice agent
         * Called from Solutions page to pass customer data to the agent
         * @param {Object} data - Customer data from CRM panel
         */
        setCRMContext(data) {
            if (!data) {
                this.crmContext = null;
                return;
            }

            this.crmContext = {
                customer_name: `${data.firstName} ${data.lastName}`,
                phone: data.realPhone || data.phone,
                industry: data.industry || null,
                context_label: data.contextMeta || null,
                ...data
            };

            console.log('[VoiceDemo] CRM context set:', this.crmContext);
        }

        /**
         * Clear CRM context
         */
        clearCRMContext() {
            this.crmContext = null;
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
                    if (this.rateLimitModalOpen) {
                        this.dismissRateLimitAndClose();
                    } else if (this.exitCtaOpen) {
                        this.dismissExitCtaAndClose();
                    } else if (this.settingsOpen) {
                        this.closeSettings();
                    } else {
                        this.close();
                    }
                }
            });

            // Provider toggle
            this.overlay.querySelectorAll('.voice-demo-provider').forEach(btn => {
                btn.addEventListener('click', () => {
                    this.selectProvider(btn.dataset.provider);
                });
            });

            // Settings button
            this.overlay.querySelector('.voice-demo-settings-btn').addEventListener('click', () => this.openSettings());

            // Settings close button
            this.overlay.querySelector('.voice-demo-settings-close').addEventListener('click', () => this.closeSettings());

            // Settings done button
            this.overlay.querySelector('.voice-demo-settings-done').addEventListener('click', () => this.closeSettings());

            // Settings modal backdrop click
            this.overlay.querySelector('.voice-demo-settings-modal').addEventListener('click', (e) => {
                if (e.target.classList.contains('voice-demo-settings-modal')) {
                    this.closeSettings();
                }
            });

            // Voice selection change
            this.overlay.querySelector('.voice-demo-voice-select').addEventListener('change', (e) => {
                this.selectedVoice = e.target.value;
                this.saveSettings();
            });

            // Intro mode selection
            this.overlay.querySelectorAll('input[name="intro_mode"]').forEach(radio => {
                radio.addEventListener('change', (e) => {
                    this.introMode = e.target.value;
                    this.saveSettings();
                    this.updateIntroModeUI();
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

            // Exit CTA modal events
            const exitCtaModal = this.overlay.querySelector('.voice-demo-exit-cta');
            if (exitCtaModal) {
                // Primary CTA button - close modal and navigate to demo section
                const primaryBtn = exitCtaModal.querySelector('.voice-demo-exit-cta-primary');
                if (primaryBtn) {
                    primaryBtn.addEventListener('click', () => this.dismissExitCtaAndClose());
                }

                // Secondary button - dismiss and close
                const secondaryBtn = exitCtaModal.querySelector('.voice-demo-exit-cta-secondary');
                if (secondaryBtn) {
                    secondaryBtn.addEventListener('click', () => this.dismissExitCtaAndClose());
                }

                // Click outside the CTA content to dismiss
                exitCtaModal.addEventListener('click', (e) => {
                    if (e.target === exitCtaModal) {
                        this.dismissExitCtaAndClose();
                    }
                });
            }

            // Rate limit modal events
            const rateLimitModal = this.overlay.querySelector('.voice-demo-rate-limit-modal');
            if (rateLimitModal) {
                // Primary CTA button - close modal and navigate to demo section
                const primaryBtn = rateLimitModal.querySelector('.voice-demo-rate-limit-primary');
                if (primaryBtn) {
                    primaryBtn.addEventListener('click', () => this.dismissRateLimitAndClose());
                }

                // Secondary button - dismiss and close
                const secondaryBtn = rateLimitModal.querySelector('.voice-demo-rate-limit-secondary');
                if (secondaryBtn) {
                    secondaryBtn.addEventListener('click', () => this.dismissRateLimitAndClose());
                }

                // Click outside the content to dismiss
                rateLimitModal.addEventListener('click', (e) => {
                    if (e.target === rateLimitModal) {
                        this.dismissRateLimitAndClose();
                    }
                });
            }
        }

        open() {
            this.overlay.classList.add('active');
            document.body.classList.add('voice-demo-open');
            this.startVisualizer();
            this.demoOpenedAt = Date.now();
        }

        close() {
            // Check if we should show exit intent CTA
            if (this.shouldShowExitCta()) {
                this.showExitCta();
                return;
            }

            this.performClose();
        }

        performClose() {
            // Increment demo count for exit CTA frequency tracking
            this.incrementDemoCount();

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

        incrementDemoCount() {
            try {
                const count = parseInt(localStorage.getItem(EXIT_CTA_STORAGE_KEY) || '0', 10);
                localStorage.setItem(EXIT_CTA_STORAGE_KEY, String(count + 1));
            } catch (e) {
                // localStorage not available
            }
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

            // Reset exit CTA tracking for next demo session
            this.exitCtaShown = false;
            this.exitCtaOpen = false;
            this.demoOpenedAt = null;
            this.hasHadConversation = false;

            // Reset rate limit and timeout tracking
            this.rateLimitModalOpen = false;
            this.timeoutWarningActive = false;
            this.timeoutSecondsRemaining = 0;
            if (this.timeoutCountdownInterval) {
                clearInterval(this.timeoutCountdownInterval);
                this.timeoutCountdownInterval = null;
            }
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
            this.updateVoiceSelect();
            this.saveSettings();
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

        openSettings() {
            this.settingsOpen = true;
            this.overlay.querySelector('.voice-demo-settings-modal').classList.add('active');
            this.updateVoiceSelect();
            this.updateIntroModeUI();
        }

        closeSettings() {
            this.settingsOpen = false;
            this.overlay.querySelector('.voice-demo-settings-modal').classList.remove('active');
        }

        // Exit Intent CTA Methods
        shouldShowExitCta() {
            // Don't show if already shown this demo session
            if (this.exitCtaShown || this.exitCtaOpen) {
                return false;
            }

            // Check if user has had meaningful engagement
            const timeSpent = this.demoOpenedAt ? (Date.now() - this.demoOpenedAt) / 1000 : 0;
            const hasEngaged = timeSpent >= MIN_ENGAGEMENT_SECONDS ||
                               this.transcript.length >= MIN_TRANSCRIPT_LENGTH ||
                               this.hasHadConversation;

            if (!hasEngaged) {
                return false;
            }

            // Check demo count - show CTA every Nth demo
            try {
                const count = parseInt(localStorage.getItem(EXIT_CTA_STORAGE_KEY) || '0', 10);
                // Show on 1st, 4th, 7th, etc. (every 3rd starting from 1)
                return count % EXIT_CTA_SHOW_EVERY_N === 0;
            } catch (e) {
                // localStorage not available, show CTA
                return true;
            }
        }

        showExitCta() {
            this.exitCtaOpen = true;
            this.exitCtaShown = true;

            // Update the agent name in the CTA
            const agentNameEl = this.overlay.querySelector('.voice-demo-exit-cta-agent');
            if (agentNameEl) {
                const agent = AGENTS.find(a => a.id === this.selectedAgent);
                agentNameEl.textContent = agent ? agent.name.toLowerCase() : 'voice agent';
            }

            // Show the CTA modal
            const ctaModal = this.overlay.querySelector('.voice-demo-exit-cta');
            if (ctaModal) {
                ctaModal.classList.add('active');

                // Focus the primary CTA button for accessibility
                const primaryBtn = ctaModal.querySelector('.voice-demo-exit-cta-primary');
                if (primaryBtn) {
                    setTimeout(() => primaryBtn.focus(), 100);
                }
            }
        }

        hideExitCta() {
            this.exitCtaOpen = false;
            const ctaModal = this.overlay.querySelector('.voice-demo-exit-cta');
            if (ctaModal) {
                ctaModal.classList.remove('active');
            }
        }

        dismissExitCtaAndClose() {
            this.hideExitCta();
            this.performClose();
        }

        // Rate Limit & Session Timeout Methods
        handleRateLimit(msg) {
            console.log('[VoiceDemo] Rate limit received:', msg);

            // Disconnect if connected
            if (this.status === 'connected' || this.status === 'connecting') {
                this.cleanup();
                this.setStatus('idle');
            }

            // Update modal title based on error type
            const titleEl = this.overlay.querySelector('.voice-demo-rate-limit-title');
            const messageEl = this.overlay.querySelector('.voice-demo-rate-limit-message');

            if (msg.error_type === 'daily_limit') {
                if (titleEl) titleEl.textContent = 'You\'ve Reached Today\'s Demo Limit';
                if (messageEl) {
                    const limit = msg.remaining?.daily_limit || 10;
                    messageEl.textContent = `Each visitor gets ${limit} demo sessions per day to keep things fair for everyone exploring our technology.`;
                }
            } else if (msg.error_type === 'concurrent_limit') {
                if (titleEl) titleEl.textContent = 'Demo Currently Busy';
                if (messageEl) {
                    messageEl.textContent = 'Our demo is experiencing high demand right now. Please try again in a moment, or schedule a private demo for uninterrupted access.';
                }
            } else {
                if (titleEl) titleEl.textContent = 'Thanks for Trying Our Demo!';
                if (messageEl) {
                    messageEl.textContent = msg.message || 'Demo limit reached. We appreciate your interest!';
                }
            }

            this.showRateLimitModal();
        }

        handleSessionTimeout(msg) {
            console.log('[VoiceDemo] Session timeout:', msg);

            // Hide the warning toast if showing
            this.hideTimeoutWarning();

            // Disconnect
            if (this.status === 'connected') {
                this.cleanup();
                this.setStatus('idle');
            }

            // Update modal for timeout
            const titleEl = this.overlay.querySelector('.voice-demo-rate-limit-title');
            const messageEl = this.overlay.querySelector('.voice-demo-rate-limit-message');

            if (titleEl) titleEl.textContent = 'Demo Session Complete';
            if (messageEl) {
                messageEl.textContent = 'Your 10-minute demo session has ended. We hope you got a taste of what our voice AI can do!';
            }

            this.showRateLimitModal();
        }

        showRateLimitModal() {
            this.rateLimitModalOpen = true;

            const modal = this.overlay.querySelector('.voice-demo-rate-limit-modal');
            if (modal) {
                modal.classList.add('active');

                // Focus the primary button for accessibility
                const primaryBtn = modal.querySelector('.voice-demo-rate-limit-primary');
                if (primaryBtn) {
                    setTimeout(() => primaryBtn.focus(), 100);
                }
            }
        }

        hideRateLimitModal() {
            this.rateLimitModalOpen = false;

            const modal = this.overlay.querySelector('.voice-demo-rate-limit-modal');
            if (modal) {
                modal.classList.remove('active');
            }
        }

        dismissRateLimitAndClose() {
            this.hideRateLimitModal();
            this.performClose();
        }

        showTimeoutWarning(remainingSeconds) {
            console.log('[VoiceDemo] Session timeout warning:', remainingSeconds, 'seconds remaining');

            this.timeoutWarningActive = true;
            this.timeoutSecondsRemaining = remainingSeconds;

            const toast = this.overlay.querySelector('.voice-demo-timeout-toast');
            const secondsEl = this.overlay.querySelector('.voice-demo-timeout-seconds');

            if (secondsEl) {
                secondsEl.textContent = remainingSeconds;
            }

            if (toast) {
                toast.classList.add('active');
            }

            // Start countdown timer
            this.startTimeoutCountdown();
        }

        hideTimeoutWarning() {
            this.timeoutWarningActive = false;

            // Clear countdown interval
            if (this.timeoutCountdownInterval) {
                clearInterval(this.timeoutCountdownInterval);
                this.timeoutCountdownInterval = null;
            }

            const toast = this.overlay.querySelector('.voice-demo-timeout-toast');
            if (toast) {
                toast.classList.remove('active');
            }
        }

        startTimeoutCountdown() {
            // Clear any existing interval
            if (this.timeoutCountdownInterval) {
                clearInterval(this.timeoutCountdownInterval);
            }

            const secondsEl = this.overlay.querySelector('.voice-demo-timeout-seconds');

            this.timeoutCountdownInterval = setInterval(() => {
                this.timeoutSecondsRemaining--;

                if (secondsEl) {
                    secondsEl.textContent = Math.max(0, this.timeoutSecondsRemaining);
                }

                // Add urgency class when under 30 seconds
                const toast = this.overlay.querySelector('.voice-demo-timeout-toast');
                if (toast && this.timeoutSecondsRemaining <= 30) {
                    toast.classList.add('urgent');
                }

                if (this.timeoutSecondsRemaining <= 0) {
                    this.hideTimeoutWarning();
                }
            }, 1000);
        }

        updateVoiceSelect() {
            const select = this.overlay.querySelector('.voice-demo-voice-select');
            if (!select) return;

            const voices = VOICES[this.selectedProvider] || [];
            const currentVoice = this.getCurrentVoice();

            select.innerHTML = voices.map(v => `
                <option value="${v.id}" ${v.id === currentVoice ? 'selected' : ''}>
                    ${v.name} - ${v.description}
                </option>
            `).join('');

            // Update selected voice to match current provider
            this.selectedVoice = currentVoice;
        }

        updateIntroModeUI() {
            this.overlay.querySelectorAll('.voice-demo-intro-option').forEach(option => {
                const radio = option.querySelector('input');
                option.classList.toggle('selected', radio.value === this.introMode);
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
                console.log('[VoiceDemo] Creating new AudioContext...');
                this.audioContext = new (window.AudioContext || window.webkitAudioContext)({
                    sampleRate: 16000
                });
                console.log('[VoiceDemo] AudioContext created, state:', this.audioContext.state);

                // Resume audio context (required after user interaction)
                if (this.audioContext.state === 'suspended') {
                    console.log('[VoiceDemo] AudioContext suspended, resuming...');
                    await this.audioContext.resume();
                    console.log('[VoiceDemo] AudioContext resumed, state:', this.audioContext.state);
                }
                this.inputSampleRate = this.audioContext.sampleRate || 16000;
                console.log('[VoiceDemo] AudioContext ready - state:', this.audioContext.state, 'sampleRate:', this.inputSampleRate);

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
                    // Send start message with provider and settings
                    const startMessage = {
                        type: 'start',
                        agent_id: this.selectedAgent,
                        provider: this.selectedProvider,
                        voice: this.getCurrentVoice(),
                        intro_mode: this.introMode,
                        config: { sample_rate: this.inputSampleRate }
                    };

                    // Include CRM context if set (from Solutions page)
                    if (this.crmContext) {
                        startMessage.crm_context = this.crmContext;
                    }

                    this.ws.send(JSON.stringify(startMessage));
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

                case 'rate_limit':
                    this.handleRateLimit(msg);
                    break;

                case 'session_timeout_warning':
                    this.showTimeoutWarning(msg.remaining_seconds);
                    break;

                case 'session_timeout':
                    this.handleSessionTimeout(msg);
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

            // Track engagement for exit intent CTA
            this.hasHadConversation = true;

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
                if (this._audioQueueCount <= 3) {
                    console.warn('[VoiceDemo] No audioContext - cannot play audio');
                }
                return;
            }
            if (this.audioContext.state === 'closed') {
                if (this._audioQueueCount <= 3) {
                    console.warn('[VoiceDemo] AudioContext is closed - cannot play audio');
                }
                return;
            }
            if (this.audioContext.state === 'suspended') {
                console.log('[VoiceDemo] AudioContext suspended, attempting to resume...');
                this.audioContext.resume().catch(err => console.error('[VoiceDemo] Failed to resume AudioContext:', err));
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

            // Reset audio counters for next session
            this._audioQueueCount = 0;
            this._audioPlayCount = 0;

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
