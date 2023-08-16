@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-danger text-left text-base font-medium text-green-500 bg-green-50 focus:outline-none focus:text-green-800 focus:bg-yellow-100 focus:border-yellow-700 transition duration-150 ease-in-out'
            : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-secondary hover:text-white hover:bg-white hover:border-primary focus:outline-none focus:text-secondary focus:bg-gray-50 focus:border-secondary transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
