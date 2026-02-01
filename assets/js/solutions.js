/**
 * Solutions Page - Interactive Demo Experience
 * Handles tab navigation, CRM data management, SMS flow, and journey tracking
 */

(function() {
    'use strict';

    // =========================================================================
    // Industry-specific CRM Demo Data
    // =========================================================================

    const CRM_DATA = {
        tpv: {
            firstName: 'Maria',
            lastName: 'Rodriguez',
            phone: '(512) 555-0147',
            fields: [
                { id: 'accountId', label: 'Account ID', value: 'ENR-2024-9847' },
                { id: 'currentProvider', label: 'Current Provider', value: 'Incumbent Electric Co.' },
                { id: 'newPlan', label: 'New Plan', value: '12-Month Fixed Rate - 8.5¢/kWh' },
                { id: 'address', label: 'Service Address', value: '1234 Oak Street, Austin, TX 78701' },
                { id: 'enrollmentDate', label: 'Enrollment Date', value: 'January 15, 2025' }
            ],
            history: [
                { date: 'Jan 14', event: 'Sales call - agreed to switch', agent: 'Field Rep' },
                { date: 'Jan 15', event: 'Enrollment submitted', agent: 'System' },
                { date: 'Jan 15', event: 'TPV verification pending', agent: 'System' }
            ],
            contextMeta: 'TPV Verification'
        },
        fitness: {
            firstName: 'Sarah',
            lastName: 'Chen',
            phone: '(415) 555-0823',
            fields: [
                { id: 'memberId', label: 'Member ID', value: 'FIT-2024-5521' },
                { id: 'membershipType', label: 'Membership', value: 'Premium Monthly' },
                { id: 'joinDate', label: 'Member Since', value: 'March 2023' },
                { id: 'lastVisit', label: 'Last Visit', value: '2 days ago' },
                { id: 'classesThisMonth', label: 'Classes This Month', value: '8' },
                { id: 'renewalDate', label: 'Renewal Date', value: 'February 15, 2025' }
            ],
            history: [
                { date: 'Jan 10', event: 'Attended yoga class', agent: 'System' },
                { date: 'Jan 8', event: 'Called about upgrade options', agent: 'AI Agent' },
                { date: 'Dec 28', event: 'Purchased personal training', agent: 'Staff' }
            ],
            contextMeta: 'Fitness Membership'
        },
        'home-services': {
            firstName: 'James',
            lastName: 'Wilson',
            phone: '(972) 555-0234',
            fields: [
                { id: 'serviceType', label: 'Service Type', value: 'HVAC Maintenance' },
                { id: 'propertyAddress', label: 'Property Address', value: '456 Maple Drive, Dallas, TX 75201' },
                { id: 'preferredTime', label: 'Preferred Time', value: 'Morning (8am-12pm)' },
                { id: 'lastService', label: 'Last Service', value: 'June 2024' },
                { id: 'equipmentAge', label: 'Equipment Age', value: '8 years' }
            ],
            history: [
                { date: 'Jun 24', event: 'Annual maintenance completed', agent: 'Tech #234' },
                { date: 'Jan 10', event: 'Reminder call - service due', agent: 'AI Agent' },
                { date: 'Jan 12', event: 'Appointment requested', agent: 'Customer' }
            ],
            contextMeta: 'Home Services'
        },
        'contact-center': {
            firstName: 'Alex',
            lastName: 'Thompson',
            phone: '(305) 555-0189',
            fields: [
                { id: 'customerId', label: 'Customer ID', value: 'CUST-78234' },
                { id: 'accountType', label: 'Account Type', value: 'Business Pro' },
                { id: 'lastContact', label: 'Last Contact', value: '3 weeks ago' },
                { id: 'openTickets', label: 'Open Tickets', value: '1' },
                { id: 'lifetimeValue', label: 'Lifetime Value', value: '$4,250' }
            ],
            history: [
                { date: 'Dec 20', event: 'Billing inquiry - resolved', agent: 'AI Agent' },
                { date: 'Jan 5', event: 'Feature request submitted', agent: 'Customer' },
                { date: 'Jan 10', event: 'Follow-up scheduled', agent: 'System' }
            ],
            contextMeta: 'Business Support'
        }
    };

    // SMS Flow Demo Data
    const SMS_FLOWS = {
        tpv: [
            {
                type: 'incoming',
                text: 'Hi Maria! Your enrollment with CleanEnergy Co. is almost complete. Reply YES to confirm your switch, or HELP for questions.',
                time: '2:35 PM'
            },
            {
                type: 'action',
                buttons: ['YES', 'HELP']
            }
        ],
        fitness: [
            {
                type: 'incoming',
                text: 'Hi Sarah! Your Premium membership renews in 5 days. Reply RENEW to confirm, or CALL to speak with us about options.',
                time: '10:15 AM'
            },
            {
                type: 'action',
                buttons: ['RENEW', 'CALL']
            }
        ],
        'home-services': [
            {
                type: 'incoming',
                text: 'Hi James! Your HVAC appointment is confirmed for tomorrow 8am-12pm. Reply YES to confirm or RESCHEDULE to change.',
                time: '4:30 PM'
            },
            {
                type: 'action',
                buttons: ['YES', 'RESCHEDULE']
            }
        ],
        'contact-center': [
            {
                type: 'incoming',
                text: 'Hi Alex! Your support ticket #4521 has been updated. Reply VIEW for details or CALL to speak with an agent.',
                time: '11:45 AM'
            },
            {
                type: 'action',
                buttons: ['VIEW', 'CALL']
            }
        ]
    };

    const SMS_RESPONSES = {
        YES: [
            { type: 'outgoing', text: 'YES', time: '' },
            { type: 'incoming', text: 'Great! Your enrollment is confirmed. Confirmation #: ENR-9847. Your new service starts Feb 1st. Questions? Reply HELP or call 1-800-555-0123.', time: '' },
            { type: 'system', text: 'CRM Updated: Status → Confirmed' }
        ],
        HELP: [
            { type: 'outgoing', text: 'HELP', time: '' },
            { type: 'incoming', text: 'Need help? A representative will call you within 5 minutes. Or call us directly at 1-800-555-0123. Reply CANCEL to stop the callback.', time: '' }
        ],
        RENEW: [
            { type: 'outgoing', text: 'RENEW', time: '' },
            { type: 'incoming', text: 'Awesome! Your Premium membership has been renewed for another month. Thank you for staying with us!', time: '' },
            { type: 'system', text: 'CRM Updated: Renewal → Complete' }
        ],
        CALL: [
            { type: 'outgoing', text: 'CALL', time: '' },
            { type: 'incoming', text: 'A team member will call you shortly. Estimated wait: less than 2 minutes.', time: '' }
        ],
        RESCHEDULE: [
            { type: 'outgoing', text: 'RESCHEDULE', time: '' },
            { type: 'incoming', text: 'No problem! Reply with your preferred date and time, or call us at 1-800-555-0234 to reschedule.', time: '' }
        ],
        VIEW: [
            { type: 'outgoing', text: 'VIEW', time: '' },
            { type: 'incoming', text: 'Ticket #4521: Your feature request has been added to our roadmap. Expected release: Q2 2025. Thanks for your feedback!', time: '' },
            { type: 'system', text: 'CRM Updated: Ticket viewed' }
        ]
    };

    // =========================================================================
    // State Management
    // =========================================================================

    const state = {
        currentTab: 'crm',
        currentIndustry: 'tpv',
        visitedTabs: new Set(['crm']),
        smsEnabled: false,
        realPhone: '',
        isCallActive: false,
        smsFlowStep: 0,
        crmData: JSON.parse(JSON.stringify(CRM_DATA.tpv))
    };

    // =========================================================================
    // Initialization
    // =========================================================================

    document.addEventListener('DOMContentLoaded', function() {
        // Only initialize if we're on the solutions demo page
        if (!document.querySelector('.solutions-demo-experience')) return;

        initTabs();
        initIndustrySelector();
        initCRMFields();
        initSMSToggle();
        initVoiceDemo();
        initSMSFlow();
        initCampaignAnimations();
        initJourneyProgress();
        initMobileWizard();
        initModalHandlers();
        initExportButton();

        // Load CRM data for initial industry
        loadIndustryData('tpv');
    });

    // =========================================================================
    // Tab Navigation
    // =========================================================================

    function initTabs() {
        const tabButtons = document.querySelectorAll('.tab-btn');

        tabButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.disabled || state.isCallActive) return;

                const tabId = this.dataset.tab;
                switchTab(tabId);
            });
        });
    }

    function switchTab(tabId) {
        // Update state
        state.currentTab = tabId;
        state.visitedTabs.add(tabId);

        // Update tab buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.tab === tabId);
        });

        // Update panels
        document.querySelectorAll('.solutions-panel').forEach(panel => {
            panel.classList.toggle('active', panel.dataset.panel === tabId);
        });

        // Update journey progress
        updateJourneyProgress();

        // Update mobile wizard
        updateMobileWizard();

        // Trigger animations for campaigns panel
        if (tabId === 'campaigns') {
            animateCampaignStats();
        }

        // Check for journey completion
        checkJourneyCompletion();
    }

    function setTabsDisabled(disabled) {
        document.querySelectorAll('.tab-btn').forEach(btn => {
            if (btn.dataset.tab !== state.currentTab) {
                btn.disabled = disabled;
            }
        });
    }

    // =========================================================================
    // Industry Selector
    // =========================================================================

    function initIndustrySelector() {
        const industryTabs = document.querySelectorAll('.industry-tab');

        industryTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const industryId = this.dataset.industry;
                selectIndustry(industryId);
            });
        });
    }

    function selectIndustry(industryId) {
        state.currentIndustry = industryId;

        // Update UI
        document.querySelectorAll('.industry-tab').forEach(tab => {
            tab.classList.toggle('active', tab.dataset.industry === industryId);
        });

        // Load data
        loadIndustryData(industryId);
    }

    function loadIndustryData(industryId) {
        const data = CRM_DATA[industryId];
        if (!data) return;

        // Store current data
        state.crmData = JSON.parse(JSON.stringify(data));

        // Update name fields
        document.getElementById('crm-firstName').value = data.firstName;
        document.getElementById('crm-lastName').value = data.lastName;
        document.getElementById('crm-phone').value = data.phone;

        // Update avatar
        updateAvatar(data.firstName, data.lastName);

        // Update details grid
        const detailsGrid = document.getElementById('crm-details-grid');
        detailsGrid.innerHTML = data.fields.map(field => `
            <div class="detail-field">
                <label class="field-label">${field.label}</label>
                <input type="text" class="field-input" id="crm-${field.id}" value="${field.value}">
            </div>
        `).join('');

        // Update history
        const historyContainer = document.getElementById('crm-history');
        historyContainer.innerHTML = data.history.map(item => `
            <div class="history-item">
                <span class="history-date">${item.date}</span>
                <span class="history-event">${item.event}</span>
                <span class="history-agent">${item.agent}</span>
            </div>
        `).join('');

        // Update voice panel context
        updateVoiceContext();

        // Reset SMS flow
        resetSMSFlow();
    }

    function updateAvatar(firstName, lastName) {
        const initials = (firstName.charAt(0) + lastName.charAt(0)).toUpperCase();

        const crmAvatar = document.querySelector('#crm-avatar .avatar-initials');
        const voiceAvatar = document.getElementById('voice-avatar');

        if (crmAvatar) crmAvatar.textContent = initials;
        if (voiceAvatar) voiceAvatar.textContent = initials;
    }

    // =========================================================================
    // CRM Fields
    // =========================================================================

    function initCRMFields() {
        // Listen for changes to name fields
        const firstNameInput = document.getElementById('crm-firstName');
        const lastNameInput = document.getElementById('crm-lastName');

        if (firstNameInput) {
            firstNameInput.addEventListener('input', function() {
                state.crmData.firstName = this.value;
                updateAvatar(this.value, lastNameInput.value);
                updateVoiceContext();
            });
        }

        if (lastNameInput) {
            lastNameInput.addEventListener('input', function() {
                state.crmData.lastName = this.value;
                updateAvatar(firstNameInput.value, this.value);
                updateVoiceContext();
            });
        }

        // Phone field
        const phoneInput = document.getElementById('crm-phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function() {
                state.crmData.phone = this.value;
            });
        }
    }

    // =========================================================================
    // SMS Toggle
    // =========================================================================

    function initSMSToggle() {
        const toggle = document.getElementById('sms-toggle');
        const realPhoneContainer = document.getElementById('real-phone-container');
        const realPhoneInput = document.getElementById('crm-realPhone');

        if (toggle) {
            toggle.addEventListener('change', function() {
                state.smsEnabled = this.checked;
                realPhoneContainer.style.display = this.checked ? 'block' : 'none';

                // Update SMS panel status
                const realStatus = document.getElementById('sms-real-status');
                if (realStatus) {
                    realStatus.style.display = this.checked && state.realPhone ? 'flex' : 'none';
                }
            });
        }

        if (realPhoneInput) {
            realPhoneInput.addEventListener('input', function() {
                state.realPhone = this.value;

                // Update display
                const realNumber = document.getElementById('real-sms-number');
                if (realNumber) {
                    realNumber.textContent = this.value;
                }

                const realStatus = document.getElementById('sms-real-status');
                if (realStatus) {
                    realStatus.style.display = this.value ? 'flex' : 'none';
                }
            });
        }
    }

    // =========================================================================
    // Voice Demo Integration
    // =========================================================================

    function initVoiceDemo() {
        // Start demo button
        const startBtn = document.getElementById('btn-start-voice-demo');
        if (startBtn) {
            startBtn.addEventListener('click', function() {
                // Collect CRM data
                const crmContext = collectCRMData();

                // Switch to voice tab
                switchTab('voice');

                // Pass data to voice demo if available
                if (window.voiceDemo) {
                    window.voiceDemo.setCRMContext(crmContext);
                    window.voiceDemo.selectAgent(state.currentIndustry);
                }
            });
        }

        // Edit CRM button
        const editBtn = document.getElementById('btn-edit-crm');
        if (editBtn) {
            editBtn.addEventListener('click', function() {
                switchTab('crm');
            });
        }

        // Voice controls
        const voiceStartBtn = document.getElementById('voice-btn-start');
        const voiceEndBtn = document.getElementById('voice-btn-end');
        const voiceMuteBtn = document.getElementById('voice-btn-mute');

        if (voiceStartBtn) {
            voiceStartBtn.addEventListener('click', function() {
                startVoiceDemo();
            });
        }

        if (voiceEndBtn) {
            voiceEndBtn.addEventListener('click', function() {
                endVoiceDemo();
            });
        }

        if (voiceMuteBtn) {
            voiceMuteBtn.addEventListener('click', function() {
                this.classList.toggle('muted');
            });
        }

        // Provider buttons
        document.querySelectorAll('.provider-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.provider-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // View compliance button
        const viewComplianceBtn = document.getElementById('btn-view-compliance');
        if (viewComplianceBtn) {
            viewComplianceBtn.addEventListener('click', function() {
                document.getElementById('post-call-prompt').style.display = 'none';
                switchTab('compliance');
            });
        }
    }

    function updateVoiceContext() {
        const nameEl = document.getElementById('voice-customer-name');
        const metaEl = document.getElementById('voice-customer-meta');
        const data = CRM_DATA[state.currentIndustry];

        if (nameEl) {
            const firstName = document.getElementById('crm-firstName')?.value || data.firstName;
            const lastName = document.getElementById('crm-lastName')?.value || data.lastName;
            nameEl.textContent = `${firstName} ${lastName}`;
        }

        if (metaEl && data) {
            const accountField = data.fields[0];
            metaEl.textContent = `${data.contextMeta} • ${accountField.value}`;
        }
    }

    function collectCRMData() {
        const data = {
            firstName: document.getElementById('crm-firstName')?.value || '',
            lastName: document.getElementById('crm-lastName')?.value || '',
            phone: state.smsEnabled && state.realPhone ? state.realPhone : document.getElementById('crm-phone')?.value || '',
            industry: state.currentIndustry,
            smsOptIn: state.smsEnabled
        };

        // Collect dynamic fields
        const detailsGrid = document.getElementById('crm-details-grid');
        if (detailsGrid) {
            detailsGrid.querySelectorAll('.field-input').forEach(input => {
                const fieldId = input.id.replace('crm-', '');
                data[fieldId] = input.value;
            });
        }

        return data;
    }

    function startVoiceDemo() {
        state.isCallActive = true;
        setTabsDisabled(true);

        // Update UI
        document.querySelector('.voice-btn-start').style.display = 'none';
        document.querySelector('.voice-active-controls').style.display = 'flex';
        document.getElementById('voice-status').querySelector('.status-text').textContent = 'Connecting...';

        // Generate visualizer bars
        const barsContainer = document.querySelector('.visualizer-bars');
        if (barsContainer && !barsContainer.children.length) {
            for (let i = 0; i < 24; i++) {
                const bar = document.createElement('div');
                bar.className = 'viz-bar';
                barsContainer.appendChild(bar);
            }
        }

        // If voice demo widget exists, use it
        if (window.voiceDemo) {
            const crmContext = collectCRMData();
            window.voiceDemo.setCRMContext(crmContext);
            window.voiceDemo.selectAgent(state.currentIndustry);
            // The actual connection would happen through voice-demo.js
        } else {
            // Simulate for demo purposes
            simulateVoiceDemo();
        }
    }

    function endVoiceDemo() {
        state.isCallActive = false;
        setTabsDisabled(false);

        // Update UI
        document.querySelector('.voice-btn-start').style.display = 'flex';
        document.querySelector('.voice-active-controls').style.display = 'none';
        document.getElementById('voice-status').querySelector('.status-text').textContent = 'Call ended';

        // Show post-call prompt
        document.getElementById('post-call-prompt').style.display = 'flex';

        // If voice demo widget exists
        if (window.voiceDemo) {
            window.voiceDemo.disconnect();
        }
    }

    function simulateVoiceDemo() {
        // This simulates the voice demo for demonstration
        const statusEl = document.getElementById('voice-status');
        const transcriptEl = document.getElementById('voice-transcript');
        const visualizer = document.getElementById('voice-visualizer');

        setTimeout(() => {
            statusEl.querySelector('.status-text').textContent = 'Connected';
            statusEl.setAttribute('data-state', 'listening');
        }, 1000);

        setTimeout(() => {
            visualizer.setAttribute('data-state', 'speaking');
            statusEl.setAttribute('data-state', 'speaking');
            statusEl.querySelector('.status-text').textContent = 'Agent speaking...';

            const firstName = document.getElementById('crm-firstName')?.value || 'Maria';
            transcriptEl.innerHTML = `
                <div class="transcript-entry">
                    <div class="transcript-speaker agent">Agent</div>
                    <div class="transcript-text">Hello ${firstName}, thank you for calling. I'm here to help verify your enrollment. Can you confirm this is ${firstName}?</div>
                </div>
            `;
        }, 2000);

        // Animate visualizer bars
        const animateBars = () => {
            if (!state.isCallActive) return;

            document.querySelectorAll('.viz-bar').forEach(bar => {
                const height = Math.random() * 30 + 5;
                bar.style.height = `${height}px`;
            });

            requestAnimationFrame(animateBars);
        };
        animateBars();
    }

    // =========================================================================
    // SMS Flow
    // =========================================================================

    function initSMSFlow() {
        const resetBtn = document.getElementById('btn-reset-sms');
        if (resetBtn) {
            resetBtn.addEventListener('click', resetSMSFlow);
        }

        // Initial render
        renderSMSFlow();
    }

    function renderSMSFlow() {
        const conversation = document.getElementById('sms-conversation');
        const replyButtons = document.getElementById('sms-reply-buttons');
        const flowData = SMS_FLOWS[state.currentIndustry] || SMS_FLOWS.tpv;

        if (!conversation || !replyButtons) return;

        // Clear
        conversation.innerHTML = '';
        replyButtons.innerHTML = '';

        // Render messages up to current step
        let hasButtons = false;
        flowData.forEach((item, index) => {
            if (index <= state.smsFlowStep) {
                if (item.type === 'incoming' || item.type === 'outgoing' || item.type === 'system') {
                    addSMSBubble(item);
                } else if (item.type === 'action' && index === state.smsFlowStep) {
                    hasButtons = true;
                    item.buttons.forEach(btnText => {
                        const btn = document.createElement('button');
                        btn.className = 'sms-reply-btn';
                        btn.textContent = btnText;
                        btn.addEventListener('click', () => handleSMSReply(btnText));
                        replyButtons.appendChild(btn);
                    });
                }
            }
        });

        // Update flow diagram
        updateSMSFlowDiagram();
    }

    function addSMSBubble(message) {
        const conversation = document.getElementById('sms-conversation');
        const bubble = document.createElement('div');
        bubble.className = `sms-bubble ${message.type}`;
        bubble.innerHTML = `
            ${message.text}
            ${message.time ? `<span class="bubble-time">${message.time}</span>` : ''}
        `;
        conversation.appendChild(bubble);
        conversation.scrollTop = conversation.scrollHeight;
    }

    function handleSMSReply(reply) {
        const responses = SMS_RESPONSES[reply];
        if (!responses) return;

        // Clear reply buttons
        document.getElementById('sms-reply-buttons').innerHTML = '';

        // Add responses with delays
        const now = new Date();
        responses.forEach((msg, index) => {
            setTimeout(() => {
                const msgWithTime = { ...msg };
                if (msg.type === 'outgoing') {
                    msgWithTime.time = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
                } else if (msg.type === 'incoming') {
                    const later = new Date(now.getTime() + (index * 1000));
                    msgWithTime.time = later.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
                }
                addSMSBubble(msgWithTime);

                // Update flow to completed
                if (index === responses.length - 1) {
                    updateSMSFlowDiagram(true);
                }
            }, index * 800);
        });
    }

    function updateSMSFlowDiagram(complete = false) {
        const steps = document.querySelectorAll('.flow-step');
        const connectors = document.querySelectorAll('.flow-connector');
        const statusEl = document.getElementById('flow-status');

        if (complete) {
            steps.forEach(step => {
                step.classList.add('completed');
                step.classList.remove('active');
            });
            connectors.forEach(conn => conn.classList.add('active'));
            if (statusEl) {
                statusEl.querySelector('.status-step').textContent = 'Complete';
                statusEl.querySelector('.status-desc').textContent = 'CRM updated with confirmation';
            }
        } else {
            // Reset to step 2 (SMS Sent)
            steps.forEach((step, i) => {
                step.classList.toggle('completed', i === 0);
                step.classList.toggle('active', i === 1);
            });
            connectors[0]?.classList.add('active');
            connectors[1]?.classList.remove('active');
            if (statusEl) {
                statusEl.querySelector('.status-step').textContent = 'Step 2 of 3';
                statusEl.querySelector('.status-desc').textContent = 'Waiting for customer response...';
            }
        }
    }

    function resetSMSFlow() {
        state.smsFlowStep = 0;
        renderSMSFlow();
    }

    // =========================================================================
    // Campaign Animations
    // =========================================================================

    function initCampaignAnimations() {
        // Progress bar animation is handled by CSS
        // Stats animation triggered when panel becomes visible
    }

    function animateCampaignStats() {
        const animatedValues = document.querySelectorAll('[data-animate]');

        animatedValues.forEach(el => {
            const target = parseInt(el.dataset.animate);
            const suffix = el.dataset.suffix || '';
            const duration = 1500;
            const start = 0;
            const startTime = performance.now();

            const animate = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);

                // Ease out quad
                const eased = 1 - (1 - progress) * (1 - progress);
                const current = Math.round(start + (target - start) * eased);

                el.textContent = current.toLocaleString() + suffix;

                if (progress < 1) {
                    requestAnimationFrame(animate);
                }
            };

            requestAnimationFrame(animate);
        });
    }

    // =========================================================================
    // Journey Progress
    // =========================================================================

    function initJourneyProgress() {
        updateJourneyProgress();
    }

    function updateJourneyProgress() {
        const steps = document.querySelectorAll('.journey-progress .progress-step');
        const tabOrder = ['crm', 'voice', 'compliance', 'sms', 'campaigns'];

        steps.forEach((step, index) => {
            const tabId = tabOrder[index];
            const isVisited = state.visitedTabs.has(tabId);
            const isCurrent = state.currentTab === tabId;

            step.classList.toggle('completed', isVisited && !isCurrent);
            step.classList.toggle('active', isCurrent);
        });
    }

    function checkJourneyCompletion() {
        const allTabs = ['crm', 'voice', 'compliance', 'sms', 'campaigns'];
        const allVisited = allTabs.every(tab => state.visitedTabs.has(tab));

        if (allVisited && state.visitedTabs.size === 5) {
            // Delay to let user see the last panel
            setTimeout(() => {
                showCompletionModal();
            }, 1500);
        }
    }

    // =========================================================================
    // Mobile Wizard
    // =========================================================================

    function initMobileWizard() {
        const prevBtn = document.getElementById('wizard-prev');
        const nextBtn = document.getElementById('wizard-next');

        if (prevBtn) {
            prevBtn.addEventListener('click', () => navigateWizard(-1));
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => navigateWizard(1));
        }

        updateMobileWizard();
    }

    function navigateWizard(direction) {
        const tabOrder = ['crm', 'voice', 'compliance', 'sms', 'campaigns'];
        const currentIndex = tabOrder.indexOf(state.currentTab);
        const newIndex = currentIndex + direction;

        if (newIndex >= 0 && newIndex < tabOrder.length) {
            switchTab(tabOrder[newIndex]);
        }
    }

    function updateMobileWizard() {
        const tabOrder = ['crm', 'voice', 'compliance', 'sms', 'campaigns'];
        const currentIndex = tabOrder.indexOf(state.currentTab);

        const prevBtn = document.getElementById('wizard-prev');
        const nextBtn = document.getElementById('wizard-next');
        const currentEl = document.getElementById('wizard-current');

        if (prevBtn) prevBtn.disabled = currentIndex === 0 || state.isCallActive;
        if (nextBtn) nextBtn.disabled = currentIndex === tabOrder.length - 1 || state.isCallActive;
        if (currentEl) currentEl.textContent = currentIndex + 1;
    }

    // =========================================================================
    // Completion Modal
    // =========================================================================

    function initModalHandlers() {
        const modal = document.getElementById('journey-complete-modal');
        const keepExploringBtn = document.getElementById('modal-keep-exploring');
        const backdrop = modal?.querySelector('.modal-backdrop');

        if (keepExploringBtn) {
            keepExploringBtn.addEventListener('click', hideCompletionModal);
        }

        if (backdrop) {
            backdrop.addEventListener('click', hideCompletionModal);
        }
    }

    function showCompletionModal() {
        const modal = document.getElementById('journey-complete-modal');
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function hideCompletionModal() {
        const modal = document.getElementById('journey-complete-modal');
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    // =========================================================================
    // Export Button
    // =========================================================================

    function initExportButton() {
        const exportBtn = document.getElementById('btn-export-report');
        if (exportBtn) {
            exportBtn.addEventListener('click', function() {
                // Show toast notification
                showToast('Report downloaded successfully');
            });
        }
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'solutions-toast';
        toast.textContent = message;
        toast.style.cssText = `
            position: fixed;
            bottom: 100px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--success);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            z-index: 3000;
            animation: toastIn 0.3s ease;
        `;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.animation = 'fadeIn 0.3s ease reverse';
            setTimeout(() => toast.remove(), 300);
        }, 2000);
    }

    // =========================================================================
    // Expose for Voice Demo Integration
    // =========================================================================

    window.solutionsDemo = {
        getCRMData: collectCRMData,
        getState: () => ({ ...state }),
        switchTab,
        endVoiceDemo
    };

})();
