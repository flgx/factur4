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

	"accepted"         => ":attribute te que ser acceptat.",
	"active_url"       => ":attribute no és una URL vàlida.",
	"after"            => ":attribute deu ser una data posterior a :date.",
	"alpha"            => ":attribute només pot contenir lletres.",
	"alpha_dash"       => ":attribute només pot contenir lletres, nombres i punts.",
	"alpha_num"        => ":attribute només pot contenir lletres i nombres.",
	"array"            => ":attribute deu ser en ordre.",
	"before"           => ":attribute deu ser una data anterior a :date.",
	"between"          => array(
		"numeric" => ":attribute deu estar entre :min - :max.",
		"file"    => ":attribute deu estar entre :min - :max kilobytes.",
		"string"  => ":attribute deu estar entre :min - :max caracters.",
		"array"   => ":attribute deu tenir entre :min - :max items.",
	),
	"confirmed"        => ":attribute confirmació no és vàlida.",
	"date"             => ":attribute no és una data vàlida.",
	"date_format"      => ":attribute no coincideix amb el format de la data :format.",
	"different"        => ":attribute i :other deuen ser diferents.",
	"digits"           => ":attribute deu tenir :digits digits.",
	"digits_between"   => ":attribute deu tenir entre :min i :max digits.",
	"email"            => ":attribute format no vàlid.",
	"exists"           => ":attribute sel·leccionat no és vàlid.",
	"image"            => ":attribute deu ser una imatge.",
	"in"               => ":attribute sel·leccionat no és vàlid.",
	"integer"          => ":attribute deu ser un enter.",
	"ip"               => ":attribute deu ser una IP vàlida.",
	"max"              => array(
		"numeric" => ":attribute no pot ser major de :max.",
		"file"    => ":attribute no pot ser major de :max kilobytes.",
		"string"  => ":attribute no pot tenir més de :max caracters.",
		"array"   => ":attribute no pot tenir més de :max valors.",
	),
	"mimes"            => ":attribute deu ser un tipus de arxiu: :values.",
	"min"              => array(
		"numeric" => ":attribute deu ser al menys :min.",
		"file"    => ":attribute deu tenir al menys :min kilobytes.",
		"string"  => ":attribute deu tenir al menys :min caracteres.",
		"array"   => ":attribute deu tenir al menys :min valors.",
	),
	"not_in"           => ":attribute sel·leccionat no és vàlid.",
	"numeric"          => ":attribute deu ser numèric.",
	"regex"            => ":attribute té un format no vàlid.",
	"required"         => ":attribute és requerit.",
	"required_if"      => ":attribute és requerit quan :other és :value.",
	"required_with"    => ":attribute és requerit quan :values està present.",
	"required_without" => ":attribute és requerit quan :values no està present.",
	"same"             => ":attribute i :other deuen coincidir.",
	"size"             => array(
		"numeric" => ":attribute deu ser de :size.",
		"file"    => ":attribute deu ser de :size kilobytes.",
		"string"  => ":attribute deu ser de :size caracters.",
		"array"   => ":attribute deu contenir :size articles.",
	),
	"unique"           => ":attribute ja s'ha usat, deu ser un valor únic.",
	"url"              => ":attribute format invàlid.",

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
