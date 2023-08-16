<div class="px-3 md:px-5 pt-2 pb-5">
    <div class="border-b mb-5 flex justify-between">
        <p class="font-semibold text-xl"> {{ $action == 'create' ? "Ajout d'un élève" : "Modification de l'élève ". $student->user->name }}</p>
        <button @click="show = false" class="p-2 hover:text-red-600">
            X
        </button>
    </div>
    <div x-data="">
        <form method="POST" action="{{ $action == 'create' ? route('students.store') : route('students.update', $student) }}" enctype="multipart/form-data">
            @csrf
            @if ($action == "edit")
                @method('PUT')
            @endif
            <div class="mb-4">
                <x-input-label for="tutor_id" value="Parent de l'élève"/>
                <x-selectbox id="tutor_id" class="block mt-1 w-full" name="tutor_id" >
                    <option value=""></option>
                    @foreach ($tutors as $tutor)
                        <option value="{{ $tutor->id }}"  @if($student->tutor_id == $tutor->id) selected @endif>{{ $tutor->name }}</option>
                    @endforeach
                </x-selectbox>
                <x-input-error :messages="$errors->get('tutor_id')" class="mt-2" />
            </div>
            <x-user :user="$student->user" />
         
            <div class="mb-4">
                <x-input-label for="class" value="Niveau Actuel" />
                <x-selectbox id="class" class="block mt-1 w-full" name="class" >
                    <option value=""></option>
                    @foreach ($classes as $classe)
                        <option value="{{ $classe->id }}" @if($student->current_class == $classe->id) selected @endif>{{ $classe->name }}</option>
                    @endforeach
                </x-selectbox>
                <x-input-error :messages="$errors->get('class')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-primary-button id="processingFormBtn">
                    {{ $action == 'create' ? 'Ajouter' : 'Modifier' }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>