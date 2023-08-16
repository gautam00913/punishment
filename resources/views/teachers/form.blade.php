<div class="px-3 md:px-5 pt-2 pb-5">
    <div class="border-b mb-5 flex justify-between">
        <p class="font-semibold text-xl"> {{ $action == 'create' ? "Ajout d'un enseignant" : "Modification de l'enseignant ". $teacher->user->name }}</p>
        <button @click="show = false" class="p-2 hover:text-red-600">
            X
        </button>
    </div>
    <div x-data="">
        <form method="POST" action="{{ $action == 'create' ? route('teachers.store') : route('teachers.update', $teacher) }}" enctype="multipart/form-data">
            @csrf
            @if ($action == "edit")
                @method('PUT')
            @endif
            <div class="mb-4">
                <x-input-label for="matter_id" value="Matière enseignée" :required="true" />
                <x-selectbox id="matter_id" class="block mt-1 w-full" name="matter_id"  required >
                    <option value=""></option>
                    @foreach ($matters as $matter)
                        <option value="{{ $matter->id }}"  @if($teacher->matter_id == $matter->id) selected @endif>{{ $matter->name }}</option>
                    @endforeach
                </x-selectbox>
                <x-input-error :messages="$errors->get('matter_id')" class="mt-2" />
            </div>
            <x-user :user="$teacher->user" />
            <div class="mb-4">
                <x-input-label for="grade" :value="__('Grade')" />
                <x-text-input id="grade" class="block mt-1 w-full" type="text" name="grade" :value="old('grade') ?? $teacher->grade" />
                <x-input-error :messages="$errors->get('grade')" class="mt-2" />
            </div>

            <div x-data="{show: @js($teacher->is_principal)}">
                <div class="my-3">
                    <div class="flex items-center" id="is_principal">
                        <x-input-label :value="__('Professeur Principal')" class="mr-3" />
                        <x-check-input @click="show = !show" id="is_principal1" type="radio" name="is_principal" value="1" :checked="old('is_principal') ? old('is_principal') == 1 : $teacher->is_principal == 1 " />
                        <x-input-label for="is_principal1" :value="__('Oui')" class="mr-3" />
                        <x-check-input @click="show = !show" id="is_principal0" type="radio" name="is_principal" value="0" :checked="old('is_principal') ? old('is_principal') == 0 : $teacher->is_principal == 0 " />
                        <x-input-label for="is_principal0" :value="__('Non')" />
                    </div>
                    <x-input-error :messages="$errors->get('is_principal')" class="mt-2" />
                </div>
                <div x-show="show" class="mb-4">
                    <x-input-label for="principal_at" value="Principal dans la Classe" />
                    <x-selectbox id="principal_at" class="block mt-1 w-full" name="principal_at" >
                        <option value=""></option>
                        @foreach ($classes as $classe)
                            <option value="{{ $classe->id }}" @if($teacher->principal_at == $classe->id) selected @endif>{{ $classe->name }}</option>
                        @endforeach
                    </x-selectbox>
                    <x-input-error :messages="$errors->get('principal_at')" class="mt-2" />
                </div>
            </div>
            <div class="flex items-center justify-center mt-4">
                <x-primary-button id="processingFormBtn">
                    {{ $action == 'create' ? 'Ajouter' : 'Modifier' }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>