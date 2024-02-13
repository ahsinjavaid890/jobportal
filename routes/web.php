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

Route::group([
  'as' => 'admin.',
  'prefix' => 'admin',
  'namespace' => 'Admin',
  'middleware' => [
    'auth', 'role:superadmin|admin'
  ]
], function () {
  Route::get(
    '/',
    function () {
      return redirect()->route('admin.dashboard');
    }
  );
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

  Route::get('/categories/paginate', 'CategoryController@paginate')->name('categories.paginate');
  Route::resource('/categories', 'CategoryController');

  Route::get('/skills/paginate', 'SkillController@paginate')->name('skills.paginate');
  Route::resource('/skills', 'SkillController');
  Route::get('/skills/search', 'SkillController@search')->name('skills.search');

  Route::put('/jobs/toggle-status/{job}', 'JobController@toggleStatus')->name('jobs.toggle-status');
  Route::resource('/jobs', 'JobController');
  Route::get('/admin/users/show/{user}', 'UserController@show')
    ->name('user.show');
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
