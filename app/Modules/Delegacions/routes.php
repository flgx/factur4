<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['middleware' => 'auth.admin', 'prefix' => 'delegacions', 'namespace' => 'FI\Modules\Delegacions\Controllers'], function ()
{
    Route::get('', ['uses' => 'DelegacionsController@llistardelegacions','as' => 'delegacions.index']);
    Route::post('crear', 'DelegacionsController@creardelegacions');
    Route::get('crear', 'DelegacionsController@veurecreardelegacions');
    Route::get('veure/{id}', 'DelegacionsController@veuredelegacions');
    Route::post('editar/{id}', 'DelegacionsController@updatedelegacions');
    Route::get('editar/{id}', 'DelegacionsController@editardelegacions');
    Route::get('esborrar/{id}', 'DelegacionsController@esborrardelegacions');
});