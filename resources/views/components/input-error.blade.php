@props(['messages' => null])
@if ($messages)
    <ul class="mt-1 text-[10px] text-red-500 space-y-0.5">
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
