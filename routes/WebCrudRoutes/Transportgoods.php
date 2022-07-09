<?php
Route::group(['middleware' => ['web', 'auth','permission:Transportgoods']],function(){
    Route::get('/Transportgoods/',array('uses'=>'TransportgoodsController@Index','as'=>'TransportgoodsIndex'));
    Route::get('/Transportgoods/list',array('uses'=>'TransportgoodsController@All','as'=>'Transportgoodslist'));
    Route::post('/Transportgoods/create_or_update',array('uses'=>'TransportgoodsController@CreateOrUpdate','as'=>'Transportgoodscreateorupdate'));
    Route::get('/Transportgoods/edit/{id}',array('uses'=>'TransportgoodsController@edit','as'=>'Transportgoodsedit'));
    Route::post('/Transportgoods/update/{id}',array('uses'=>'TransportgoodsController@Update','as'=>'Transportgoodsupdate'));
    Route::delete('/Transportgoods/delete/{id}',array('uses'=>'TransportgoodsController@Delete','as'=>'Transportgoodsdelete'));
    Route::delete('/Transportgoods/delete_multiple', array('uses' => 'TransportgoodsController@DeleteMultiple', 'as' => 'Transportgoodsdeletemultiple'));
});
