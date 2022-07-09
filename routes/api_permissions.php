<?php
Route::get('/users/getpermissions', array('uses' => 'PermissionsController@GetPermissions', 'as' => 'getpermissions'));
Route::get('/permissions/edit/{id}', array('uses' => 'PermissionsController@edit', 'as' => 'permissionsedit'));
Route::post('/permissions/createorupdate', array('uses' => 'PermissionsController@CreateOrUpdate', 'as' => 'permissionscreateorupdate'));
Route::get('/permissions/delete/{id}', array('uses' => 'PermissionsController@Delete', 'as' => 'permissionsdelete'));
Route::delete('/permissions/deletemultiple', array('uses' => 'PermissionsController@DeleteMultiple', 'as' => 'permissionsdeletemultiple'));