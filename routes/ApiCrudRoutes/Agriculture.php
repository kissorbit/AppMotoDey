<?php
Route::group(['middleware' => ['auth','permission:Agriculture']],function(){
    Route::get('/Agriculture/list',array('uses'=>'AgricultureController@All','as'=>'api_Agriculturelist'));
    Route::post('/Agriculture/create_or_update',array('uses'=>'AgricultureController@CreateOrUpdate','as'=>'api_Agriculturecreateorupdate'));
    Route::get('/Agriculture/edit/{id}',array('uses'=>'AgricultureController@edit','as'=>'api_Agricultureedit'));
    Route::post('/Agriculture/update/{id}',array('uses'=>'AgricultureController@Update','as'=>'api_Agricultureupdate'));
    Route::delete('/Agriculture/delete/{id}',array('uses'=>'AgricultureController@Delete','as'=>'api_Agriculturedelete'));
    Route::delete('/Agriculture/delete_multiple', array('uses' => 'AgricultureController@DeleteMultiple', 'as' => 'Agriculturedeletemultiple'));
});
