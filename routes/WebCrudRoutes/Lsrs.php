<?php
Route::group(['middleware' => ['web', 'auth','permission:Lsrs']],function(){
    Route::get('/Lsrs/',array('uses'=>'LsrsController@Index','as'=>'LsrsIndex'));
    Route::get('/Lsrs/list',array('uses'=>'LsrsController@All','as'=>'Lsrslist'));
    Route::post('/Lsrs/create_or_update',array('uses'=>'LsrsController@CreateOrUpdate','as'=>'Lsrscreateorupdate'));
    Route::get('/Lsrs/edit/{id}',array('uses'=>'LsrsController@edit','as'=>'Lsrsedit'));
    Route::post('/Lsrs/update/{id}',array('uses'=>'LsrsController@Update','as'=>'Lsrsupdate'));
    Route::delete('/Lsrs/delete/{id}',array('uses'=>'LsrsController@Delete','as'=>'Lsrsdelete'));
    Route::delete('/Lsrs/delete_multiple', array('uses' => 'LsrsController@DeleteMultiple', 'as' => 'Lsrsdeletemultiple'));
});
