<?php
Route::group(['middleware' => ['auth','permission:Drivers']],function(){
    Route::get('/Drivers/list',array('uses'=>'DriversController@All','as'=>'api_Driverslist'));
    Route::post('/Drivers/create_or_update',array('uses'=>'DriversController@CreateOrUpdate','as'=>'api_Driverscreateorupdate'));
    Route::get('/Drivers/edit/{id}',array('uses'=>'DriversController@edit','as'=>'api_Driversedit'));
    Route::post('/Drivers/update/{id}',array('uses'=>'DriversController@Update','as'=>'api_Driversupdate'));
    Route::delete('/Drivers/delete/{id}',array('uses'=>'DriversController@Delete','as'=>'api_Driversdelete'));
    Route::delete('/Drivers/delete_multiple', array('uses' => 'DriversController@DeleteMultiple', 'as' => 'Driversdeletemultiple'));
});
