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
    <div class="absolute inset-y-0 left-0 top-6 bottom-0 w-1 bg-sky-500/0 group-focus-within:bg-sky-500 transition-colors z-10"></div>
    <input
        type="date"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $required ? 'required' : '' }}
        class="futuristic-input w-full px-4 py-3 rounded-sm font-mono text-sm tracking-wide focus:outline-none focus:ring-0 placeholder-slate-500"
        aria-label="{{ $label }}"
    />
</div>
