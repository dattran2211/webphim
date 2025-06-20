<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Movie_Genre;
use App\Models\LinkMovie;
use Carbon\Carbon;
 
class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $list_episode = Episode::with('movie')->orderby('movie_id','desc')->get();
        // return response()->json($list_episode);
        return view('admincp.episode.index', compact('list_episode'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_movie = Movie::orderby('id','desc')->pluck('title','id');
        $linkmovie = LinkMovie::orderBy('id','desc')->pluck('title','id');
        return view('admincp.episode.form', compact('list_movie','linkmovie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // $episode_check = Episode::where('episode',$data['episode'])
        // ->where('movie_id',$data['movie_id'])->count();
        // dd($episode_check)
        // if($episode_check>0) {
              
        // } else {
        $ep = new Episode();
        $ep->movie_id =$data['movie_id'];
        $ep->linkphim =$data['link'];
        $ep->linkserver =$data['linkmovie'];

        $ep->episode =$data['episode'];
        $ep->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->save();
        //}
        return redirect()->to('episode');
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
        $list_movie = Movie::orderby('id','desc')->pluck('title','id');
        $linkmovie = LinkMovie::orderBy('id','desc')->pluck('title','id');
        $episode = Episode::find($id);
        return view('admincp.episode.form', compact('list_movie','episode','linkmovie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $ep = Episode::find($id);
        $ep->movie_id =$data['movie_id'];
        $ep->linkphim =$data['link'];
        $ep->linkserver =$data['linkmovie'];
        // $ep->episode =$data['episode'];
        $ep->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        $ep->save();
        return redirect()->to('episode');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $episode = Episode::find($id)->delete();
        return redirect()->to('episode');
    }
    public function select_movie() {
        $id = $_GET['id'];
        $movie = Movie::find($id);
        $output = '<option>--Chọn tập phim--</option>';
        if($movie->thuocphim=='phimbo') {
        // echo $movie->sotap;
        for($i=1;$i<=$movie->sotap;$i++) {
            $output.='<option value="'.$i.'">'.$i.'</option>';
        }
        } else {
            $output.='<option value=""HD>HD</option>
            <option value="FullHD">FullHD</option>
            <option value="Cam">Cam</option>
            <option value="HDCam">HDCam</option>';
}
        echo $output;
    }
}
