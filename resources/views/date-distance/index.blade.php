@extends('layouts.main')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-2xl">
            <!-- Header -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full border border-sky-500/30 bg-sky-500/10 text-sky-400 text-xs font-mono tracking-widest uppercase mb-6 shadow-[0_0_15px_rgba(56,189,248,0.15)] animate-float-fast">
                    <span class="w-2 h-2 bg-sky-400 animate-pulse"></span>
                    Terminal Access
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3 bengali-text animate-flicker">
                    একদিন তো মরেই যাবো !
                </h1>
                <p class="text-sky-500/70 font-mono tracking-widest uppercase text-sm">
                    Calculate precise temporal span
                </p>
            </div>

            <!-- Main Card -->
            <div class="glass-panel p-8 rounded-sm relative group">
                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-sky-500"></div>
                <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-sky-500"></div>
                <div class="absolute bottom-0 left-0 w-3 h-3 border-b-2 border-l-2 border-sky-500"></div>
                <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-sky-500"></div>
                
                <!-- Form -->
                <form id="date-form" class="space-y-6">
                    <!-- Target Date -->
                    <x-date-input label="Target Date" id="target-date" name="target_date" :value="$targetDate"
                        :required="true" />

                    <!-- From Date Toggle -->
                    <div class="flex items-center space-x-3 mt-6">
                        <div class="relative flex items-center justify-center w-5 h-5 border border-sky-500/50 rounded-sm bg-slate-900 hover:border-sky-400 transition-colors">
                            <input type="checkbox" id="use-from-date"
                                class="absolute opacity-0 cursor-pointer w-full h-full peer"
                                {{ $fromDate ? 'checked' : '' }} />
                            <svg class="w-3 h-3 text-sky-400 opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <label for="use-from-date" class="text-xs font-mono text-slate-400 uppercase tracking-widest cursor-pointer hover:text-sky-300 transition-colors">
                            Use custom origin date
                        </label>
                    </div>

                    <!-- From Date Input (conditionally shown) -->
                    <div id="from-date-container" class="{{ $fromDate ? 'block' : 'hidden' }}">
                        <x-date-input label="From Date" id="from-date" name="from_date" :value="$fromDate" />
                    </div>

                    <!-- Calculate Button -->
                    <button type="submit"
                        class="cyber-button-primary w-full py-4 rounded-sm mt-8 text-sm uppercase font-mono tracking-widest shadow-[0_0_15px_rgba(56,189,248,0.2)]">
                        PROCESS
                    </button>

                    @auth
                        <!-- Reset Button - Only for authorized users -->
                        <div class="pt-4 mt-6 border-t border-sky-500/20 flex justify-end">
                            <button type="button" id="reset-button"
                                class="text-xs font-mono text-rose-500 hover:text-rose-400 uppercase tracking-widest px-4 py-2 bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/30 rounded-sm transition-all hover:shadow-[0_0_10px_rgba(244,63,94,0.3)]">
                                [PURGE_DATA]
                            </button>
                        </div>
                    @endauth
                </form>

                <!-- Results -->
                <div class="mt-8">
                    <x-result-display :result="$result" />
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-12 text-slate-500 text-xs font-mono tracking-widest uppercase">
                <p>Built for precise date calculations</p>
                <p class="mt-2">
                    <kbd class="px-2 py-1 bg-slate-900 border border-sky-500/30 rounded-sm text-[10px] text-sky-400 shadow-[0_0_5px_rgba(56,189,248,0.2)] mr-2">Cmd+K</kbd> 
                    to focus input
                </p>
            </div>
        </div>
    </div>

    <!-- Pass initial state to JavaScript -->
    <script>
        window.__INITIAL_STATE__ = {
            targetDate: @json($targetDate),
            fromDate: @json($fromDate),
            result: @json($result),
        };
    </script>
@endsection