@props(['class' => ''])
<div {{ $attributes->merge(['class' => 'growmate-card ' . $class]) }}>
    {{ $slot }}
</div>
