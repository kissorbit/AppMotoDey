<?php
Route::group(['middleware' => ['auth','permission:Truckconstruction']],function(){
    Route::get('/Truckconstruction/list',array('uses'=>'TruckconstructionController@All','as'=>'api_Truckconstructionlist'));
    Route::post('/Truckconstruction/create_or_update',array('uses'=>'TruckconstructionController@CreateOrUpdate','as'=>'api_Truckconstructioncreateorupdate'));
    Route::get('/Truckconstruction/edit/{id}',array('uses'=>'TruckconstructionController@edit','as'=>'api_Truckconstructionedit'));
    Route::post('/Truckconstruction/update/{id}',array('uses'=>'TruckconstructionController@Update','as'=>'api_Truckconstructionupdate'));
    Route::delete('/Truckconstruction/delete/{id}',array('uses'=>'TruckconstructionController@Delete','as'=>'api_Truckconstructiondelete'));
    Route::delete('/Truckconstruction/delete_multiple', array('uses' => 'TruckconstructionController@DeleteMultiple', 'as' => 'Truckconstructiondeletemultiple'));
});
