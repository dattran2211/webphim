@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý tài khoản</div>

                {{-- Hiển thị lỗi nếu có --}}
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
                    {{-- Thông báo thành công --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Gửi dữ liệu luôn sang account.update --}}
                    {!! Form::open(['route' => ['account.update', $category->id], 'method' => 'PUT']) !!}

                    {{-- Trường nhập tên --}}
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', $category->name ?? '', ['class'=>'form-control', 'placeholder'=>'Nhập tên']) !!}
                    </div>

                    {{-- Trường nhập email --}}
                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::text('email', $category->email ?? '', ['class'=>'form-control', 'placeholder'=>'Nhập email']) !!}
                    </div>

                    {{-- Trạng thái hoạt động --}}
                    <div class="form-group">
                        {!! Form::label('active', 'Active') !!}
                        {!! Form::select('status', ['1'=>'Hiển thị', '0'=>'Không'], $category->status ?? '', ['class'=>'form-control']) !!}
                    </div>

                    {{-- Nút gửi --}}
                    <div class="form-group">
                        {!! Form::submit('Cập nhật', ['class'=>'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
