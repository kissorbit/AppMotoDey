<?php
Route::group(['middleware' => ['auth','permission:Transportgoods']],function(){
    Route::get('/Transportgoods/list',array('uses'=>'TransportgoodsController@All','as'=>'api_Transportgoodslist'));
    Route::post('/Transportgoods/create_or_update',array('uses'=>'TransportgoodsController@CreateOrUpdate','as'=>'api_Transportgoodscreateorupdate'));
    Route::get('/Transportgoods/edit/{id}',array('uses'=>'TransportgoodsController@edit','as'=>'api_Transportgoodsedit'));
    Route::post('/Transportgoods/update/{id}',array('uses'=>'TransportgoodsController@Update','as'=>'api_Transportgoodsupdate'));
    Route::delete('/Transportgoods/delete/{id}',array('uses'=>'TransportgoodsController@Delete','as'=>'api_Transportgoodsdelete'));
    Route::delete('/Transportgoods/delete_multiple', array('uses' => 'TransportgoodsController@DeleteMultiple', 'as' => 'Transportgoodsdeletemultiple'));
});
