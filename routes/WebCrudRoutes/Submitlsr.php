<?php
Route::group(['middleware' => ['web', 'auth','permission:Submitlsr']],function(){
    Route::get('/Submitlsr/',array('uses'=>'SubmitlsrController@Index','as'=>'SubmitlsrIndex'));
    Route::get('/Submitlsr/list',array('uses'=>'SubmitlsrController@All','as'=>'Submitlsrlist'));
    Route::post('/Submitlsr/create_or_update',array('uses'=>'SubmitlsrController@CreateOrUpdate','as'=>'Submitlsrcreateorupdate'));
    Route::get('/Submitlsr/edit/{id}',array('uses'=>'SubmitlsrController@edit','as'=>'Submitlsredit'));
    Route::post('/Submitlsr/update/{id}',array('uses'=>'SubmitlsrController@Update','as'=>'Submitlsrupdate'));
    Route::delete('/Submitlsr/delete/{id}',array('uses'=>'SubmitlsrController@Delete','as'=>'Submitlsrdelete'));
    Route::delete('/Submitlsr/delete_multiple', array('uses' => 'SubmitlsrController@DeleteMultiple', 'as' => 'Submitlsrdeletemultiple'));
});
