<?php
Route::group(['middleware' => ['auth','permission:Lsrs']],function(){
    Route::get('/Lsrs/list',array('uses'=>'LsrsController@All','as'=>'api_Lsrslist'));
    Route::post('/Lsrs/create_or_update',array('uses'=>'LsrsController@CreateOrUpdate','as'=>'api_Lsrscreateorupdate'));
    Route::get('/Lsrs/edit/{id}',array('uses'=>'LsrsController@edit','as'=>'api_Lsrsedit'));
    Route::post('/Lsrs/update/{id}',array('uses'=>'LsrsController@Update','as'=>'api_Lsrsupdate'));
    Route::delete('/Lsrs/delete/{id}',array('uses'=>'LsrsController@Delete','as'=>'api_Lsrsdelete'));
    Route::delete('/Lsrs/delete_multiple', array('uses' => 'LsrsController@DeleteMultiple', 'as' => 'Lsrsdeletemultiple'));
});
