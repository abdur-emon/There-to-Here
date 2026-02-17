@props([
    'label',
    'id',
    'name',
    'value' => null,
    'required' => false,
])

<div class="space-y-2">
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-300">
        {{ $label }}
        @if($required)
            <span class="text-red-400">*</span>
        @endif
    </label>
    <input
        type="date"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $required ? 'required' : '' }}
        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 backdrop-blur-sm"
        aria-label="{{ $label }}"
    />
</div>

