<?php
Route::group(['middleware' => ['web', 'auth','permission:Agriculture']],function(){
    Route::get('/Agriculture/',array('uses'=>'AgricultureController@Index','as'=>'AgricultureIndex'));
    Route::get('/Agriculture/list',array('uses'=>'AgricultureController@All','as'=>'Agriculturelist'));
    Route::post('/Agriculture/create_or_update',array('uses'=>'AgricultureController@CreateOrUpdate','as'=>'Agriculturecreateorupdate'));
    Route::get('/Agriculture/edit/{id}',array('uses'=>'AgricultureController@edit','as'=>'Agricultureedit'));
    Route::post('/Agriculture/update/{id}',array('uses'=>'AgricultureController@Update','as'=>'Agricultureupdate'));
    Route::delete('/Agriculture/delete/{id}',array('uses'=>'AgricultureController@Delete','as'=>'Agriculturedelete'));
    Route::delete('/Agriculture/delete_multiple', array('uses' => 'AgricultureController@DeleteMultiple', 'as' => 'Agriculturedeletemultiple'));
});
