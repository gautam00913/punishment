<div class="px-3 md:px-5 pt-2 pb-5">
    <div class="border-b mb-5 flex justify-between">
        <p class="font-semibold text-xl"> {{ $action == 'create' ? "Ajout d'une matière" : "Modification de la matière ". $matter->name }}</p>
        <button @click="show = false" class="p-2 hover:text-red-600">
            X
        </button>
    </div>
    <div>
        <form action="{{ $action == 'create' ? route('matters.store') : route('matters.update', $matter) }}" method="POST">
            @csrf
            @if ($action == "edit")
                @method('PUT')
            @endif
            <div class="mb-4">
                <x-input-label for="name" :value="__('Nom de la matière')" :required="true" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $matter->name" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label for="code" :value="__('Code de la matière')" />
                <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code') ?? $matter->code" />
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>
           
            <div class="flex items-center justify-center mt-4">
                <x-primary-button type="submit">
                     @if($action == 'create') Enregistrer @else Modifier @endif
                </x-primary-button>
            </div>
        </form>
    </div>
</div>