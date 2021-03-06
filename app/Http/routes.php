<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Post;
use App\User;

/*
|--------------------------------------------------------------------------
| CMS - Admin
|--------------------------------------------------------------------------
|
| Ici se trouvent les routes vers l'administration du site
|
*/

Route::get('api-test', function() {
    $user = User::find(1)->toArray();

    return Response::json($user);
});

Route::group(['prefix' => 'admin'], function() {

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', ['as' => 'admin.home', 'uses' => 'Admin\HomeController@index']);
        Route::resource('posts', 'Admin\PostsController');
        Route::resource('metiers', 'Admin\JobsController');
        Route::resource('users', 'Admin\UsersController');
        Route::delete('users/{$id}', ['as' => 'remove_user', 'uses' => 'Admin\UsersController@destroy']);
        Route::resource('questions', 'Admin\QuestionsController');
        Route::resource('stats', 'Admin\StatsController');
        Route::resource('gestion', 'Admin\GestionController');
        Route::get('groupe/{id}', 'Admin\GestionController@groupe');
        Route::post('/gestion', ['as' => 'gestion_utilisateur', 'uses' => 'Admin\GestionController@addUser']);

    });

    Route::controllers([
        'auth'     => 'Admin\Auth\AuthController',
        'password' => 'Admin\Auth\PasswordController',
    ]);
});

/*
|--------------------------------------------------------------------------
| Site web
|--------------------------------------------------------------------------
|
| Les routes vers les pages du site
|
*/

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@landing');

Route::get('/blog', 'BlogController@index');

Route::get('/blog/{id}/{title?}', 'BlogController@article');
Route::get('/monblog/{id}/{username}', 'BlogController@allArticlesUser');

Route::get('/jobs', 'JobsController@index');

Route::get('/jobs/job', 'JobsController@description');

Route::get('/mentions', 'MotionsController@index');

Route::get('/inscription', 'SubController@sub');

Route::get('/inscription/validation', 'SubController@subvalid');
Route::post('/inscription/validation', ['as' => 'envoi_justificatif', 'uses' => 'SubController@send']);

Route::get('/apropos', 'AboutusController@index');

Route::get('/compte', [
    'as' => 'compte',
    'uses' => 'CompteController@index',
    'middleware' => 'auth.public'
]);

Route::resource('compte', 'CompteController');

Route::patch('/compte', ['as' => 'avatar_update', 'uses' => 'CompteController@avatar']);

Route::post('/compte', ['as' => 'envoi_justif', 'uses' => 'CompteController@send']);

Route::get('/adhesion', 'AdhesionController@index');

Route::get('/contact', 
  ['as' => 'contact', 'uses' => 'ContactController@index']);

Route::post('/contact', ['as' => 'contact_store', 'uses' => 'ContactController@store']);

/*
|--------------------------------------------------------------------------
| Authentification de la partie public
|--------------------------------------------------------------------------
*/

Route::controllers([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
|
| Il s'agit des routes liées à l'API
|
*/

//Route::group(['prefix' => 'api', 'after' => 'allowOrigin'], function () {
//    Route::get('posts', function(){
//        $posts = Post::get();
//        return Response::json(['status' => 200, 'posts' => $posts->toArray()]);
//    });
//    Route::get('posts/{id}', function($id){
//        $posts = Post::find($id);
//        return Response::json(['status' => 200, 'posts' => $posts->toArray()]);
//    });
//});