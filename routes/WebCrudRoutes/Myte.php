<?php
Route::group(['middleware' => ['web', 'auth','permission:Myte']],function(){
    Route::get('/Myte/',array('uses'=>'MyteController@Index','as'=>'MyteIndex'));
    Route::get('/Myte/list',array('uses'=>'MyteController@All','as'=>'Mytelist'));
    Route::post('/Myte/create_or_update',array('uses'=>'MyteController@CreateOrUpdate','as'=>'Mytecreateorupdate'));
    Route::get('/Myte/edit/{id}',array('uses'=>'MyteController@edit','as'=>'Myteedit'));
    Route::post('/Myte/update/{id}',array('uses'=>'MyteController@Update','as'=>'Myteupdate'));
    Route::delete('/Myte/delete/{id}',array('uses'=>'MyteController@Delete','as'=>'Mytedelete'));
});
