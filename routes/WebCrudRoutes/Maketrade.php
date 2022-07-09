<?php
Route::group(['middleware' => ['web', 'auth','permission:Maketrade']],function(){
    Route::get('/Maketrade/',array('uses'=>'MaketradeController@Index','as'=>'MaketradeIndex'));
    Route::get('/Maketrade/list',array('uses'=>'MaketradeController@All','as'=>'Maketradelist'));
    Route::post('/Maketrade/create_or_update',array('uses'=>'MaketradeController@CreateOrUpdate','as'=>'Maketradecreateorupdate'));
    Route::get('/Maketrade/edit/{id}',array('uses'=>'MaketradeController@edit','as'=>'Maketradeedit'));
    Route::post('/Maketrade/update/{id}',array('uses'=>'MaketradeController@Update','as'=>'Maketradeupdate'));
    Route::delete('/Maketrade/delete/{id}',array('uses'=>'MaketradeController@Delete','as'=>'Maketradedelete'));
    Route::delete('/Maketrade/delete_multiple', array('uses' => 'MaketradeController@DeleteMultiple', 'as' => 'Maketradedeletemultiple'));
});
