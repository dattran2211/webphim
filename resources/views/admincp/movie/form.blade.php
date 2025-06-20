@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <a href="{{route('movie.index')}}" class="btn btn-primary">Liệt kê phim</a>

                <div class="card-header">Quản lý phim</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!isset($movie))
                    {!! Form::open(['route' => 'movie.store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                    @else
                    {!! Form::open(['route' => ['movie.update',$movie->id],'method' => 'PUT','enctype'=>'multipart/form-data']) !!}
                    @endif

                    {!! Form::open(['route' => 'movie.store', 'method' => 'POST']) !!}
                    <div class="form-group">
                    {!! Form::label('title', 'Title', []) !!}
                    {!! Form::text('title', isset($movie) ? $movie->title : '', ['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('trailer', 'Trailer', []) !!}
                        {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', ['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu']) !!}
                        </div>

                    <div class="form-group">
                            {!! Form::label('sotap', 'Số tập', []) !!}
                            {!! Form::text('sotap', isset($movie) ? $movie->sotap : '', ['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('thoiluong', 'Thời lượng', []) !!}
                        {!! Form::text('thoiluong', isset($movie) ? $movie->thoiluong : '', ['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu']) !!}
                        </div>

                    <div class="form-group">
                        {!! Form::label('name_english', 'Title English', []) !!}
                        {!! Form::text('name_english', isset($movie) ? $movie->name_english : '', ['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu']) !!}
                        </div>

                    <div class="form-group">
                        {!! Form::label('slug', 'Slug', []) !!}
                        {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu','id'=>'convert_slug']) !!}
                        </div>

                    <div class="form-group">
                        {!! Form::label('tags', 'Tags phim', []) !!}
                        {!! Form::textarea('tags', isset($movie) ? $movie->tags : '', ['style'=>'resize:none','class'=>'form-control','placeholder'=>'Nhập vào dữ liệu']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Description', []) !!}
                        {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['style'=>'resize:none','class'=>'form-control','placeholder'=>'Nhập vào dữ liệu','id'=>'description']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('active', 'Active', []) !!}
                        {!! Form::select('status', ['1'=>'Hiển thị','0'=>'Không'], isset($movie) ? $movie->status : '', ['class'=>'form-control']) !!}                    
                    </div>
                    <div class="form-group">
                        {!! Form::label('resolution', 'Định dạng', []) !!}
                        {!! Form::select('resolution', ['1'=>'SD','0'=>'HD','2'=>'HDCam','3'=>'Cam','4'=>'FullHD','5'=>'Trailer'], isset($movie) ? $movie->resolution : '', ['class'=>'form-control']) !!}                    
                    </div>
                    <div class="form-group">
                        {!! Form::label('category', 'Danh mục', []) !!}
                        {!! Form::select('category_id', $category ,isset($movie) ? $movie->category_id : '', ['class'=>'form-control']) !!}                    
                    </div>

                    <div class="form-group">
                        {!! Form::label('thuocphim', 'Thuộc thể loại phim', []) !!}
                        {!! Form::select('thuocphim', ['phimle'=>'Phim lẻ','phimbo'=>'Phim bộ'],isset($movie) ? $movie->thuocphim : '', ['class'=>'form-control']) !!}                    
                    </div>

                    <div class="form-group">
                        {!! Form::label('country', 'Quốc Gia', []) !!}
                        {!! Form::select('country_id', $country, isset($movie) ? $movie->country_id : '', ['class'=>'form-control']) !!}                    
                    </div>

                    <div class="form-group">
                        {!! Form::label('genre', 'Thể loại', []) !!}<br>
                        {{-- {!! Form::select('genre_id', $genre, isset($movie) ? $movie->genre_id : '', ['class'=>'form-control']) !!}--}}
                        @foreach($list_genre as $key => $gen)
                        @if(isset($movie))
                        {!! Form::checkbox('genre[]',$gen->id, isset($movie_genre) && $movie_genre->contains($gen->id) ? true : false) !!}
                        @else
                        {!! Form::checkbox('genre[]',$gen->id,'') !!}
                        @endif
                        {!! Form::label('genre', $gen->title) !!}
                        @endforeach
                    </div>

                    <div class="form-group">
                        {!! Form::label('Hot', 'Phim Hot', []) !!}
                        {!! Form::select('phim_hot', ['1'=>'Có','0'=>'Không'],isset($movie) ? $movie->phim_hot : '', ['class'=>'form-control']) !!}                    
                    </div>

                    <div class="form-group">
                        {!! Form::label('phude', 'Phụ đề', []) !!}
                        {!! Form::select('phude', ['1'=>'Thuyết minh','0'=>'Phụ đề'],isset($movie) ? $movie->phude : '', ['class'=>'form-control']) !!}                    
                    </div>

                    <div class="form-group">
                        {!! Form::label('image', 'Image', []) !!}
                        {!! Form::file('image', ['class'=>'form-control-file']) !!}
                    </br>                    
                    @if(isset($movie))
                    <img width="20%" src="{{asset('uploads/movie/'.$movie->image)}}">
                    @endif
                    </div>

                    @if(!isset($movie))
                    {!! Form::submit('Thêm dữ liệu', ['class'=>'btn btn-success']) !!}
                    @else
                    {!! Form::submit('Cập nhật', ['class'=>'btn btn-success']) !!}
                     @endif
                    {!! Form::close() !!}
                </div>
            </div>
           
        </div>
    </div>
</div>
@endsection
