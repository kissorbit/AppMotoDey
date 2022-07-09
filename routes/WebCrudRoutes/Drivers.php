<?php
Route::group(['middleware' => ['web', 'auth','permission:Drivers']],function(){
    Route::get('/Drivers/',array('uses'=>'DriversController@Index','as'=>'DriversIndex'));
    Route::get('/Drivers/list',array('uses'=>'DriversController@All','as'=>'Driverslist'));
    Route::post('/Drivers/create_or_update',array('uses'=>'DriversController@CreateOrUpdate','as'=>'Driverscreateorupdate'));
    Route::get('/Drivers/edit/{id}',array('uses'=>'DriversController@edit','as'=>'Driversedit'));
    Route::post('/Drivers/update/{id}',array('uses'=>'DriversController@Update','as'=>'Driversupdate'));
    Route::delete('/Drivers/delete/{id}',array('uses'=>'DriversController@Delete','as'=>'Driversdelete'));
    Route::delete('/Drivers/delete_multiple', array('uses' => 'DriversController@DeleteMultiple', 'as' => 'Driversdeletemultiple'));
});
