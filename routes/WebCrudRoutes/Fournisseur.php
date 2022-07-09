<?php
Route::group(['middleware' => ['web', 'auth','permission:Fournisseur']],function(){
    Route::get('/Fournisseur/',array('uses'=>'FournisseurController@Index','as'=>'FournisseurIndex'));
    Route::get('/Fournisseur/list',array('uses'=>'FournisseurController@All','as'=>'Fournisseurlist'));
    Route::post('/Fournisseur/create_or_update',array('uses'=>'FournisseurController@CreateOrUpdate','as'=>'Fournisseurcreateorupdate'));
    Route::get('/Fournisseur/edit/{id}',array('uses'=>'FournisseurController@edit','as'=>'Fournisseuredit'));
    Route::post('/Fournisseur/update/{id}',array('uses'=>'FournisseurController@Update','as'=>'Fournisseurupdate'));
    Route::delete('/Fournisseur/delete/{id}',array('uses'=>'FournisseurController@Delete','as'=>'Fournisseurdelete'));
    Route::delete('/Fournisseur/delete_multiple', array('uses' => 'FournisseurController@DeleteMultiple', 'as' => 'Fournisseurdeletemultiple'));
});
