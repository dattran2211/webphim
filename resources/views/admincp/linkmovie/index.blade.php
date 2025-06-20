@extends('layouts.app')
@section('content')
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Tên link</th>                    
        <th scope="col">Mô tả</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody class="order_position">
        @foreach($list as $key =>$linkmovie)
      <tr id="{{$linkmovie->id}}">
        <th scope="row">{{$linkmovie->id}}</th>
        <td>{{$linkmovie->title}}</td>
        <td>{{$linkmovie->description}}</td>
        <td>
            @if($linkmovie->status)
              Hiển thị
            @else
              Không
            @endif
        </td>
        <td>
            {!! Form::open(['method'=>'DELETE','route'=>['linkmovie.destroy',$linkmovie->id],'onsubmit'=>'return confirm("Xóa?")']) !!}
            {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}

            {!! Form::close() !!}
            <a href="{{route('linkmovie.edit',$linkmovie->id)}}" class="btn btn-warning">Sửa</a>
        </td>
      </tr>
      @endforeach
      </tbody>
  </table>
@endsection
