@props(['result' => null])

<div id="result-container"
    class="{{ $result ? 'block' : 'hidden' }} space-y-6 animate-fade-in relative pt-12 border-t border-sky-500/20">

    @auth
        <!-- Actions - Only for authorized users -->
        <div class="absolute top-0 right-0 mt-4 flex space-x-3">
            <button id="copy-button" type="button"
                class="cyber-button text-xs font-mono uppercase tracking-widest px-4 py-2 rounded-sm shadow-sm transition-colors flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                    </path>
                </svg>
                <span id="copy-text">COPY_DATA</span>
            </button>
            <button id="share-button" type="button"
                class="cyber-button text-xs font-mono uppercase tracking-widest px-4 py-2 rounded-sm shadow-sm transition-colors flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z">
                    </path>
                </svg>
                <span id="share-text">BROADCAST</span>
            </button>
        </div>
    @endauth

    <!-- Human Readable -->
    <div
        class="bg-indigo-900/20 rounded-sm p-6 text-center border border-indigo-500/30 shadow-[0_0_15px_rgba(79,70,229,0.1)] mt-0 relative overflow-hidden group">
        <div
            class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500/0 via-indigo-500 to-indigo-500/0 opacity-0 group-hover:opacity-100 transition-opacity">
        </div>
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 animate-flicker" id="human-readable">
            {{ $result['humanReadable'] ?? '' }}
        </h2>
        <p class="text-sky-400 text-xs font-mono tracking-widest uppercase" id="direction-text">
            @if($result && $result['direction'] === 'past')
                ARCHIVED_RECORD
            @elseif($result && $result['direction'] === 'future')
                PROJECTED_EVENT
            @else
                CURRENT_STATE
            @endif
        </p>
    </div>

    <!-- Breakdown -->
    <div class="border border-sky-500/20 bg-slate-900/50 rounded-sm p-6 shadow-sm">
        <h3 class="text-[10px] font-mono tracking-widest uppercase text-slate-500 mb-4 flex items-center gap-2">
            <span class="w-1 h-1 bg-sky-500 rounded-sm"></span> RAW_BREAKDOWN
        </h3>
        <div class="grid grid-cols-3 gap-4">
            <div class="text-center">
                <div class="text-3xl font-bold text-sky-300" id="years">{{ $result['years'] ?? 0 }}</div>
                <div class="text-xs font-mono text-slate-500 uppercase tracking-widest mt-1">YRS</div>
            </div>
            <div class="text-center border-l border-r border-sky-500/10">
                <div class="text-3xl font-bold text-sky-300" id="months">{{ $result['months'] ?? 0 }}</div>
                <div class="text-xs font-mono text-slate-500 uppercase tracking-widest mt-1">MTH</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-sky-300" id="days">{{ $result['days'] ?? 0 }}</div>
                <div class="text-xs font-mono text-slate-500 uppercase tracking-widest mt-1">DYS</div>
            </div>
        </div>
    </div>

    <!-- Totals -->
    <div class="border border-sky-500/20 bg-slate-900/50 rounded-sm p-6 shadow-sm">
        <h3 class="text-[10px] font-mono tracking-widest uppercase text-slate-500 mb-4 flex items-center gap-2">
            <span class="w-1 h-1 bg-sky-500 rounded-sm"></span> CUMULATIVE_DATA
        </h3>
        <div class="space-y-4 font-mono">
            <div class="flex justify-between items-center text-sm">
                <span class="text-slate-500 text-xs tracking-widest uppercase">TTL_DAYS</span>
                <span class="text-lg text-sky-300 shadow-sm"
                    id="total-days">{{ $result ? number_format($result['totalDays']) : 0 }}</span>
            </div>
            <div class="flex justify-between items-center text-sm border-t border-sky-500/10 pt-3">
                <span class="text-slate-500 text-xs tracking-widest uppercase">TTL_WEEKS</span>
                <span class="text-lg text-sky-300 shadow-sm"
                    id="total-weeks">{{ $result ? number_format($result['totalWeeks'], 2) : 0 }}</span>
            </div>
            <div class="flex justify-between items-center text-sm border-t border-sky-500/10 pt-3">
                <span class="text-slate-500 text-xs tracking-widest uppercase">TTL_HOURS</span>
                <span class="text-lg text-sky-300 shadow-sm"
                    id="total-hours">{{ $result ? number_format($result['totalHours']) : 0 }}</span>
            </div>
            <div class="flex justify-between items-center text-sm border-t border-sky-500/10 pt-3 relative">
                <div
                    class="absolute -left-2 top-1/2 -translate-y-1/2 w-1 h-6 bg-rose-500 shadow-[0_0_10px_rgba(244,63,94,0.5)]">
                </div>
                <span class="text-slate-400 font-bold tracking-widest uppercase pl-4">TTL_SECONDS</span>
                <span class="text-xl font-bold text-rose-400 shadow-[0_0_10px_rgba(244,63,94,0.2)] animate-pulse-glow"
                    id="total-seconds">{{ $result ? number_format($result['totalSeconds']) : 0 }}</span>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.3s ease-out;
    }

    @media (prefers-reduced-motion: reduce) {
        .animate-fade-in {
            animation: none;
        }
    }
</style>