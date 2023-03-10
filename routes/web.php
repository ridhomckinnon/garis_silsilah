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

Route::get('/', 'UsersController@search');

Route::get('admin', 'AdminController@dashboard')->name('admin.dashboard');
Route::get('/admin/user', 'AdminController@user')->name('admin.user.index');
Route::post('/admin/user', 'AdminController@userStore')->name('admin.user.store');
Route::get('/admin/{user}/edit', 'AdminController@userEdit')->name('admin.user.edit');
Route::post('/admin/{user}/update', 'AdminController@userUpdate')->name('admin.user.update');
Route::delete('/admin/{user}', 'AdminController@userDestroy')->name('admin.user.destroy');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('password/change', 'Auth\ChangePasswordController@show')->name('password_change');
    Route::post('password/change', 'Auth\ChangePasswordController@update')->name('password_update');
});


Route::get('home', 'HomeController@index')->name('home');
Route::get('profile', 'HomeController@index')->name('profile');
Route::post('family-actions/{user}/set-father', 'FamilyActionsController@setFather')->name('family-actions.set-father');
Route::post('family-actions/{user}/set-mother', 'FamilyActionsController@setMother')->name('family-actions.set-mother');
Route::post('family-actions/{user}/add-child', 'FamilyActionsController@addChild')->name('family-actions.add-child');
Route::post('family-actions/{user}/add-wife', 'FamilyActionsController@addWife')->name('family-actions.add-wife');
Route::post('family-actions/{user}/add-husband', 'FamilyActionsController@addHusband')->name('family-actions.add-husband');
Route::post('family-actions/{user}/set-parent', 'FamilyActionsController@setParent')->name('family-actions.set-parent');
Route::post('family-actions/{user}/delete-child', 'FamilyActionsController@deleteChild')->name('family-actions.delete-child');

Route::get('profile-search', 'UsersController@search')->name('users.search');
Route::get('users/{user}', 'UsersController@show')->name('users.show');
Route::get('users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('users/{user}', 'UsersController@update')->name('users.update');
Route::get('users/{user}/chart', 'UsersController@chart')->name('users.chart');
Route::get('users/{user}/tree', 'UsersController@tree')->name('users.tree');
Route::get('users/{user}/death', 'UsersController@death')->name('users.death');
Route::patch('users/{user}/photo-upload', 'UsersController@photoUpload')->name('users.photo-upload');
Route::delete('users/{user}', 'UsersController@destroy')->name('users.destroy');

Route::get('users/{user}/marriages', 'UserMarriagesController@index')->name('users.marriages');

Route::get('birthdays', 'BirthdayController@index')->name('birthdays.index');

/**
 * Couple/Marriages Routes
 */
Route::get('couples/{couple}', ['as' => 'couples.show', 'uses' => 'CouplesController@show']);
Route::get('couples/{couple}/edit', ['as' => 'couples.edit', 'uses' => 'CouplesController@edit']);
Route::patch('couples/{couple}', ['as' => 'couples.update', 'uses' => 'CouplesController@update']);

/**
 * Admin only routes
 */
Route::group(['middleware' => 'admin'], function () {
    /**
     * Backup Restore Database Routes
     */
    

    Route::post('backups/upload', ['as' => 'backups.upload', 'uses' => 'BackupsController@upload']);
    Route::post('backups/{fileName}/restore', ['as' => 'backups.restore', 'uses' => 'BackupsController@restore']);
    Route::get('backups/{fileName}/dl', ['as' => 'backups.download', 'uses' => 'BackupsController@download']);
    Route::resource('backups', 'BackupsController');
});
