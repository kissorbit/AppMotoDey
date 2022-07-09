<?php
Route::group(['middleware' => ['auth','permission:Maketrade']],function(){
    Route::get('/Maketrade/list',array('uses'=>'MaketradeController@All','as'=>'api_Maketradelist'));
    Route::post('/Maketrade/create_or_update',array('uses'=>'MaketradeController@CreateOrUpdate','as'=>'api_Maketradecreateorupdate'));
    Route::get('/Maketrade/edit/{id}',array('uses'=>'MaketradeController@edit','as'=>'api_Maketradeedit'));
    Route::post('/Maketrade/update/{id}',array('uses'=>'MaketradeController@Update','as'=>'api_Maketradeupdate'));
    Route::delete('/Maketrade/delete/{id}',array('uses'=>'MaketradeController@Delete','as'=>'api_Maketradedelete'));
    Route::delete('/Maketrade/delete_multiple', array('uses' => 'MaketradeController@DeleteMultiple', 'as' => 'Maketradedeletemultiple'));
});
