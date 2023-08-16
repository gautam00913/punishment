<div class="px-3 md:px-5 pt-2 pb-5">
    <div class="border-b mb-5 flex justify-between">
        <p class="font-semibold text-xl"> {{ $action == 'create' ? "Ajout d'un parent d'élève" : "Modification du parent d'élève ". $tutor->user->name }}</p>
        <button @click="show = false" class="p-2 hover:text-red-600">
            X
        </button>
    </div>
    <div x-data="">
        <form method="POST" action="{{ $action == 'create' ? route('tutors.store') : route('tutors.update', $tutor) }}" enctype="multipart/form-data">
            @csrf
            @if ($action == "edit")
                @method('PUT')
            @endif
            <x-user :user="$tutor->user" :hide_matricule="true" />

            <div class="mb-4">
                <x-input-label for="grade" :value="__('Adresse')" :required="true" />
                <x-text-input id="grade" class="block mt-1 w-full" type="text" name="address" :value="old('address') ?? $tutor->address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="students" value="L'élève ou les élèves sous sa responsabilité"/>
                <x-selectbox id="students" class="block mt-1 w-full" name="students[]" multiple="multiple">
                    <option value=""></option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}" @if($tutor->childreen()->pluck('id')->contains($student->id)) selected @endif>{{ $student->user->name }}</option>
                    @endforeach
                </x-selectbox>
                <x-input-error :messages="$errors->get('students')" class="mt-2" />
            </div>
         
            <div class="flex items-center justify-center mt-4">
                <x-primary-button id="processingFormBtn">
                    {{ $action == 'create' ? 'Ajouter' : 'Modifier' }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>