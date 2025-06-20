<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
        $info = Info::find(1);
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('10')->get();
        $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $category_total = Category::all()->count();
        $genre_total = Genre::all()->count();
        $country_total = Country::all()->count();
        $movie_total = Movie::all()->count();

        //tracking user activity
        // $total_users = DB::table('tracker_sessions')->count();
        // $total_users_week = DB::table('tracker_sessions')->where('created_at','>=',Carbon::now('Asia/Ho_Chi_Minh')->subDays(7))->count();
        // $total_users_months = DB::table('tracker_sessions')->where('created_at','>=',Carbon::now('Asia/Ho_Chi_Minh')->subMonth())->count();
        // $total_users_3months = DB::table('tracker_sessions')->where('created_at','>=',Carbon::now('Asia/Ho_Chi_Minh')->subMonth(3))->count();
        // $total_users_thisyear = DB::table('tracker_sessions')->where('created_at','>=',Carbon::now('Asia/Ho_Chi_Minh')->subYear())->count();

       
        if (env('APP_ENV') !== 'local') {
            \URL::forceScheme('https');
        }
    


        View::share([
            'country_total'=>$country_total,
            'genre_total'=>$genre_total,
            'category_total'=>$category_total,
            'movie_total'=>$movie_total,
            // 'total_users'=>$total_users,
            // 'total_users_week'=>$total_users_week,
            // 'total_users_months'=>$total_users_months,
            // 'total_users_3months'=>$total_users_3months,
            // 'total_users_thisyear'=>$total_users_thisyear
            // 'info'=>$info,
            // 'phimhot_sidebar'=>$phimhot_sidebar,
            // 'phimhot_trailer'=>$phimhot_trailer,
            // 'category'=>$category,
            // 'genre'=>$genre,
            // 'country'=>$country
        ]);
        }
}
