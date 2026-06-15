@props(['text' => '', 'for' => ''])
<label for="{{ $for ?? $attributes->get('id') }}" class="text-[11px] font-medium text-label block mb-1.5">
    {{ $text ?? $slot }}
</label>
