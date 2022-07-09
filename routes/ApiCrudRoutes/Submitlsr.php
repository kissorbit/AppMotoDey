<?php
Route::group(['middleware' => ['auth','permission:Submitlsr']],function(){
    Route::get('/Submitlsr/list',array('uses'=>'SubmitlsrController@All','as'=>'api_Submitlsrlist'));
    Route::post('/Submitlsr/create_or_update',array('uses'=>'SubmitlsrController@CreateOrUpdate','as'=>'api_Submitlsrcreateorupdate'));
    Route::get('/Submitlsr/edit/{id}',array('uses'=>'SubmitlsrController@edit','as'=>'api_Submitlsredit'));
    Route::post('/Submitlsr/update/{id}',array('uses'=>'SubmitlsrController@Update','as'=>'api_Submitlsrupdate'));
    Route::delete('/Submitlsr/delete/{id}',array('uses'=>'SubmitlsrController@Delete','as'=>'api_Submitlsrdelete'));
    Route::delete('/Submitlsr/delete_multiple', array('uses' => 'SubmitlsrController@DeleteMultiple', 'as' => 'Submitlsrdeletemultiple'));
});
