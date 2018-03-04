<?php 
	Route::get('/','HomeController@index')->name('home');
	Route::get('/tabla/{connection}/{tabla}','tablaController@index')->name('tabla');
	Route::resource('parametros_medidores', 'parametrosMedidoresControllers');
	Route::post('/eliminar', 'parametrosMedidoresControllers@eliminar')->name('parametros_medidores.eliminar');
	Route::get('cliente', 'parametrosMedidoresControllers@cliente')->name('parametros_medidores.cliente');