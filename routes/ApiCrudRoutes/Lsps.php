<?php
Route::group(['middleware' => ['auth','permission:Lsps']],function(){
    Route::get('/Lsps/list',array('uses'=>'LspsController@All','as'=>'api_Lspslist'));
    Route::post('/Lsps/create_or_update',array('uses'=>'LspsController@CreateOrUpdate','as'=>'api_Lspscreateorupdate'));
    Route::get('/Lsps/edit/{id}',array('uses'=>'LspsController@edit','as'=>'api_Lspsedit'));
    Route::post('/Lsps/update/{id}',array('uses'=>'LspsController@Update','as'=>'api_Lspsupdate'));
    Route::delete('/Lsps/delete/{id}',array('uses'=>'LspsController@Delete','as'=>'api_Lspsdelete'));
    Route::delete('/Lsps/delete_multiple', array('uses' => 'LspsController@DeleteMultiple', 'as' => 'Lspsdeletemultiple'));
});
