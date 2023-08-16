@props(['color' => [
    'success' => 'bg-green-600',
    'fail' => 'bg-red-500',
    'warning' => 'bg-yellow-400',
], 'type' => 'success', 'message' => ''])

<div x-data="{open: true}" x-show="open" class="{{ $message ? '' : 'hidden' }} px-4 py-2 rounded text-white fixed top-12 right-4 z-30 inline-block w-3/5 md:w-1/4 {{ $color[$type] ?? $color['success'] }}" id="toast">
    <div class="flex space-x-5 items-start">
        <div>
            {!! $message !!}
        </div>
        <button @click="open= false" type="button">
            X
        </button>
    </div>
</div>