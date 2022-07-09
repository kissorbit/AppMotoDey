<?php
Route::get('/users/permissions', array('uses' => 'PermissionsController@Permissions', 'as' => 'permissions'));
Route::get('/users/getpermissions', array('uses' => 'PermissionsController@GetPermissions', 'as' => 'getpermissions'));
Route::post('/users/permissions', array('uses' => 'PermissionsController@PermisionsManipulation', 'as' => 'permissionsman'));
Route::get('/permissions/edit/{id}', array('uses' => 'PermissionsController@edit', 'as' => 'permissionsedit'));
Route::post('/permissions/createorupdate', array('uses' => 'PermissionsController@CreateOrUpdate', 'as' => 'permissionscreateorupdate'));
Route::get('/permissions/delete/{id}', array('uses' => 'PermissionsController@Delete', 'as' => 'permissionsdelete'));
Route::delete('/permissions/deletemultiple', array('uses' => 'PermissionsController@DeleteMultiple', 'as' => 'permissionsdeletemultiple'));