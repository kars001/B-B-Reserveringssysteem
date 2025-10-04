@props([
    'active' => false,
    'icon',
    'target' => '_self'
])

@php
    $activeClasses = $active ? 'bg-gray-200 font-bold' : 'bg-main';
    $target = $target ?? '_self';
@endphp

<a target="{{ $target }}" {{ $attributes->merge(['class' => "flex items-center gap-5 p-2 px-3 rounded-[10px] hover:text-black hover:font-medium hover:bg-third $activeClasses"]) }}>
    @if ($active)
        <x-dynamic-component :component="'heroicon-s-' . $icon" class="size-5" />
    @else
        <x-dynamic-component :component="'heroicon-o-' . $icon" class="size-5" />
    @endif
    {{ $slot }}
</a>