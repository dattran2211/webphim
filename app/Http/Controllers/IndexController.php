<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\LinkMovie;
use App\Models\Info;
use DB;

class IndexController extends Controller
{
    public function locphim()
    {
        $sapxep = $_GET['order'];
        $genre_get = $_GET['genre'];
        $country_get = $_GET['country'];
        $year_get = $_GET['year'];

    if ($sapxep=='' && $genre_get=='' && $country_get=='' && $year_get=='') {
            return redirect()->back();
        } else {
            $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
            $phimhot_sidebar = Movie::withCount('episode')->where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('30')->get();
            $genre = Genre::orderBy('id', 'desc')->get();
            $country = Country::orderBy('id', 'desc')->get();
            $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('10')->get();
            // lấy dữ liệu
            $movie = Movie::withCount('episode');
            if($genre_get) {
                $movie = Movie::withCount('episode')->whereHas('genres', function($query) use ($genre_get) {
                    $query->where('genre_id', '=', $genre_get);
                });
            }
            if($country_get) {
                $movie->where('country_id','=',$country_get);
            }
            if($year_get) {
                $movie->where('year','=',$year_get);
            }
            if($sapxep) {
                $movie->orderBy('title', 'ASC');
            }
            if($year_get && $country_get) {
                $movie->where('year','=',$year_get)->where('country_id','=',$country_get);
            }
            if($year_get && $genre_get) {
                $movie->where('year','=',$year_get)->where('genre_id','=',$genre_get);
            } 
            if($genre_get && $country_get) {
                $movie->where('genre_id','=',$genre_get)->where('country_id','=',$country_get);
            }
            if($genre_get && $country_get && $year_get) {
                $movie->where('genre_id','=',$genre_get)->where('country_id','=',$country_get)->where('year','=',$year_get);
            }else{
                $movie = $movie->orderBy('ngaycapnhat', 'DESC');
            }
            $movie = $movie->orderBy('ngaycapnhat', 'DESC')->paginate(40);
            //  dd($movie);
            return view('pages.locphim', compact('category', 'genre', 'country', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
        }
    }

    public function timkiem()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
            $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('20')->get();
            $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('10')->get();
            $genre = Genre::orderBy('id', 'desc')->get();
            $country = Country::orderBy('id', 'desc')->get();
            $movie = Movie::withCount('episode')->where('title', 'LIKE', '%' . $search . '%')->orderby('ngaycapnhat', 'desc')->paginate(40);
            return view('pages.timkiem', compact('category', 'genre', 'country', 'search', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
        } else {
            return redirect()->to('/');
        }
    }

    public function home()
    {   
        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info->description;
        $meta_image = '';
        $phimhot = Movie::withCount('episode')->where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'desc')->get();
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('10')->get();
        $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $category_home = Category::with(['movie' => function ($q) {
            $q->withCount('episode');
        }])
            ->orderBy('id', 'desc')->where('status', 1)->get();
        return view('pages.home', compact('meta_description','meta_title','category', 'genre', 'country', 'category_home', 'phimhot', 'phimhot_sidebar', 'phimhot_trailer','info','meta_image'));
    }
    public function phimbo()
    {
        $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $phimhot_sidebar = Movie::withCount('episode')->where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('10')->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $phimbo = Movie::where('thuocphim', 'phimbo')->first();
        $movie = Movie::withCount('episode')->where('category_id', $cate_slug->id)->orderby('ngaycapnhat', 'desc')->paginate(40);
        return view('pages.phimbo', compact('category', 'genre', 'country', 'phimbo', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function category($slug)
    {       
        $meta_image = '';
        $info = Info::find(1);
        $cate_slug = Category::where('slug', $slug)->first();
        $meta_title = $cate_slug->title;
        $meta_description = $cate_slug->description;
        $category = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $phimhot_sidebar = Movie::withCount('episode')->where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('10')->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $movie = Movie::withCount('episode')->where('category_id', $cate_slug->id)->orderby('ngaycapnhat', 'desc')->paginate(40);
        return view('pages.category', compact('info','meta_description','meta_title','category', 'genre', 'country', 'cate_slug', 'movie', 'phimhot_sidebar', 'phimhot_trailer','meta_image'));
    }
    public function genre($slug)
    {
        $meta_image = '';
        $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
        $phimhot_sidebar = Movie::withCount('episode')->where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('10')->get();

        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $genre_slug = Genre::where('slug', $slug)->first();
        $info = Info::find(1);
        $meta_title = $genre_slug->title;
        $meta_description = $genre_slug->description;
        // nhiều thể loại
        $movie_genre = Movie_Genre::where('genre_id', $genre_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $movi) {
            $many_genre[] = $movi->movie_id;
        }
        // return response()->json($many_genre);
        $movie = Movie::withCount('episode')->whereIN('id', $many_genre)->orderby('ngaycapnhat', 'desc')->paginate(40);
        return view('pages.genre', compact('meta_description','meta_title','info','category', 'genre', 'country', 'genre_slug', 'movie', 'phimhot_sidebar', 'phimhot_trailer','meta_image'));
    }
    public function country($slug)
    {
        $meta_image = '';

        $category = Category::orderBy('id', 'desc')->get();
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('10')->get();

        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $country_slug = Country::where('slug', $slug)->first();
        $info = Info::find(1);
        $meta_title = $country_slug->title;
        $meta_description = $country_slug->description;
        $movie = Movie::withCount('episode')->where('country_id', $country_slug->id)->orderby('ngaycapnhat', 'desc')->paginate(40);
        return view('pages.country', compact('meta_description','meta_title','info','category', 'genre', 'country', 'country_slug', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function year($year)
    {
        $meta_image = '';
        $info = Info::find(1);
        $meta_title = 'Năm phim: '.$year;
        $meta_description = 'Tìm phim năm '.$year;
        $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('10')->get();

        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $year = $year;
        $movie = Movie::withCount('episode')->where('year', $year)->orderby('ngaycapnhat', 'desc')->paginate(40);
        return view('pages.year', compact('meta_description','meta_title','info','category', 'genre', 'country', 'year', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function tag($tag)
    {
        $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('10')->get();

        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        // dd($tag);
        $tag = $tag;
        $movie = Movie::withCount('episode')->where('tags', 'like', '%' . $tag . '%')->orderby('ngaycapnhat', 'desc')->paginate(40);
        return view('pages.tag', compact('category', 'genre', 'country', 'tag', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function movie($slug)
    {
        $category = Category::orderBy('id', 'desc')->get();
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('10')->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre')->where('slug', $slug)->where('status', 1)->first();
        // meta seo cho movie
        $info = Info::find(1);
        $meta_title = $movie->title;
        $meta_description = $movie->description;
        $meta_image = url('uploads/movie/'.$movie->image);
        $related = Movie::withCount('episode')->with('category', 'genre', 'country')->where('category_id', $movie->category->id)->orderby(DB::raw('RAND()'))
            ->whereNotIn('slug', [$slug])->get();
        // lấy tập đầu tiên của mỗi phim : $movie->id
        $episode_tapdau = Episode::with('movie')->where('movie_id', $movie->id)->orderby('episode', 'asc')->take(1)->first();
        // lấy 3 tập mới nhất của mỗi phim : $movie->id
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderby('episode', 'desc')->take(3)->get();
        // lấy tổng tập phim đã thêm
        $episode_current_list = Episode::with('movie')->where('movie_id', $movie->id)->get();
        $episode_current_list_count = $episode_current_list->count();

        //rating movie
        $rating= Rating::where('movie_id',$movie->id)->avg('rating');
        $rating = round($rating);
        $count_total= Rating::where('movie_id',$movie->id)->count();
        // dd($episode_current_list_count);
        return view('pages.movie', compact('meta_description','meta_title','info','category', 'genre', 'country', 'movie', 'related', 'phimhot_sidebar', 'phimhot_trailer', 'episode', 'episode_tapdau', 'episode_current_list_count','rating','count_total','meta_image'));
    }
    public function watch($slug, $tap)
    {
         $movie = Movie::with('category', 'genre', 'country', 'movie_genre', 'episode')->where('slug', $slug)->where('status', 1)->first();
         // meta seo cho movie
         $info = Info::find(1);
         $meta_title = 'Xem Phim: '.$movie->title;
         $meta_description = $movie->description;
         $meta_image = url('uploads/movie/'.$movie->image);

         // lấy dữ liệu cho toàn views
        $category = Category::orderBy('id', 'desc')->get();
        $phimhot_sidebar = Movie::where('phim_hot', 1)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution', 5)->where('status', 1)->orderby('ngaycapnhat', 'desc')->take('10')->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        // phim liên quan
        $related = Movie::withCount('episode')->with('category', 'genre', 'country')->where('category_id', $movie->category->id)->orderby(DB::raw('RAND()'))
            ->whereNotIn('slug', [$slug])->get();
        // lấy tập 1 và tập full hd cho phim lẻ
        if (isset($tap)) {
            $tapphim = $tap;
            $tapphim = substr($tap, 4, 20);
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        } else {
            $tapphim = 1;
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        }
        $server = LinkMovie::orderby('id','desc')->get();
        $episode_movie = Episode::where('movie_id',$movie->id)->get()->unique('linkserver');

        return view('pages.watch', compact('meta_description','meta_title','info','category', 'genre', 'country', 'movie', 'related', 'phimhot_sidebar', 'phimhot_trailer', 'episode', 'tapphim','meta_title','meta_image','server','episode_movie'));
    }
    public function esipode()
    {
        return view('pages.esipode');
    }
    public function logout()
    {
        return view('pages.esipode');
    }
    public function add_rating(Request $request) {
        $data = $request->all();
        $ip_address = $request->ip();
        $rating_count = Rating::where('movie_id', $data['movie_id'])
                              ->where('ip_address', $ip_address)
                              ->count();
        if ($rating_count > 0) {
            echo 'exist';
        } else {
            $rating = new Rating();
            $rating->movie_id = $data['movie_id'];
            $rating->rating = $data['index'];
            $rating->ip_address = $ip_address;
            $rating->save();
        echo 'done';
        }
    }

}
