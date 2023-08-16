<div class="px-3 md:px-5 pt-2 pb-5">
    <div class="border-b mb-5 flex justify-between">
        <p class="font-semibold text-xl"> Attribution de salles de cours</p>
        <button @click="show = false" class="p-2 hover:text-red-600">
            X
        </button>
    </div>
    <div x-data="">
        <form method="POST" action="{{ route('teachers.classes', $teacher->id) }}">
            @csrf
           
            <div class="grid grid-cols-2 md:grid-cols-4">
                @foreach ($classes as $classe)
                <div class="flex items-center">
                    <x-check-input id="classe_{{ $classe->id }}" type="checkbox" name="classes[]" value="{{ $classe->id }}" :checked="$teacher->principal_at == $classe->id || $teacher->classes->pluck('id')->contains($classe->id)" />
                    <x-input-label for="classe_{{ $classe->id }}" :value="$classe->name" class="ml-2" />
                </div>
                @endforeach
            </div> 
            <div class="flex items-center justify-center mt-4">
                <x-primary-button >
                    Valider
                </x-primary-button>
            </div>
        </form>
    </div>
</div>