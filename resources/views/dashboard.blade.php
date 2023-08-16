<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de bord
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid md:grid-cols-3 gap-6 md:gap-8">
                        @switch(auth()->user()->userable_type)
                            @case('App\Models\Administration')
                                <x-administration />
                                @break
                            @case('App\Models\Teacher')
                                <x-teacher />
                                @break
                            @default
                                @include('students.home')
                        @endswitch
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
