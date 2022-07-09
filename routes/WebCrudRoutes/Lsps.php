<?php
Route::group(['middleware' => ['web', 'auth','permission:Lsps']],function(){
    Route::get('/Lsps/',array('uses'=>'LspsController@Index','as'=>'LspsIndex'));
    Route::get('/Lsps/list',array('uses'=>'LspsController@All','as'=>'Lspslist'));
    Route::post('/Lsps/create_or_update',array('uses'=>'LspsController@CreateOrUpdate','as'=>'Lspscreateorupdate'));
    Route::get('/Lsps/edit/{id}',array('uses'=>'LspsController@edit','as'=>'Lspsedit'));
    Route::post('/Lsps/update/{id}',array('uses'=>'LspsController@Update','as'=>'Lspsupdate'));
    Route::delete('/Lsps/delete/{id}',array('uses'=>'LspsController@Delete','as'=>'Lspsdelete'));
    Route::delete('/Lsps/delete_multiple', array('uses' => 'LspsController@DeleteMultiple', 'as' => 'Lspsdeletemultiple'));
});
