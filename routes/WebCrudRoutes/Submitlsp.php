<?php
Route::group(['middleware' => ['web', 'auth','permission:Submitlsp']],function(){
    Route::get('/Submitlsp/',array('uses'=>'SubmitlspController@Index','as'=>'SubmitlspIndex'));
    Route::get('/Submitlsp/list',array('uses'=>'SubmitlspController@All','as'=>'Submitlsplist'));
    Route::post('/Submitlsp/create_or_update',array('uses'=>'SubmitlspController@CreateOrUpdate','as'=>'Submitlspcreateorupdate'));
    Route::get('/Submitlsp/edit/{id}',array('uses'=>'SubmitlspController@edit','as'=>'Submitlspedit'));
    Route::post('/Submitlsp/update/{id}',array('uses'=>'SubmitlspController@Update','as'=>'Submitlspupdate'));
    Route::delete('/Submitlsp/delete/{id}',array('uses'=>'SubmitlspController@Delete','as'=>'Submitlspdelete'));
    Route::delete('/Submitlsp/delete_multiple', array('uses' => 'SubmitlspController@DeleteMultiple', 'as' => 'Submitlspdeletemultiple'));
});
