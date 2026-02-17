@props(['result' => null])

<div id="result-container" class="{{ $result ? 'block' : 'hidden' }} space-y-6 animate-fade-in">
    <!-- Human Readable -->
    <div class="glass rounded-2xl p-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-2" id="human-readable">
            {{ $result['humanReadable'] ?? '' }}
        </h2>
        <p class="text-gray-400 text-sm" id="direction-text">
            @if($result && $result['direction'] === 'past')
                In the past
            @elseif($result && $result['direction'] === 'future')
                In the future
            @else
                Right now
            @endif
        </p>
    </div>
    
    <!-- Breakdown -->
    <div class="glass rounded-2xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Breakdown</h3>
        <div class="grid grid-cols-3 gap-4">
            <div class="text-center">
                <div class="text-2xl font-bold text-purple-400" id="years">{{ $result['years'] ?? 0 }}</div>
                <div class="text-sm text-gray-400">Years</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-purple-400" id="months">{{ $result['months'] ?? 0 }}</div>
                <div class="text-sm text-gray-400">Months</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-purple-400" id="days">{{ $result['days'] ?? 0 }}</div>
                <div class="text-sm text-gray-400">Days</div>
            </div>
        </div>
    </div>
    
    <!-- Totals -->
    <div class="glass rounded-2xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Totals</h3>
        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <span class="text-gray-400">Total Days</span>
                <span class="text-xl font-semibold text-white" id="total-days">{{ number_format($result['totalDays'] ?? 0) }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-400">Total Weeks</span>
                <span class="text-xl font-semibold text-white" id="total-weeks">{{ number_format($result['totalWeeks'] ?? 0, 2) }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-400">Total Hours</span>
                <span class="text-xl font-semibold text-white" id="total-hours">{{ number_format($result['totalHours'] ?? 0) }}</span>
            </div>
            <div class="flex justify-between items-center border-t border-white/10 pt-3">
                <span class="text-gray-400">Total Seconds</span>
                <span class="text-xl font-semibold text-white" id="total-seconds">{{ number_format($result['totalSeconds'] ?? 0) }}</span>
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

