<?php
/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */



/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */

Route::group(['middleware' => ['web']], function () {
    
    Route::get('/CheckMigrationClass', 'ModuleBuilderController@CheckMigrationClass');
    //Route::get('auth/login', 'Auth\AuthController@getLogin');
    //Route::post('auth/login', 'Auth\AuthController@postLogin');
    //Route::get('auth/logout', 'Auth\AuthController@getLogout');
    Route::get('/login', array('uses' => 'UsersController@Login','as'=>'login'));
    Route::post('/login', array('uses' => 'UsersController@auth'));
    Route::get('/register', array('uses' => 'UsersController@register'));
    Route::post('/register', array('uses' => 'UsersController@RegisterPost'));
    Route::get('/install', array('uses' => 'InstallController@index'));
    Route::post('/install', array('uses' => 'InstallController@InstallProcess','as'=>'InstallProcess'));
    Route::get('/InstallstepTow', array('uses' => 'InstallController@InstallStepTow','as'=>'InstallStepTow'));
    Route::post('/InstallMigration', array('uses' => 'InstallController@InstallMigration','as'=>'InstallMigration'));
    Route::get('/RegisterUserToAdmin', array('uses' => 'UsersController@RegisterUserToAdmin'));
    
    
    Route::get('privacy', 'UsersController@privacyPolicy');
    Route::get('login/facebook', array('uses'=>'UsersController@redirectToFacebookProvider','as'=>'facebookLogin'));
    Route::get('login/facebook/callback', 'UsersController@handleFacebookCallback');
    Route::get('login/google', array('uses'=>'UsersController@redirectToGoogleProvider','as'=>'googleLogin'));
    Route::get('login/google/callback', 'UsersController@handleGoogleCallback');
    Route::get('login/twitter', array('uses'=>'UsersController@redirectToTwitterProvider','as'=>'twitterLogin'));
    Route::get('login/twitter/callback', 'UsersController@handleTwitterCallback');
});

Route::group(['middleware' => ['web', 'auth','permission:users','XSS']], function () {
    // List - create - Edit/id - Update/id - Delete/
    //Users Routes
    require(base_path() . '/routes/users.php');
    require(base_path() . '/routes/GeneralSettings.php');
});
Route::group(['middleware' => ['web', 'auth','permission:filemanager']], function () {
    Route::get('/filemanage', array('uses' => 'AdminController@FileManage'));
});
Route::group(['middleware' => ['web', 'auth','permission:roles','XSS']], function () {
    //Mange Roles
    require(base_path() . '/routes/roles.php');
});
Route::group(['middleware' => ['web', 'auth','permission:permissions','XSS']], function () {
    //Manage Permissions 
    require(base_path() . '/routes/permissions.php');
});
Route::group(['middleware' => ['web', 'auth','permission:modulebuilder_modules|modulebuilder_menu','XSS']], function () {
    //ModuleBuilder
    require(base_path() . '/routes/modulebuilder.php');
});
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/', ['uses' => 'AdminController@DashBoard']);
    Route::get('/logout', array('uses' => 'UsersController@Logout', 'as' => 'logout'));
    
    
    //Route::resource('auth' , 'Auth\AuthController');
    Route::resource('password'  , 'Auth\PasswordController');
    //Crud Routes
    require(base_path() . '/routes/WebCrudRoutes.php');
    //Facebook
    Route::get('/facebookTest', array('uses' => 'FacebookController@facebookTest', 'as' => 'FacebookTest'));
    Route::get('/pdftest', array('uses' => 'ModuleBuilderController@GeneratePDF', 'as' => 'GeneratePDF'));
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
