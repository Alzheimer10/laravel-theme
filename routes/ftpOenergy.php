<?php 

Route::get('/unired', 'ftpOenergy\ftpOenergyController@index')->name('unired');
Route::get('/rendiciones', 'ftpOenergy\ftpOenergyController@rendiciones');
Route::get('/open_file/{dir}/{name}', 'ftpOenergy\ftpOenergyController@open_file_view')->name('open_file');
Route::post('/dropzone', 'ftpOenergy\ftpOenergyController@dropzone');