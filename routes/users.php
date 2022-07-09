<?php
//Users Controller
Route::get('/users', array('uses' => 'UsersController@index', 'as' => 'users'));
Route::get('/users/list', array('uses' => 'UsersController@All', 'as' => 'userslist'));
Route::get('/users/edit/{id}', array('uses' => 'UsersController@edit', 'as' => 'usersedit'));
Route::post('/users/createorupdate', array('uses' => 'UsersController@CreateOrUpdate', 'as' => 'userscreateorupdate'));
Route::get('/users/delete/{id}', array('uses' => 'UsersController@Delete', 'as' => 'usersdelete'));
Route::delete('/users/delete_multiple',array('uses'=>'UsersController@DeleteMultiple','as'=>'usersdeletemultiple'));
//Profile
Route::get('/users/profile', array('uses' => 'UsersController@Profile', 'as' => 'userprofile'));
Route::post('/users/profileUpdate', array('uses' => 'UsersController@ProfileUpdate', 'as' => 'userprofileupdate'));

?>
