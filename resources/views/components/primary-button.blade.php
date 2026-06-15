@props(['class' => ''])
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'growmate-btn-primary h-[50px] ' . $class]) }}>
    {{ $slot }}
</button>
