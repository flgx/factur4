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

    'accepted'             => ':attribute må være godkjent.',
    'active_url'           => ':attribute er ikke gyldig URL.',
    'after'                => ':attribute må være dato etter :date.',
    'alpha'                => ':attribute kan kun inneholde bokstaver.',
    'alpha_dash'           => ':attribute kan kun inneholde bokstaver, tall og streker.',
    'alpha_num'            => ':attribute kan kun inneholde bokstaver og tall.',
    'array'                => ':attribute må være rekke.',
    'before'               => ':attribute må være dato før :date.',
    'between'              => [
        'numeric' => ':attribute må være i mellom :min og :max.',
        'file'    => ':attribute må være i mellom :min og :max kilobytes.',
        'string'  => ':attribute må inneholde i mellom :min og :max bokstaver.',
        'array'   => ':attribute må ha i mellom :min og :max.',
    ],
    'boolean'              => ':attribute feltet må være sant eller usant.',
    'confirmed'            => ':attribute bekreftelsen passer ikke sammen.',
    'date'                 => ':attribute er ikke gyldig dato.',
    'date_format'          => ':attribute does not match the format :format.',
    'different'            => ':attribute og :other må være annerledes.',
    'digits'               => ':attribute må være :digits tall.',
    'digits_between'       => ':attribute må være i mellom :min og :max tall.',
    'email'                => ':attribute må være gyldig email adresse.',
    'filled'               => ':attribute feltet er påkrevd.',
    'exists'               => 'Valgt :attribute er ugyldig.',
    'image'                => ':attribute må være bildefil.',
    'in'                   => 'Valgt :attribute er ugyldig.',
    'integer'              => ':attribute må være et heltall.',
    'ip'                   => ':attribute må være gyldig IP adresse.',
    'max'                  => [
        'numeric' => ':attribute kan ikke være større en :max.',
        'file'    => ':attribute kan ikke være større en :max kilobytes.',
        'string'  => ':attribute kan ikke inneholde flere en :max bokstaver.',
        'array'   => ':attribute kan ikke ha flere en :max ting.',
    ],
    'mimes'                => ':attribute må være av filtypen: :values.',
    'min'                  => [
        'numeric' => ':attribute må være minst :min.',
        'file'    => ':attribute må være i vertfall :min kilobytes.',
        'string'  => ':attribute må inneholde i vertfall :min bokstaver.',
        'array'   => ':attribute må ha minst :min ting.',
    ],
    'not_in'               => 'Valgt :attribute er ugyldig.',
    'numeric'              => ':attribute må være et tall.',
    'regex'                => ':attribute format er ugyldig.',
    'required'             => ':attribute feltet er påkrevd.',
    'required_if'          => ':attribute feltet er påkrevd når :other er :value.',
    'required_with'        => ':attribute feltet er påkrevd når :values er til stede.',
    'required_with_all'    => ':attribute feltet er påkrevd når :values er til stede.',
    'required_without'     => ':attribute feltet er påkrevd når :values er ikke til stede.',
    'required_without_all' => ':attribute feltet er påkrevd når ingen av :values er til stede.',
    'same'                 => ':attribute og :other må samsvare.',
    'size'                 => [
        'numeric' => ':attribute må være :size.',
        'file'    => ':attribute må være :size kilobytes.',
        'string'  => ':attribute må inneholde :size bokstaver.',
        'array'   => ':attribute må inneholde :size ting.',
    ],
    'string'               => ':attribute må være en string.',
    'timezone'             => ':attribute må være en gyldig sone.',
    'unique'               => ':attribute er allerede i bruk.',
    'url'                  => ':attribute format er ugyldig.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
