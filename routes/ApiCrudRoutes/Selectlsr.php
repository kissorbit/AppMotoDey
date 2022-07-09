<?php
Route::group(['middleware' => ['auth','permission:Selectlsr']],function(){
    Route::get('/Selectlsr/list',array('uses'=>'SelectlsrController@All','as'=>'api_Selectlsrlist'));
    Route::post('/Selectlsr/create_or_update',array('uses'=>'SelectlsrController@CreateOrUpdate','as'=>'api_Selectlsrcreateorupdate'));
    Route::get('/Selectlsr/edit/{id}',array('uses'=>'SelectlsrController@edit','as'=>'api_Selectlsredit'));
    Route::post('/Selectlsr/update/{id}',array('uses'=>'SelectlsrController@Update','as'=>'api_Selectlsrupdate'));
    Route::delete('/Selectlsr/delete/{id}',array('uses'=>'SelectlsrController@Delete','as'=>'api_Selectlsrdelete'));
    Route::delete('/Selectlsr/delete_multiple', array('uses' => 'SelectlsrController@DeleteMultiple', 'as' => 'Selectlsrdeletemultiple'));
});
