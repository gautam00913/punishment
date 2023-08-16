<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- King of User -->
        <div class="mb-4">
            <x-input-label for="type" value="Type d'utilisateur" :required="true" />
            <x-selectbox id="type" class="block mt-1 w-full" name="type"  required autofocus >
                <option value="Student">Elève</option>
                <option value="Tutor">Parent d'élève</option>
                <option value="Teacher">Enseignant</option>
            </x-selectbox>
            <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>
        <x-user />

        <div class="flex items-center justify-center mt-4">
            <x-primary-button>
                {{ __('Enregistrer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
