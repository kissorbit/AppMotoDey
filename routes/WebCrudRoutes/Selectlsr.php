<?php
Route::group(['middleware' => ['web', 'auth','permission:Selectlsr']],function(){
    Route::get('/Selectlsr/',array('uses'=>'SelectlsrController@Index','as'=>'SelectlsrIndex'));
    Route::get('/Selectlsr/list',array('uses'=>'SelectlsrController@All','as'=>'Selectlsrlist'));
    Route::post('/Selectlsr/create_or_update',array('uses'=>'SelectlsrController@CreateOrUpdate','as'=>'Selectlsrcreateorupdate'));
    Route::get('/Selectlsr/edit/{id}',array('uses'=>'SelectlsrController@edit','as'=>'Selectlsredit'));
    Route::post('/Selectlsr/update/{id}',array('uses'=>'SelectlsrController@Update','as'=>'Selectlsrupdate'));
    Route::delete('/Selectlsr/delete/{id}',array('uses'=>'SelectlsrController@Delete','as'=>'Selectlsrdelete'));
    Route::delete('/Selectlsr/delete_multiple', array('uses' => 'SelectlsrController@DeleteMultiple', 'as' => 'Selectlsrdeletemultiple'));
});
