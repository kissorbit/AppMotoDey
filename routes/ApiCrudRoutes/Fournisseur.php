<?php
Route::group(['middleware' => ['auth','permission:Fournisseur']],function(){
    Route::get('/Fournisseur/list',array('uses'=>'FournisseurController@All','as'=>'api_Fournisseurlist'));
    Route::post('/Fournisseur/create_or_update',array('uses'=>'FournisseurController@CreateOrUpdate','as'=>'api_Fournisseurcreateorupdate'));
    Route::get('/Fournisseur/edit/{id}',array('uses'=>'FournisseurController@edit','as'=>'api_Fournisseuredit'));
    Route::post('/Fournisseur/update/{id}',array('uses'=>'FournisseurController@Update','as'=>'api_Fournisseurupdate'));
    Route::delete('/Fournisseur/delete/{id}',array('uses'=>'FournisseurController@Delete','as'=>'api_Fournisseurdelete'));
    Route::delete('/Fournisseur/delete_multiple', array('uses' => 'FournisseurController@DeleteMultiple', 'as' => 'Fournisseurdeletemultiple'));
});
