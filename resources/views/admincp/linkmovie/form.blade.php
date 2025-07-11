@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý link movie</div>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                         @foreach($errors->all() as $error)
                         <li>{{ $error }}</li>
                         @endforeach
                    </ul>
                </div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!isset($linkmovie))
                    {!! Form::open(['route' => 'linkmovie.store', 'method' => 'POST']) !!}
                    @else
                    {!! Form::open(['route' => ['linkmovie.update',$linkmovie->id],'method' => 'PUT']) !!}
                    @endif

                    {!! Form::open(['route' => 'linkmovie.store', 'method' => 'POST']) !!}
                    <div class="form-group">
                    {!! Form::label('title', 'Tên Link', []) !!}
                    {!! Form::text('title', isset($linkmovie) ? $linkmovie->title : '', ['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu']) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::label('description', 'Mô tả link', []) !!}
                        {!! Form::textarea('description', isset($linkmovie) ? $linkmovie->description : '', ['style'=>'resize:none','class'=>'form-control','placeholder'=>'Nhập vào dữ liệu','id'=>'title']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('active', 'Status', []) !!}
                        {!! Form::select('status', ['1'=>'Hiển thị','0'=>'Không'], isset($linkmovie) ? $linkmovie->status : '', ['class'=>'form-control']) !!}                    
                    </div>
                    @if(!isset($linkmovie))
                    {!! Form::submit('Thêm link', ['class'=>'btn btn-success']) !!}
                    @else
                    {!! Form::submit('Cập nhật link', ['class'=>'btn btn-success']) !!}
                     @endif
                    {!! Form::close() !!}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
