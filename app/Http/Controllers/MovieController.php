<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Episode;

use App\Models\Movie_Genre;
use App\Models\Country;
use Carbon\Carbon;
use Storage;
use File;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Movie::with('category','genre','country','movie_genre')->withCount('episode')->orderBy('id','desc')->get();
               // return response()->json($list);
        $category = Category::pluck('title','id');
        $country = Country::pluck('title','id');
        $path = 'C:/xampp/htdocs/webphim_tutorial/public/json/movies.json';
        if(is_dir($path)) {
            mkdir($path,0777,true);

        }
        File::put($path,json_encode($list));
        return view('admincp.movie.index',compact('list','category','country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $category = Category::pluck('title','id'); 
        $genre = Genre::pluck('title','id'); 
        $list_genre = Genre::all(); 
        $country = Country::pluck('title','id'); 
        return view('admincp.movie.form',compact('category','genre','country','list_genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->validate(
        //     [
        //     'title' => 'required|unique:movies|max:255',
        //     'slug' => 'required|unique:movies|max:255',
        //     'description' => 'required|max:255',
        //     'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',            
        //     'status' => 'required',
        //     ],
        //     [
        //         'title.unique' => 'Tên danh mục đã có, xin điền tên khác',
        //         'slug.unique' => 'Slug danh mục đã có, xin điền tên khác',
        //         'title.required' => 'Tên danh mục phải có nhé',
        //         'slug.required' => 'Tên slug phải có nhé',
        //         'description.required' => 'Mô tả danh mục phải có nhé',
        //     ]
        // );   
        $data = $request->all();
        $movie = new Movie();
        $movie->title =$data['title'];
        $movie->tags =$data['tags'];
        $movie->trailer =$data['trailer'];
        $movie->sotap =$data['sotap'];
        $movie->thuocphim =$data['thuocphim'];
        $movie->thoiluong =$data['thoiluong'];
        $movie->phim_hot =$data['phim_hot'];
        $movie->phude =$data['phude'];
        $movie->resolution =$data['resolution'];
        $movie->name_english =$data['name_english'];
        $movie->slug =$data['slug'];
        $movie->description =$data['description'];
        $movie->status =$data['status'];
        $movie->category_id =$data['category_id'];
        $movie->country_id =$data['country_id'];
        // $movie->genre_id =$data['genre_id'];
        
        foreach($data['genre'] as $key => $gen) {
            $movie->genre_id = $gen[0]; // Gán giá trị của phần tử đầu tiên trong mảng $gen
        }
        $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');

        // thêm hình ảnh
        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie/',$new_image);
            $movie->image = $new_image;
        }
        $movie->save();
        //thêm nhiều thể loại cho phim
        $movie->movie_genre()->attach($data['genre']);
        return redirect()->route('movie.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::pluck('title','id'); 
        $genre = Genre::pluck('title','id'); 
        $list_genre = Genre::all(); 
        $country = Country::pluck('title','id'); 
        $movie = Movie::find($id);
        $movie_genre = $movie->movie_genre;
        return view('admincp.movie.form',compact('category','genre','country','movie','list_genre','movie_genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function update_year_phim(Request $request) {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
}
public function update_season_phim(Request $request) {
    $data = $request->all();
    $movie = Movie::find($data['id_phim']);
    $movie->season = $data['season'];
    $movie->save();
}
public function update_topview_phim(Request $request) {
    $data = $request->all();
    $movie = Movie::find($data['id_phim']);
    $movie->topview = $data['topview'];
    $movie->save();
}
public function filter_topview_phim(Request $request) {
    $data = $request->all();
    $movie = Movie::where('topview',$data['value'])->orderby('ngaycapnhat','desc')->take(20)->get();
    $output = '';
    foreach($movie as $key => $mov) {
        if($mov->resolution==0) {
        $text = 'HD';
        }
      elseif($mov->resolution==1) {
      $text = 'SD';
      }
      elseif($mov->resolution==2) {
      $text = 'HDCam';
      }
      elseif($mov->resolution==3) {
      $text = 'Cam';
      }
      elseif($mov->resolution==4) {
        $text = 'FullHD';
        } else {
          $text = 'Trailer';
        }
    $output.='<div class="item">
                <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
                   <div class="item-link">
                      <img src="'.url('uploads/movie/'.$mov->image).'" class="lazy post-thumb" 
                      alt="'.$mov->title.'" title="'.$mov->title.'" />
                      <span class="is_trailer">'.$text.'</span>
                   </div>
                   <p class="title">'.$mov->title.'</p>
                </a>
                <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                <div class="viewsCount" style="color: #9d9d9d;">Năm '.$mov->year.'</div>

                <div style="float: left;">
                    <ul class="list-inline rating" title="Average Rating">';
                        for($count=1; $count<=5; $count++) {
                          $output.='<li title="star_rating" style="font-size:15px;color:#ffcc00;padding:0">&#9733;</li>';
                        }
                       $output.='<ul class="list-inline rating" title="Average Rating">              
                </div>
             </div>';
    }
 echo $output;
}
public function filter_topview_default(Request $request) {
    $data = $request->all();
    $movie = Movie::where('topview',0)->orderby('ngaycapnhat','desc')->take(20)->get();
    $output = '';
    foreach($movie as $key => $mov) {
        if($mov->resolution==0) {
        $text = 'HD';
        }
      elseif($mov->resolution==1) {
      $text = 'SD';
      }
      elseif($mov->resolution==2) {
      $text = 'HDCam';
      }
      elseif($mov->resolution==3) {
      $text = 'Cam';
      }
      elseif($mov->resolution==4) {
      $text = 'FullHD';
      } else {
        $text = 'Trailer';
      }
    $output.='<div class="item">
                <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
                   <div class="item-link">
                      <img src="'.url('uploads/movie/'.$mov->image).'" class="lazy post-thumb" 
                      alt="'.$mov->title.'" title="'.$mov->title.'" />
                      <span class="is_trailer">'.$text.'</span>
                   </div>
                   <p class="title">'.$mov->title.'</p>
                </a>
                <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                <div class="viewsCount" style="color: #9d9d9d;">Năm '.$mov->year.'</div>

                <div style="float: left;">
                   <ul class="list-inline rating" title="Average Rating">';
                   
                        for($count=1; $count<=5; $count++) {
                          $output.='<li title="star_rating" style="font-size:15px;color:#ffcc00;padding:0">&#9733;</li>';
                        }
                       $output.='<ul class="list-inline rating" title="Average Rating">              
                        </div>
                  </div>';
    }
 echo $output;
}
    public function update(Request $request, $id)
    {
        $data = $request->all();
        // return response()->json($data['genre']);
        $movie = Movie::find($id);
        $movie->title =$data['title'];
        $movie->tags =$data['tags'];
        $movie->trailer =$data['trailer'];
        $movie->sotap =$data['sotap'];
        $movie->thoiluong =$data['thoiluong'];
        $movie->phim_hot =$data['phim_hot'];
        $movie->resolution =$data['resolution'];
        $movie->name_english =$data['name_english'];
        $movie->phude =$data['phude'];
        $movie->thuocphim =$data['thuocphim'];
        $movie->slug =$data['slug'];
        $movie->description =$data['description'];
        $movie->status =$data['status'];
        $movie->category_id =$data['category_id'];
        $movie->country_id =$data['country_id'];
        // $movie->genre_id =$data['genre_id'];
        foreach ($data['genre'] as $key => $gen) {
            $movie->genre_id = $gen[0]; // Gán giá trị của phần tử đầu tiên trong mảng $gen
        }
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');

        // cập nhật hình ảnh
        $get_image = $request->file('image');
        if($get_image){
            if(file_exists('uploads/movie/'.$movie->image)) {
                unlink('uploads/movie/'.$movie->image);
            } else {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie/',$new_image);
            $movie->image = $new_image;
            }
}
        $movie->save();
        $movie->movie_genre()->sync($data['genre']);
        return redirect()->route('movie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $movie =  Movie::find($id);
        // xóa ảnh
        if(file_exists('uploads/movie/'.$movie->image)) {
            unlink('uploads/movie/'.$movie->image);
        }
        // xóa thể loại thuộc phim cần xóa
        Movie_Genre::whereIN('movie_id',[$movie->id])->delete();
        // xóa tập phim của phim
        Episode::whereIN('movie_id',[$movie->id])->delete();
        // xóa phim đó
        $movie->delete();
        return redirect()->back();
    }
    public function category_choose(Request $request) {
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->category_id =$data['category_id'];
        $movie->save();
}
public function country_choose(Request $request) {
    $data = $request->all();
    $movie = Movie::find($data['movie_id']);
    $movie->country_id =$data['country_id'];
    $movie->save();
}
public function thuocphim_choose(Request $request) {
    $data = $request->all();
    $movie = Movie::find($data['movie_id']);
    $movie->thuocphim =$data['thuocphim'];
    $movie->save();
}

}
