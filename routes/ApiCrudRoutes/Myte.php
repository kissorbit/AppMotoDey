<?php
Route::group(['middleware' => ['auth','permission:Myte']],function(){
    Route::get('/Myte/list',array('uses'=>'MyteController@All','as'=>'api_Mytelist'));
    Route::post('/Myte/create_or_update',array('uses'=>'MyteController@CreateOrUpdate','as'=>'api_Mytecreateorupdate'));
    Route::get('/Myte/edit/{id}',array('uses'=>'MyteController@edit','as'=>'api_Myteedit'));
    Route::post('/Myte/update/{id}',array('uses'=>'MyteController@Update','as'=>'api_Myteupdate'));
    Route::delete('/Myte/delete/{id}',array('uses'=>'MyteController@Delete','as'=>'api_Mytedelete'));
});
