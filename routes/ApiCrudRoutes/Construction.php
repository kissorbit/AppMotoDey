<?php
Route::group(['middleware' => ['auth','permission:Construction']],function(){
    Route::get('/Construction/list',array('uses'=>'ConstructionController@All','as'=>'api_Constructionlist'));
    Route::post('/Construction/create_or_update',array('uses'=>'ConstructionController@CreateOrUpdate','as'=>'api_Constructioncreateorupdate'));
    Route::get('/Construction/edit/{id}',array('uses'=>'ConstructionController@edit','as'=>'api_Constructionedit'));
    Route::post('/Construction/update/{id}',array('uses'=>'ConstructionController@Update','as'=>'api_Constructionupdate'));
    Route::delete('/Construction/delete/{id}',array('uses'=>'ConstructionController@Delete','as'=>'api_Constructiondelete'));
    Route::delete('/Construction/delete_multiple', array('uses' => 'ConstructionController@DeleteMultiple', 'as' => 'Constructiondeletemultiple'));
});
