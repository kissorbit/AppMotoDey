<?php
Route::group(['middleware' => ['auth','permission:Submitlsp']],function(){
    Route::get('/Submitlsp/list',array('uses'=>'SubmitlspController@All','as'=>'api_Submitlsplist'));
    Route::post('/Submitlsp/create_or_update',array('uses'=>'SubmitlspController@CreateOrUpdate','as'=>'api_Submitlspcreateorupdate'));
    Route::get('/Submitlsp/edit/{id}',array('uses'=>'SubmitlspController@edit','as'=>'api_Submitlspedit'));
    Route::post('/Submitlsp/update/{id}',array('uses'=>'SubmitlspController@Update','as'=>'api_Submitlspupdate'));
    Route::delete('/Submitlsp/delete/{id}',array('uses'=>'SubmitlspController@Delete','as'=>'api_Submitlspdelete'));
    Route::delete('/Submitlsp/delete_multiple', array('uses' => 'SubmitlspController@DeleteMultiple', 'as' => 'Submitlspdeletemultiple'));
});
