@props([
    'label',
    'id',
    'name',
    'value' => null,
    'required' => false,
])

<div class="space-y-2 relative group">
    <label for="{{ $id }}" class="block text-xs font-mono text-sky-400 mb-2 uppercase tracking-widest pl-1">
        {{ $label }}
        @if($required)
            <span class="text-rose-500 animate-pulse-glow">*</span>
        @endif
    </label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 w-1 bg-sky-500/0 group-focus-within:bg-sky-500 transition-colors z-10"></div>
        <input
            type="date"
            id="{{ $id }}"
            name="{{ $name }}"
            value="{{ $value }}"
            {{ $required ? 'required' : '' }}
            onkeydown="return false"
            class="futuristic-input w-full px-4 py-3 pr-10 rounded-sm font-mono text-sm tracking-wide focus:outline-none focus:ring-0 placeholder-slate-500"
            aria-label="{{ $label }}"
        />
        <!-- Custom Calendar Icon Overlay -->
        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-sky-500/50 group-focus-within:text-sky-400 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
    </div>
</div>
