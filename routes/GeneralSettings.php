<?php
Route::get('/general-settings', array('uses' => 'GeneralSettingsController@index', 'as' => 'general-settings'));
Route::post('/general-settings/create_or_update', array('uses' => 'GeneralSettingsController@CreateOrUpdate', 'as' => 'GeneralSettingscreateorupdate'));
Route::post('/general-settings/update/{id}', array('uses' => 'GeneralSettingsController@Update', 'as' => 'GeneralSettingsupdate'));
