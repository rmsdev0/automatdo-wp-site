/**
 * Audio Processor Worklet
 * Captures microphone audio and converts to PCM16 for WebSocket transmission
 */

class VoiceDemoProcessor extends AudioWorkletProcessor {
    constructor() {
        super();
        this.bufferSize = 2048; // ~128ms at 16kHz (lower latency)
        this.buffer = new Float32Array(this.bufferSize);
        this.bufferIndex = 0;
    }

    process(inputs, outputs, parameters) {
        const input = inputs[0];
        if (!input || !input[0]) return true;

        const samples = input[0];

        // Calculate RMS level for visualization
        let sum = 0;
        for (let i = 0; i < samples.length; i++) {
            sum += samples[i] * samples[i];
        }
        const rms = Math.sqrt(sum / samples.length);

        // Send audio level for visualizer (0-1 normalized, boosted for visibility)
        this.port.postMessage({
            type: 'level',
            level: Math.min(1, rms * 5)
        });

        // Buffer samples
        for (let i = 0; i < samples.length; i++) {
            this.buffer[this.bufferIndex++] = samples[i];

            // When buffer is full, convert and send
            if (this.bufferIndex >= this.bufferSize) {
                // Convert Float32 (-1 to 1) to Int16 PCM
                const pcm16 = new Int16Array(this.bufferSize);
                for (let j = 0; j < this.bufferSize; j++) {
                    // Clamp and convert
                    const s = Math.max(-1, Math.min(1, this.buffer[j]));
                    pcm16[j] = s < 0 ? s * 0x8000 : s * 0x7FFF;
                }

                // Send audio buffer
                this.port.postMessage(
                    { type: 'audio', buffer: pcm16.buffer },
                    [pcm16.buffer]
                );

                // Reset buffer
                this.bufferIndex = 0;
            }
        }

        return true;
    }
}

registerProcessor('voice-demo-processor', VoiceDemoProcessor);
