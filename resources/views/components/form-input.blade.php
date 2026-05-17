@props(['name', 'label', 'type' => 'text', 'value' => '', 'required' => false])

<div class="space-y-1.5">
    <label for="{{ $name }}" class="text-xs font-bold text-slate-700 block">
        {{ $label }} @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        class="w-full text-sm px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-50/50 transition bg-slate-50/50">
    @error($name)
        <p class="text-[11px] text-red-600 font-medium mt-1">{{ $message }}</p>
    @enderror
</div>
