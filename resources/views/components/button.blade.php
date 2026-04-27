@props([
    'type' => 'primary',
    'icon' => '',
    'submit' => false,
    'href' => '',
    'onclick' => '',
])

@php
    $styleMap = [
        'primary' => 'bg-blue-600 hover:bg-blue-700 text-white shadow-sm hover:shadow',
        'danger' => 'bg-red-500 hover:bg-red-600 text-white shadow-sm hover:shadow',
        'secondary' => 'bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-200',
        'warning' => 'bg-amber-500 hover:bg-amber-600 text-white shadow-sm hover:shadow',
        'success' => 'bg-emerald-500 hover:bg-emerald-600 text-white shadow-sm hover:shadow',
        'outline' => 'bg-white hover:bg-slate-50 text-blue-600 border border-blue-300',
    ];
    $style = $styleMap[$type] ?? $styleMap['primary'];
    $base =
        'inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-sm font-semibold transition-all duration-150 cursor-pointer';
@endphp

@if ($href)
    <a href="{{ $href }}" class="{{ $base }} {{ $style }}">
        @if ($icon)
            <span class="material-icons text-[17px]">{{ $icon }}</span>
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $submit ? 'submit' : 'button' }}"
        @if ($onclick) onclick="{{ $onclick }}" @endif
        class="{{ $base }} {{ $style }}">
        @if ($icon)
            <span class="material-icons text-[17px]">{{ $icon }}</span>
        @endif
        {{ $slot }}
    </button>
@endif
