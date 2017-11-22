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

    'accepted'             => ':attribute verður að vera samþykkt.',
    'active_url'           => ':attribute er ekki gilt lén.',
    'after'                => ':attribute verður að vera dagsetning eftir :date.',
    'alpha'                => ':attribute má aðeins innihalda bókstafi',
    'alpha_dash'           => ':attribute má aðeins innihalda bókstafi, númer og bandstrik.',
    'alpha_num'            => ':attribute má aðeins innihalda bókstafi og númer.',
    'array'                => ':attribute verður að vera fjölbreytt.',
    'before'               => ':attribute verður að vera dagsetning fyrir :date.',
    'between'              => [
        'numeric' => ':attribute verður að vera á milli :min og :max.',
        'file'    => ':attribute verður að vera á milli :min og :max kilobæt.',
        'string'  => ':attribute verður að vera á milli :min og :max stafir.',
        'array'   => ':attribute verður að vera á milli :min og :max hlutir.',
    ],
    'boolean'              => ':attribute reitur verður að vera réttur eða rangur.',
    'confirmed'            => ':attribute staðfestingin passar ekki við.',
    'date'                 => ':attribute er ekki gild dagsetning.',
    'date_format'          => ':attribute passar ekki við snið :format.',
    'different'            => ':attribute og :other verður að vera mismunandi.',
    'digits'               => ':attribute verður að vera :digits tölur.',
    'digits_between'       => ':attribute verður að vera á milli :min og :max tölur.',
    'email'                => ':attribute verður að vera gillt email.',
    'filled'               => ':attribute reitur er krafist.',
    'exists'               => 'Valið :attribute er nú þegar til.',
    'image'                => ':attribute verður að vera mynd.',
    'in'                   => 'Valið :attribute er ógillt.',
    'integer'              => ':attribute verður að vera heiltala.',
    'ip'                   => ':attribute verður að vera gild IP tala.',
    'max'                  => [
        'numeric' => ':attribute má ekki vera meira en :max.',
        'file'    => ':attribute má ekki vera meira en :max kilobæt.',
        'string'  => ':attribute má ekki vera meira en :max stafir.',
        'array'   => ':attribute má ekki innihalda meira en :max hluti.',
    ],
    'mimes'                => ':attribute verður að vera skrá af tegundinni: :values.',
    'min'                  => [
        'numeric' => ':attribute verður að vera að minsta kosti :min.',
        'file'    => ':attribute verður að vera að minsta kosti :min kilobæt.',
        'string'  => ':attribute verður að vera að minsta kosti :min stafi.',
        'array'   => ':attribute verður að innihalda að minsta kosti :min hluti.',
    ],
    'not_in'               => 'Valið :attribute er ógilt.',
    'numeric'              => ':attribute verður að vera númer.',
    'regex'                => ':attribute snið er ógillt.',
    'required'             => ':attribute reitur er krafist.',
    'required_if'          => ':attribute reitur er krafist þegar :other er :value.',
    'required_with'        => ':attribute reitur er krafist þegar :values til staðar.',
    'required_with_all'    => ':attribute reitur er krafist þegar :values er til staðar.',
    'required_without'     => ':attribute reitur er krafist þegar :values er ekki til staðar.',
    'required_without_all' => ':attribute reitur er krafist þegar  engin af :values er til staðar.',
    'same'                 => ':attribute og :other verður að passa saman.',
    'size'                 => [
        'numeric' => ':attribute verður að vera :size.',
        'file'    => ':attribute verður að vera :size kilobæt.',
        'string'  => ':attribute verður að vera :size stafir.',
        'array'   => ':attribute verður að innihalda :size hluti.',
    ],
    'string'               => ':attribute verður að vera strengur.',
    'timezone'             => ':attribute verður að vera gilt belti.',
    'unique'               => ':attribute er nú þegar í notkun.',
    'url'                  => ':attribute snið er ógilt.',

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
