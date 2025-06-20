<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Movie;
use App\Models\Movie_Genre;
use DB;
use Carbon\Carbon;
use App;
use File;
class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = App::make('sitemap');
        $sitemap->add(route('homepage'), Carbon::now('Asia/Ho_Chi_Minh'), '1.0', 'daily');
        // get all genre from db
        $genre = Genre::orderby('id','desc')->get();
        // add every post to the sitemap
        foreach($genre as $gen)
        {
            $sitemap->add(env('APP_URL'). "/the-loai/{$gen->slug}",Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }

        // get all genre from db
        $category = Category::orderby('id','desc')->get();
        // add every post to the sitemap
        foreach($category as $cate)
        {
            $sitemap->add(env('APP_URL'). "/danh-muc/{$cate->slug}",Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }

        // get quốc gia from db
        $country = Country::orderby('id','desc')->get();
        // add every post to the sitemap
        foreach($country as $coun)
        {
            $sitemap->add(env('APP_URL'). "/quoc-gia/{$coun->slug}",Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }

        // số năm

        // phim
        $movie = Movie::orderby('id','desc')->get();
        // add every post to the sitemap
        foreach($movie as $mov)
        {
            $sitemap->add(env('APP_URL'). "/phim/{$mov->slug}",Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }

        //xem phim
        $movie_ep = Movie::with('episode')->orderby('id','desc')->get();
        $episode = Episode::all();
        // add every post to the sitemap
        foreach($movie_ep as $mov_ep)
        {
            foreach($mov_ep->episode as $ep) {
                if($mov_ep->id==$ep->movie_id) {
            $sitemap->add(env('APP_URL'). "/xem-phim/{$mov_ep->slug}/tap-$ep->episode",Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
                }
            }
        }
        $years = range(Carbon::now('Asia/Ho_Chi_Minh')->year, 2000);
        foreach($years as $year)
            {
                $sitemap->add(env('APP_URL'). "/nam/{$year}",Carbon::now('Asia/Ho_Chi_Minh'), '0.6', 'daily');
            }
        $sitemap->store('xml', 'sitemap'); 
        if (File::exists(public_path() . '/sitemap.xml')) {
           File::copy(public_path('sitemap.xml'),base_path('sitemap.xml'));
    }
    }
}
