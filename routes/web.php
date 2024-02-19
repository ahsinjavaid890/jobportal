<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'FrontController@index')->name('welcome');



Route::get('/search', 'FrontController@search')
  ->name('search')
  ->middleware(['auth', 'role:user']);
Route::get('/ajax/search', 'FrontController@ajaxSearch')
  ->name('ajax.job.search');
Route::get('/job/{job:slug}', 'FrontController@job')
  ->name('job.view')
  ->middleware(['auth', 'role:user']);
Route::post('/job/appy/{id}/user/{user:id}', 'FrontController@apply')
  ->name('job.apply')
  ->middleware(['auth', 'role:user']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth', 'role:superadmin|admin']
], function () {
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
  Route::put('/jobs/toggle-status/{job}', 'JobController@toggleStatus')->name('jobs.toggle-status');
  Route::resource('/jobs', 'JobController');
  Route::get('/admin/users/show/{user}', 'UserController@show')->name('user.show');



  Route::name('categories.')->prefix('categories')->group(function(){
      Route::get('/','CategoryController@index');
      Route::post('/createcategory','CategoryController@createcategory');
      Route::post('/updatecategory','CategoryController@updatecategory');
      Route::get('deletecategory/{id}','CategoryController@deletecategory');
  });
  Route::name('skills.')->prefix('skills')->group(function(){
      Route::get('/','SkillController@index');
      Route::post('/createskill','SkillController@createskill');
      Route::post('/updateskill','SkillController@updateskill');
      Route::get('deleteskill/{id}','SkillController@deleteskill');
  });
  Route::name('contact.')->prefix('contact')->group(function(){
      Route::get('/messages','DashboardController@messages');
      Route::get('/viewmessage/{id}','DashboardController@viewmessage'); 
      Route::get('/deletemessage/{id}','DashboardController@deletemessage');   
  });
  Route::name('blogs.')->prefix('blogs')->group(function(){
      Route::get('/blogcategories','DashboardController@blogcategories');
      Route::post('/addnewblogcategory','DashboardController@addnewblogcategory');
      Route::post('/updatblogcategory','DashboardController@updatblogcategory');
      Route::get('/deleteblogcategory/{id}','DashboardController@deleteblogcategory');
      Route::get('/allblogs','DashboardController@allblogs');
      Route::post('/addnewblog','DashboardController@createblog');
      Route::post('/updateblog','DashboardController@updateblog');
      Route::get('/deleteblog/{id}','DashboardController@deleteblog');
  });
});

Route::group([
  'as' => 'user.',
  'prefix' => 'user',
  'namespace' => 'User',
  'middleware' => [
    'auth', 'role:user'
  ]
], function () {
  Route::get(
    '/',
    function () {
      return redirect()->route('user.dashboard');
    }
  );
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
  Route::get('/settings/profile/show-profile', 'ProfileController@showProfile')->name('profile.showProfile');
  Route::put('/settings/profile/change-password', 'ProfileController@changePassword')->name('profile.changePassword');
  Route::resource('/settings/profile', 'ProfileController');
});


