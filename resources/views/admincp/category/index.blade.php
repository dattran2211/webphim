@extends('layouts.app')
@section('content')
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>                    
        <th scope="col">Slug</th>                    

        <th scope="col">Description</th>
        <th scope="col">Active/Inactive</th>

        <th scope="col">Manager</th>
      </tr>
    </thead>
    <tbody class="order_position">
        @foreach($list as $key =>$cate)
      <tr id="{{$cate->id}}">
        <th scope="row">{{$cate->id}}</th>
        <td>{{$cate->title}}</td>
        <td>{{$cate->slug}}</td>
        <td>{{$cate->description}}</td>
        <td>
            @if($cate->status)
              Hiển thị
            @else
              Không
            @endif
        </td>
        <td>
            {!! Form::open(['method'=>'DELETE','route'=>['category.destroy',$cate->id],'onsubmit'=>'return confirm("Xóa?")']) !!}
            {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}

            {!! Form::close() !!}
            <a href="{{route('category.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
        </td>
      </tr>
      @endforeach
      </tbody>
  </table>
@endsection
