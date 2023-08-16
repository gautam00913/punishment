@props(['active' => true])
@php
    $classes = "border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-secondary";
    $classes .= $active ? ' bg-white' : ' bg-orange-300';
@endphp
<tr {{ $attributes->merge(['class' => $classes ]) }}>
    {{ $slot }}
</tr>