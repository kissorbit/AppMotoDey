<?php
Route::group(['middleware' => ['web', 'auth','permission:Vendor']],function(){
    Route::get('/Vendor/',array('uses'=>'VendorController@Index','as'=>'VendorIndex'));
    Route::get('/Vendor/list',array('uses'=>'VendorController@All','as'=>'Vendorlist'));
    Route::post('/Vendor/create_or_update',array('uses'=>'VendorController@CreateOrUpdate','as'=>'Vendorcreateorupdate'));
    Route::get('/Vendor/edit/{id}',array('uses'=>'VendorController@edit','as'=>'Vendoredit'));
    Route::post('/Vendor/update/{id}',array('uses'=>'VendorController@Update','as'=>'Vendorupdate'));
    Route::delete('/Vendor/delete/{id}',array('uses'=>'VendorController@Delete','as'=>'Vendordelete'));
    Route::delete('/Vendor/delete_multiple', array('uses' => 'VendorController@DeleteMultiple', 'as' => 'Vendordeletemultiple'));
});
