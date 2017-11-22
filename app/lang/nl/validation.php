<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	"accepted"         => "Het :attribute moet worden geaccepteerd.",
	"active_url"       => "Het :attribute is geen geldige URL.",
	"after"            => "Het :attribute moet later zijn dan :date.",
	"alpha"            => "Het :attribute mag alleen letters bevatten.",
	"alpha_dash"       => "Het :attribute mag alleen letters, cijfers en streepjes bevatten.",
	"alpha_num"        => "Het :attribute mag alleen letters en cijfers bevatten.",
	"array"            => "Het :attribute moet een array zijn.",
	"before"           => "Het :attribute moet eerder zijn dan :date.",
	"between"          => array(
		"numeric" => "Het :attribute moet tussen :min - :max zijn.",
		"file"    => "Het :attribute moet tussen :min - :max kilobytes zijn.",
		"string"  => "Het :attribute moet tussen :min - :max characters zijn.",
		"array"   => "Het :attribute moet tussen :min - :max items zijn.",
	),
	"confirmed"        => "Het :attribute bevestigingsveld komt niet overeen.",
	"date"             => "Het :attribute is geen geldige datum.",
	"date_format"      => "Het :attribute komt niet overeen met het formaat :format.",
	"different"        => "Het :attribute en :other moeten verschillen.",
	"digits"           => "Het :attribute moet :digits tekens zijn.",
	"digits_between"   => "Het :attribute tussen :min en :max tekens zijn.",
	"email"            => "Het :attribute formaat is ongeldig.",
	"exists"           => "Het geselecteerde :attribute is ongeldig.",
	"image"            => "Het :attribute moet een afbeelding zijn.",
	"in"               => "Het geselecteerde :attribute is ongeldig.",
	"integer"          => "Het :attribute moet een integer zijn.",
	"ip"               => "Het :attribute moet een geldig IP adres zijn.",
	"max"              => array(
		"numeric" => "Het :attribute mag niet groter zijn dan :max.",
		"file"    => "Het :attribute mag niet groter zijn dan :max kilobytes.",
		"string"  => "Het :attribute mag niet groter zijn dan :max characters.",
		"array"   => "Het :attribute mag niet meer bevatten dan :max items.",
	),
	"mimes"            => "Het :attribute moet een bestandstype: :values hebben.",
	"min"              => array(
		"numeric" => "Het :attribute moet minimaal :min zijn.",
		"file"    => "Het :attribute moet minimaal :min kilobytes zijn.",
		"string"  => "Het :attribute moet minimaal :min karakters hebben.",
		"array"   => "Het :attribute moet minimaal :min items hebben.",
	),
	"not_in"           => "Het geselecteerde :attribute is ongeldig.",
	"numeric"          => "Het :attribute moet een cijfer zijn.",
	"regex"            => "Het :attribute formaat is ongeldig.",
	"required"         => "Het :attribute veld is vereist.",
	"required_if"      => "Het :attribute veld is vereist wanneer :other is :value.",
	"required_with"    => "Het :attribute veld is vereist wanneer :values aanwezig is.",
	"required_without" => "Het :attribute veld is vereist wanneer :values niet aanwezig is.",
	"same"             => "Het :attribute en :other moeten overeen komen.",
	"size"             => array(
		"numeric" => "Het :attribute moet :size zijn.",
		"file"    => "Het :attribute moet :size kilobytes zijn.",
		"string"  => "Het :attribute moet :size karakters zijn.",
		"array"   => "Het :attribute moet :size items bevatten.",
	),
	"unique"           => "Het :attribute is al bezet.",
	"url"              => "Het :attribute formaat is ongeldig.",

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

	'custom' => array(),

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

	'attributes' => array(),

);
