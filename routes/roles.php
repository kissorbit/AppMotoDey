<?php
Route::get('/users/roles', array('uses' => 'RolesController@Roles', 'as' => 'roles'));
Route::get('/users/getroles', array('uses' => 'RolesController@GetRoles', 'as' => 'getroles'));
Route::get('/roles/edit/{id}', array('uses' => 'RolesController@edit', 'as' => 'rolesedit'));
Route::post('/roles/createorupdate', array('uses' => 'RolesController@CreateOrUpdate', 'as' => 'rolescreateorupdate'));
Route::get('/roles/delete/{id}', array('uses' => 'RolesController@Delete', 'as' => 'rolesdelete'));
Route::delete('/roles/deletemultiple', array('uses' => 'RolesController@DeleteMultiple', 'as' => 'rolesdeletemultiple'));
