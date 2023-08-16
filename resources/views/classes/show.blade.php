<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Classe de {{ $classe->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-3">
                        <x-primary-button class="management" :data-url="route('classes.form', ['action' => 'create'])">
                            Ajouter une classe
                        </x-primary-button>
                    </div>
                    <div>
                        <x-table>
                             <x-slot:thead>
                                <tr>
                                     <x-th>#</x-th>
                                     <x-th>Numéro Matricule de l'élève</x-th>
                                     <x-th>Nom de l'élève</x-th>
                                     <x-th>Prénom(s) de l'élève</x-th>
                                     <x-th>Genre</x-th>
                                </tr>
                             </x-slot:thead>
                             <x-slot:tbody>
                                 @forelse ($classe->students as $student)
                                 <x-tr>
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
                                                <x-dropdown-link class="flex items-center management cursor-pointer" :data-url="route('classes.form', ['action' => 'create', 'classe' => $classe->id])">
                                                    <span class="mr-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                                        </svg>
                                                    </span>
                                                    Copier
                                                </x-dropdown-link>
                                              
                                            </x-slot>
                                        </x-dropdown>
                                     </x-td>
                                     <x-td>
                                         {{ $student->user->matricule }}
                                     </x-td>
                                     <x-td>
                                         {{ $student->user->lastname }}
                                     </x-td>
                                     <x-td>
                                         {{ $student->user->firstname }}
                                     </x-td>
                                     <x-td>
                                         {{ $student->user->c_gender }}
                                     </x-td>
                                 </x-tr>
                                 @empty
                                     <x-tr>
                                         <x-td  colspan="5" class="text-center">Aucune donnée disponible</x-td>
                                     </x-tr>
                                 @endforelse
                             </x-slot:tbody>
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
