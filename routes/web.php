<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});
    Route::get('/', 'HomeController@index')->name('homepage');
    Route::get('/posts', 'PostController@allpost')->name('post.all');
    Route::get('/post/{slug}', 'PostController@singlepost')->name('post.single');
    Route::get('/category/{slug}', 'PostController@postbycategory')->name('category.post');
    Route::get('/tag/{slug}', 'PostController@postbytag')->name('tag.post');
    Route::get('/search', 'SearchController@search')->name('post.search');

    Auth::routes();
//Auth::routes(['verify' => true]);


    Route::group(['middleware' => ['auth']], function () {
        route::post('favourite/{post}', 'FavouriteController@add')->name('post.favourite.add');
        route::post('comment/{post}', 'CommentController@store')->name('post.comment.store');

    });

    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
        route::get('dashboard', 'DashboardController@index')->name('dashboard');
        route::resource('tag', 'TagController');
        route::resource('category', 'CategoryController');
        route::resource('post', 'PostController');
        route::resource('subscriber', 'SubscriberController');
        route::resource('phone', 'PhoneController');
        //pending post
        route::get('pending', 'PostController@pending')->name('pendingpost');
        route::put('/post/{id}/approve/', 'PostController@approve')->name('approve');

        //favourite post
        route::get('favourite', 'FavouriteController@index')->name('favourite.post');

        //Commments
        route::get('comments/', 'CommentController@index')->name('comment.index');
        route::post('comment/{id}', 'CommentController@destroy')->name('comment.destroy');

        //Profile
        route::get('profile', 'ProfileController@index')->name('profile');
        route::put('profile-update', 'ProfileController@updateprofile')->name('profile.update');
        route::put('password-update', 'ProfileController@updatepassword')->name('password.update');

//Author show in admin
        route::get('author', 'AuthorController@index')->name('author.dashboard.show');

    });


    Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']], function () {
        route::get('dashboard', 'DashboardController@index')->name('dashboard');
        route::resource('post', 'PostController');

        //favourite post
        route::get('favourite', 'FavouriteController@index')->name('favourite.post');

        //Commments
        route::get('comments/', 'CommentController@index')->name('comment.index');
        route::post('comment/{id}', 'CommentController@destroy')->name('comment.destroy');

        //Profile
        route::get('profile', 'ProfileController@index')->name('profile');
        route::put('profile-update', 'ProfileController@updateprofile')->name('profile.update');
        route::put('password-update', 'ProfileController@updatepassword')->name('password.update');
    });


    View::composer('layouts.frontend.partial.footer', function ($view) {
        $categories = \App\Category::all();
        $view->with('categories', $categories);
    });


    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        return "Cache is cleared";
    });
    Route::get('/clear-config', function () {
        Artisan::call('config:clear');
        return "Config is cleared";
    });
    Route::get('/clear-route', function () {
        Artisan::call('route:clear');
        return "Route is cleared";
    });
