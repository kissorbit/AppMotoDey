<?php
Route::group(['middleware' => ['auth','permission:Vendor']],function(){
    Route::get('/Vendor/list',array('uses'=>'VendorController@All','as'=>'api_Vendorlist'));
    Route::post('/Vendor/create_or_update',array('uses'=>'VendorController@CreateOrUpdate','as'=>'api_Vendorcreateorupdate'));
    Route::get('/Vendor/edit/{id}',array('uses'=>'VendorController@edit','as'=>'api_Vendoredit'));
    Route::post('/Vendor/update/{id}',array('uses'=>'VendorController@Update','as'=>'api_Vendorupdate'));
    Route::delete('/Vendor/delete/{id}',array('uses'=>'VendorController@Delete','as'=>'api_Vendordelete'));
    Route::delete('/Vendor/delete_multiple', array('uses' => 'VendorController@DeleteMultiple', 'as' => 'Vendordeletemultiple'));
});
