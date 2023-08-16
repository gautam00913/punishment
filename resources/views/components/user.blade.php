@props(['hide_matricule' => false, 'hide_phone' => false, 'hide_email' => false])
<!-- Last Name -->
<div class="mb-4" x-data="">
    <x-input-label for="lastname" :value="__('Nom')" :required="true" />
    <x-text-input  x-on:input="$event.target.value = $event.target.value.toUpperCase();" id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname') ?? $user->lastname" required autocomplete="lastname" />
    <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
</div>
<!-- First Name -->
<div class="mb-4">
    <x-input-label for="firstname" :value="__('Prénom(s)')" :required="true" />
    <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname') ?? $user->firstname" required autocomplete="firstname" />
    <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
</div>
<!-- Matricule -->
@if (!$hide_matricule)
    <div class="mb-4">
        <x-input-label for="matricule" :value="__('Numéro Matricule')" :required="true" />
        <x-text-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="old('matricule') ?? $user->matricule" required />
        <x-input-error :messages="$errors->get('matricule')" class="mt-2" />
    </div>
@endif
<!-- Sexe -->
<div class="my-3">
    <div class="flex items-center" id="gender">
        <x-input-label :value="__('Sexe')" :required="true" class="mr-3" />
        <x-check-input id="genderM" type="radio" name="gender" value="M" :checked="old('gender') ? old('gender') == 'M' : $user->gender == 'M' " required />
        <x-input-label for="genderM" :value="__('Masculin')" class="mr-3" />
        <x-check-input id="genderF" type="radio" name="gender" value="F" :checked="old('gender') ? old('gender') == 'F' : $user->gender == 'F' " required />
        <x-input-label for="genderF" :value="__('Féminin')" />
    </div>
    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
</div>
<!-- Age -->
<div>
    <x-input-label for="age" :value="__('Age')" :required="true"/>
    <x-text-input id="age" class="block mt-1 w-full" type="number" name="age" :value="old('age') ?? $user->age" min="0" required />
    <x-input-error :messages="$errors->get('age')" class="mt-2" />
</div>

<!-- Email Address -->
@if (!$hide_email)
    <div class="mt-4">
        <x-input-label for="email" :value="__('Adresse Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email') ?? $user->email" autocomplete="email" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
@endif
<!-- Phone Number -->
@if (!$hide_phone)
    <div class="mt-4">
        <x-input-label for="phone" :value="__('Numéro de Téléphone')" />
        <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone') ?? $user->phone" autocomplete="phone" />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>
@endif
<!-- Picture -->
<div class="mt-4">
    <x-input-label for="picture" :value="__('Photo de Profil')" />
    <x-text-input id="picture" class="block mt-1 w-full" type="file" name="picture" :value="old('picture')" />
    <x-input-error :messages="$errors->get('picture')" class="mt-2" />
</div>