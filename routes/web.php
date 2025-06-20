<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
// admin controller
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LinkMovieController;

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

Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}', [IndexController::class, 'watch']);
Route::get('/so-tap', [IndexController::class, 'esipode'])->name('so-tap');
Route::get('/nam/{year}', [IndexController::class, 'year']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);
Route::get('/tim-kiem', [IndexController::class, 'timkiem'])->name('tim-kiem');
Route::get('/locphim', [IndexController::class, 'locphim'])->name('locphim');
Route::get('/phim/phimbo', [IndexController::class, 'phimbo']);
Route::post('/add-rating', [IndexController::class, 'add_rating'])->name('add-rating');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/logout', [IndexController::class, 'esipode'])->name('logout');

// route admin
Route::resource('category', CategoryController::class);
Route::resource('account', AccountController::class);
Route::resource('genre', GenreController::class);
Route::resource('country', CountryController::class);
Route::resource('episode', EpisodeController::class);
Route::get('/select-movie', [EpisodeController::class, 'select_movie']);
Route::resource('movie', MovieController::class);
Route::resource('linkmovie', LinkMovieController::class);
Route::post('resorting', [CategoryController::class, 'resorting'])->name('resorting');

// thêm tập phim
Route::get('/update-year-phim', [MovieController::class, 'update_year_phim']);
Route::get('/update-topview-phim', [MovieController::class, 'update_topview_phim']);
Route::post('/filter-topview-phim', [MovieController::class, 'filter_topview_phim']);
Route::get('/filter-topview-default', [MovieController::class, 'filter_topview_default']);
Route::get('/update-season-phim', [MovieController::class, 'update_season_phim']);

// thay đổi dữ liệu movie bằng ajax
Route::get('/category-choose', [MovieController::class, 'category_choose'])->name('category-choose');
Route::get('/country-choose', [MovieController::class, 'country_choose'])->name('country-choose');
Route::get('/thuocphim-choose', [MovieController::class, 'thuocphim_choose'])->name('thuocphim-choose');

//thông tin website
Route::resource('info', InfoController::class);

Route::get('/create_sitemap', function() {
    return Artisan::call('sitemap:create');
});