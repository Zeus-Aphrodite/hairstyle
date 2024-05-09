<?php
/*
|--------------------------------------------------------------------------
| CMS Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin-area" middleware group. Now create something great!
|
*/

Route::get('/', 'DashboardController@index')->name('admin.homepage');
Route::get('selections', 'DashboardController@selections')->name('admin.selections');
Route::group(['prefix' => 'haircuts'], getHaircutRoutes('haircuts'));
Route::group(['prefix' => 'packed-haircuts'], getHaircutRoutes('packed-haircuts'));

Route::get('logout', 'Auth\AuthController@logout')->name('admin.logout');
Route::get('profile/edit', 'ProfileController@edit')->name('admin.profile.edit');
Route::post('profile/edit', 'ProfileController@update')->name('admin.profile.update');

Route::delete('packs/{pack}', 'DashboardController@resetPackStats')->name('admin.pack-selections.reset');
function getHaircutRoutes(string $routePrefix): Closure
{
    return function () use ($routePrefix) {
        Route::get('create', 'HaircutsController@create')->name("admin.$routePrefix.create");
        Route::delete('{haircut}', 'HaircutsController@delete')->name("admin.$routePrefix.delete");
        Route::get('{haircut}', 'HaircutsController@edit')->name("admin.$routePrefix.edit");
        Route::put('{haircut}', 'HaircutsController@update')->name("admin.$routePrefix.update");
        Route::post('store', 'HaircutsController@store')->name("admin.$routePrefix.store");
        Route::get('/', 'HaircutsController@index')->name("admin.$routePrefix.index");
    };
}
