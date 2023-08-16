@foreach ($classes as $class)
    <x-card>
        <div class="flex justify-center items-center flex-col">
            <div class="bg-gray-200 p-3 border rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                </svg>
            </div>
            <div class="my-4">
                <h2 class="text-xl font-bold text-primary">({{ $class->name }})</h2>
            </div>
            <x-link :href="route('classes.show', ['slug' =>$class->slug ?? 'xxx'])">Gérer</x-link>
        </div>
    </x-card>
@endforeach