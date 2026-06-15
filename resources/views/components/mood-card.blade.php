@props(['emoji' => '', 'label' => '', 'selected' => false])
<div {{ $attributes->merge(['class' => 'growmate-mood-card' . ($selected ? ' selected' : '')]) }}>
    <span class="text-3xl">{{ $emoji }}</span>
    <span class="text-[11px] font-medium text-black">{{ $label }}</span>
</div>
