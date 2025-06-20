<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Info;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Movie;
use App\Models\Movie_Genre;
use DB;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') !== 'local') {
            \URL::forceScheme('https');
        }

        try {
            // Kiểm tra kết nối DB trước khi truy vấn
            \DB::connection()->getPdo();

            if (
                Schema::hasTable('movies') &&
                Schema::hasTable('categories') &&
                Schema::hasTable('genres') &&
                Schema::hasTable('countries')
            ) {
                $phimhot_sidebar = Movie::where('phim_hot', 1)
                    ->where('status', 1)
                    ->orderBy('ngaycapnhat', 'desc')
                    ->take(20)->get();

                $phimhot_trailer = Movie::where('resolution', 5)
                    ->where('status', 1)
                    ->orderBy('ngaycapnhat', 'desc')
                    ->take(10)->get();

                $category = Category::orderBy('id', 'desc')
                    ->where('status', 1)->get();

                $genre = Genre::orderBy('id', 'desc')->get();
                $country = Country::orderBy('id', 'desc')->get();

                $category_total = Category::count();
                $genre_total = Genre::count();
                $country_total = Country::count();
                $movie_total = Movie::count();

                $info = null;
                if (Schema::hasTable('info')) {
                    $info = Info::find(1);
                }

                View::share([
                    'info' => $info,
                    'phimhot_sidebar' => $phimhot_sidebar,
                    'phimhot_trailer' => $phimhot_trailer,
                    'category' => $category,
                    'genre' => $genre,
                    'country' => $country,
                    'country_total' => $country_total,
                    'genre_total' => $genre_total,
                    'category_total' => $category_total,
                    'movie_total' => $movie_total,
                ]);
            }
        } catch (\Exception $e) {
            \Log::warning("DB not ready in AppServiceProvider: " . $e->getMessage());
        }
    }
}
