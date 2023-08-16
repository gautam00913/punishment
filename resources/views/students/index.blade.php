<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des élèves
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-3">
                        <x-primary-button class="management" :data-url="route('students.form', ['action' => 'create'])">
                            Ajouter un elève
                        </x-primary-button>
                    </div>
                   <x-table>
                        <x-slot:thead>
                           <tr>
                                <x-th>#</x-th>
                                <x-th>Matricule</x-th>
                                <x-th>Nom & Prénom(s)</x-th>
                                <x-th>âge</x-th>
                                <x-th>Genre</x-th>
                                <x-th>Niveau</x-th>
                                <x-th>Nom & Prénom d'un parent</x-th>
                                <x-th>Contact du parent</x-th>
                                <x-th>Photo</x-th>
                           </tr>
                        </x-slot:thead>
                        <x-slot:tbody>
                            @forelse($students as $student)
                                <x-tr :active="$student->user->active">
                                    <x-td>
                                        <x-dropdown align="top" :relative="false">
                                            <x-slot name="trigger">
                                                <button class="inline-flex items-center py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-gray-300 hover:bg-secondary focus:outline-none transition ease-in-out duration-150">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                                      </svg>
                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                <x-dropdown-link class="flex items-center management cursor-pointer" :data-url="route('students.form', ['action' => 'create', 'student' => $student->id])">
                                                    <span class="mr-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                                        </svg>
                                                    </span>
                                                    Copier
                                                </x-dropdown-link>
                                                <x-dropdown-link class="flex items-center management cursor-pointer" :data-url="route('students.form', ['action' => 'edit', 'student' => $student->id])">
                                                    <span class="mr-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                    </span>
                                                    Modifier
                                                </x-dropdown-link>
                                                <x-dropdown-link class="flex items-center management cursor-pointer" :data-url="route('students.createClass', $student->id)">
                                                    <span class="mr-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                                        </svg>
                                                    </span>
                                                    Attribuer de classe
                                                </x-dropdown-link>
                                                <x-dropdown-link class="flex items-center" :href="route('students.status', $student->id)">
                                                    @if ($student->user->active)
                                                        <span class="mr-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                                            </svg>
                                                        </span>
                                                        Désactiver
                                                    @else
                                                        <span class="mr-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            </svg>
                                                        </span>
                                                        Activer
                                                    @endif
                                                </x-dropdown-link>
                                            </x-slot>
                                        </x-dropdown>
                                    </x-td>
                                    <x-td>
                                        {{ $student->user->matricule }}
                                    </x-td>
                                    <x-td>
                                        {{ $student->user->name }}
                                    </x-td>
                                    <x-td>
                                        {{ $student->user->c_age }}
                                    </x-td>
                                    <x-td>
                                        {{ $student->user->c_gender }}
                                    </x-td>
                                    <x-td>
                                        {{ $student->current_level }}
                                    </x-td>
                                    <x-td>
                                        @if ($student->tutor_id)
                                            {{ $student->tutor->name  }}
                                        @endif
                                    </x-td>
                                    <x-td>
                                        @if ($student->tutor_id)
                                            {{ $student->tutor->phone }}
                                        @endif
                                    </x-td>
                                    <x-td>
                                        @if ($student->user->picture)
                                            <img class="w-10 h-10 object-cover" src="{{ Storage::url($student->user->picture) }}" alt="Photo de {{ $student->user->name }}" />
                                        @endif
                                    </x-td>
                                </x-tr>
                                @empty
                                <x-tr>
                                    <x-td class="text-center" colspan="9">Aucune donnée disponible</x-td>
                                </x-tr>
                            @endforelse
                        </x-slot:tbody>
                   </x-table>
                   <div>
                        {{ $students->links() }}
                   </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
