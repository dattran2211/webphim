@extends('layouts.app')
@section('content')
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>                    
        <th scope="col">Email</th>                    
        <th scope="col">Ngày tạo</th>
        <th scope="col">Ngày sửa</th>
        <th scope="col">Trạng thái</th>

      </tr>
    </thead>
    <tbody>
        @foreach($list as $key =>$cate)
      <tr id="{{$cate->id}}">
        <th scope="row">{{$cate->id}}</th>
        <td>{{$cate->name}}</td>
        <td>{{$cate->email}}</td>
        <td>{{$cate->created_at}}</td>
        <td>{{$cate->updated_at}}</td>

        <td>
            @if($cate->status==1)
              Hiển thị
            @else
              Không
            @endif
        </td>
        <td>
            {!! Form::open(['method'=>'DELETE','route'=>['account.destroy',$cate->id],'onsubmit'=>'return confirm("Xóa?")']) !!}
            {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}

            {!! Form::close() !!}
            <a href="{{route('account.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
        </td>
      </tr>
      @endforeach
      </tbody>
  </table>
@endsection
