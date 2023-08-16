<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'L’attribut :attribute doit être accepté.',
    'accepted_if' => 'L’attribut :attribute doit être accepté lorsque :other est :value.',
    'active_url' => 'L’attribut :attribute n\'est pas une URL valide .',
    'after' => 'L’attribut :attribute doit être supérieur à la date :date.',
    'after_or_equal' => 'L’attribut :attribute doit être supérieur ou égal à la date :date.',
    'alpha' => 'L’attribut :attribute ne doit contenir que des lettres.',
    'alpha_dash' => 'L’attribut :attribute ne doit contenir que des lettres, des nombres, et des symboles(#, _).',
    'alpha_num' => 'L’attribut :attribute ne doit contenir que des lettres et des nombres.',
    'array' => 'L’attribut :attribute doit être un tableau de collection.',
    'before' => 'L’attribut :attribute doit être une date inférieure à la date du :date.',
    'before_or_equal' => 'L’attribut :attribute doit être une date inférieure ou égal à la date :date.',
    'between' => [
        'numeric' => 'L’attribut :attribute doit être compris entre :min et :max.',
        'file' => 'L’attribut :attribute doit être compris entre :min et :max kilo Octets.',
        'string' => 'L’attribut :attribute doit être compris entre :min et :max caractères.',
        'array' => 'L’attribut :attribute doit avoir entre :min et :max éléments.',
    ],
    'boolean' => 'Le champ :attribute doit être vrai ou faux.',
    'confirmed' => 'La confirmation de l’attribut :attribute ne correspond pas.',
    'current_password' => 'Le mot de passe est incorrect.',
    'date' => 'L’attribut :attribute n\'est pas une date valide.',
    'date_equals' => 'L’attribut :attribute doit être une date égal à :date.',
    'date_format' => 'L’attribut :attribute ne correspond pas au format :format.',
    'different' => 'L’attribut :attribute et :other doivent être différents.',
    'digits' => 'L’attribut :attribute doit être :digits chiffres.',
    'digits_between' => 'L’attribut :attribute doit être compris entre :min et :max chiffres.',
    'dimensions' => 'L’attribut :attribute has invalid image dimensions.',
    'distinct' => 'L’attribut :attribute field has a duplicate value.',
    'email' => 'L’attribut :attribute doit être une adresse email valide.',
    'ends_with' => 'L’attribut :attribute must end with one of the following: :values.',
    'exists' => 'L’attribut :attribute sélectionné n’est pas valide.',
    'file' => 'L’attribut :attribute doit être un fichier.',
    'filled' => 'Le champ :attribute doit contenir une valeur.',
    'gt' => [
        'numeric' => 'L’attribut :attribute doit être supérieur à :value.',
        'file' => 'L’attribut :attribute doit être supérieur à :value kilo Octets.',
        'string' => 'L’attribut :attribute doit être supérieur à :value caractères.',
        'array' => 'L’attribut :attribute doit avoir plus que :value éléments.',
    ],
    'gte' => [
        'numeric' => 'L’attribut :attribute doit être supérieur ou égal à :value.',
        'file' => 'L’attribut :attribute doit être supérieur ou égal à :value kilo Octets.',
        'string' => 'L’attribut :attribute doit être supérieur ou égal à :value caractères.',
        'array' => 'L’attribut :attribute doit avoir :value éléments ou plus.',
    ],
    'image' => 'L’attribut :attribute doit être une image.',
    'in' => 'L’attribut :attribute selectionné  est invalide.',
    'in_array' => 'Le champ :attribute n\'existe pas dans la liste :other.',
    'integer' => 'L’attribut :attribute doit être un entier.',
    'ip' => 'L’attribut :attribute must be a valid IP address.',
    'ipv4' => 'L’attribut :attribute must be a valid IPv4 address.',
    'ipv6' => 'L’attribut :attribute must be a valid IPv6 address.',
    'json' => 'L’attribut :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'L’attribut :attribute must be less than :value.',
        'file' => 'L’attribut :attribute must be less than :value kilo Octets.',
        'string' => 'L’attribut :attribute must be less than :value caractères.',
        'array' => 'L’attribut :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'L’attribut :attribute must be less than or equal to :value.',
        'file' => 'L’attribut :attribute must be less than or equal to :value kilo Octets.',
        'string' => 'L’attribut :attribute must be less than or equal to :value characters.',
        'array' => 'L’attribut :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'L’attribut :attribute must not be greater than :max.',
        'file' => 'L’attribut :attribute must not be greater than :max kilo Octets.',
        'string' => 'L’attribut :attribute must not be greater than :max characters.',
        'array' => 'L’attribut :attribute must not have more than :max items.',
    ],
    'mimes' => 'L’attribut :attribute doit être un fichier de type: :values.',
    'mimetypes' => 'L’attribut :attribute doit être un fichier de type: :values.',
    'min' => [
        'numeric' => 'L’attribut :attribute doit être au minimum :min.',
        'file' => 'L’attribut :attribute doit être au moins de :min kilo Octets.',
        'string' => 'L’attribut :attribute doit être au moins de :min caractères.',
        'array' => 'L’attribut :attribute doit avoir au moins :min éléments.',
    ],
    'multiple_of' => 'L’attribut :attribute must be a multiple of :value.',
    'not_in' => 'L’attribut selected :attribute is invalid.',
    'not_regex' => 'L’attribut :attribute format is invalid.',
    'numeric' => 'L’attribut :attribute must be a number.',
    'password' => 'Le mot de passe est incorrect.',
    'present' => 'Le champ :attribute doit être présent.',
    'regex' => 'Le format de l’attribut :attribute est invalide.',
    'required' => 'Le champ :attribute est requis.',
    'required_if' => 'Le champ :attribute est requis lorsque :other est :value.',
    'required_unless' => 'L’attribut :attribute field is required unless :other is in :values.',
    'required_with' => 'L’attribut :attribute field is required when :values is present.',
    'required_with_all' => 'L’attribut :attribute field is required when :values are present.',
    'required_without' => 'L’attribut :attribute field is required when :values is not present.',
    'required_without_all' => 'L’attribut :attribute field is required when none of :values are present.',
    'prohibited' => 'L’attribut :attribute field is prohibited.',
    'prohibited_if' => 'L’attribut :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'L’attribut :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'L’attribut :attribute field prohibits :other from being present.',
    'same' => 'L’attribut :attribute and :other must match.',
    'size' => [
        'numeric' => 'L’attribut :attribute must be :size.',
        'file' => 'L’attribut :attribute must be :size kilo Octets.',
        'string' => 'L’attribut :attribute must be :size characters.',
        'array' => 'L’attribut :attribute must contain :size items.',
    ],
    'starts_with' => 'L’attribut :attribute must start with one of the following: :values.',
    'string' => 'L’attribut :attribute doit être une chaine de caractères.',
    'timezone' => 'L’attribut :attribute must be a valid timezone.',
    'unique' => 'L’attribut :attribute a déjà été pris.',
    'uploaded' => 'L’attribut :attribute failed to upload.',
    'url' => 'L’attribut :attribute must be a valid URL.',
    'uuid' => 'L’attribut :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
