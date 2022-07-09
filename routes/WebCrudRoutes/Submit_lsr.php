<?php
Route::group(['middleware' => ['web', 'auth','permission:Submit_lsr']],function(){
    Route::get('/Submit_lsr/',array('uses'=>'Submit_lsrController@Index','as'=>'Submit_lsrIndex'));
    Route::get('/Submit_lsr/list',array('uses'=>'Submit_lsrController@All','as'=>'Submit_lsrlist'));
    Route::post('/Submit_lsr/create_or_update',array('uses'=>'Submit_lsrController@CreateOrUpdate','as'=>'Submit_lsrcreateorupdate'));
    Route::get('/Submit_lsr/edit/{id}',array('uses'=>'Submit_lsrController@edit','as'=>'Submit_lsredit'));
    Route::post('/Submit_lsr/update/{id}',array('uses'=>'Submit_lsrController@Update','as'=>'Submit_lsrupdate'));
    Route::delete('/Submit_lsr/delete/{id}',array('uses'=>'Submit_lsrController@Delete','as'=>'Submit_lsrdelete'));
    Route::delete('/Submit_lsr/delete_multiple', array('uses' => 'Submit_lsrController@DeleteMultiple', 'as' => 'Submit_lsrdeletemultiple'));
});
