<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::name('home.post')->get('/post/{id}', 'AdminPostsController@post');

Route::group(['middleware'=>'admin'], function(){

	Route::get('/admin', function(){

		return view('admin.index');

	});

	Route::name('admin')->resource('/admin/users', 'AdminUsersController');
	Route::name('admin')->resource('/admin/posts', 'AdminPostsController');
	Route::name('admin')->resource('/admin/categories', 'AdminCategoriesController');
	Route::name('admin')->resource('/admin/medias', 'AdminMediasController');

	// customized admin.medias.upload if you want
	// Route::name('admin.medias.upload')->get('/admin/medias/upload', 'AdminMediasController@store');
	// customized multi-medias delete
	Route::delete('/admin/delete/medias', 'AdminMediasController@deleteMedias');

	Route::name('admin')->resource('/admin/comments', 'PostCommentsController');
	Route::name('admin.comment')->resource('/admin/comment/replies', 'CommentRepliesController');
});


Route::group(['middleware'=>'auth'], function(){

	Route::post('/comment/replies', 'CommentRepliesController@createReply');

});
//test logged user data
Route::get('/admin/test', function() {
    
    return Auth::user()->isAdmin();
});

Route::get('testurl', function (){

	return url('/');
});

