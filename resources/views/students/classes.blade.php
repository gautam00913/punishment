<div class="px-3 md:px-5 pt-2 pb-5">
    <div class="border-b mb-5 flex justify-between">
        <p class="font-semibold text-xl"> Attribution de classe à un élève</p>
        <button @click="show = false" class="p-2 hover:text-red-600">
            X
        </button>
    </div>
    <div x-data="">
        <form method="POST" action="{{ route('students.classes', $student->id) }}">
            @csrf
           
            <div class="mb-4">
                <x-input-label for="class" value="Classe actuelle de l'élève" :required="true"/>
                <x-selectbox id="class" class="block mt-1 w-full" name="class" >
                    <option value=""></option>
                    @foreach ($classes as $classe)
                        <option value="{{ $classe->id }}"  @if($student->current_class == $classe->id) selected @endif required>{{ $classe->name }}</option>
                    @endforeach
                </x-selectbox>
            </div> 

            <div class="flex items-center justify-center mt-4">
                <x-primary-button >
                    Valider
                </x-primary-button>
            </div>
        </form>
    </div>
</div>