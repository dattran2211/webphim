@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý danh mục</div>

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

                    @if(!isset($account))
                    {!! Form::open(['route' => 'account.store', 'method' => 'POST']) !!}
                    @else
                    {!! Form::open(['route' => ['account.update',$account->id],'method' => 'PUT']) !!}
                    @endif

                    {!! Form::open(['route' => 'account.store', 'method' => 'POST']) !!}
                    <div class="form-group">
                    {!! Form::label('title', 'Title', []) !!}
                    {!! Form::text('title', isset($category) ? $category->title : '', ['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('slug', 'Slug', []) !!}
                        {!! Form::text('slug', isset($category) ? $category->slug : '', ['class'=>'form-control','placeholder'=>'Nhập vào dữ liệu','id'=>'convert_slug']) !!}
                        </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Description', []) !!}
                        {!! Form::textarea('description', isset($category) ? $category->description : '', ['style'=>'resize:none','class'=>'form-control','placeholder'=>'Nhập vào dữ liệu','id'=>'title']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('active', 'Active', []) !!}
                        {!! Form::select('status', ['1'=>'Hiển thị','0'=>'Không'], isset($category) ? $category->status : '', ['class'=>'form-control']) !!}                    
                    </div>
                    @if(!isset($category))
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
