<?php
Route::group(['middleware' => ['web', 'auth','permission:Truckconstruction']],function(){
    Route::get('/Truckconstruction/',array('uses'=>'TruckconstructionController@Index','as'=>'TruckconstructionIndex'));
    Route::get('/Truckconstruction/list',array('uses'=>'TruckconstructionController@All','as'=>'Truckconstructionlist'));
    Route::post('/Truckconstruction/create_or_update',array('uses'=>'TruckconstructionController@CreateOrUpdate','as'=>'Truckconstructioncreateorupdate'));
    Route::get('/Truckconstruction/edit/{id}',array('uses'=>'TruckconstructionController@edit','as'=>'Truckconstructionedit'));
    Route::post('/Truckconstruction/update/{id}',array('uses'=>'TruckconstructionController@Update','as'=>'Truckconstructionupdate'));
    Route::delete('/Truckconstruction/delete/{id}',array('uses'=>'TruckconstructionController@Delete','as'=>'Truckconstructiondelete'));
    Route::delete('/Truckconstruction/delete_multiple', array('uses' => 'TruckconstructionController@DeleteMultiple', 'as' => 'Truckconstructiondeletemultiple'));
});
