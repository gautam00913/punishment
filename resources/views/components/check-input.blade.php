@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block appearance-none checked:bg-blue-500 mx-1']) !!}>
