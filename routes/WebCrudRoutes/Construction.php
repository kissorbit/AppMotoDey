<?php
Route::group(['middleware' => ['web', 'auth','permission:Construction']],function(){
    Route::get('/Construction/',array('uses'=>'ConstructionController@Index','as'=>'ConstructionIndex'));
    Route::get('/Construction/list',array('uses'=>'ConstructionController@All','as'=>'Constructionlist'));
    Route::post('/Construction/create_or_update',array('uses'=>'ConstructionController@CreateOrUpdate','as'=>'Constructioncreateorupdate'));
    Route::get('/Construction/edit/{id}',array('uses'=>'ConstructionController@edit','as'=>'Constructionedit'));
    Route::post('/Construction/update/{id}',array('uses'=>'ConstructionController@Update','as'=>'Constructionupdate'));
    Route::delete('/Construction/delete/{id}',array('uses'=>'ConstructionController@Delete','as'=>'Constructiondelete'));
    Route::delete('/Construction/delete_multiple', array('uses' => 'ConstructionController@DeleteMultiple', 'as' => 'Constructiondeletemultiple'));
});
