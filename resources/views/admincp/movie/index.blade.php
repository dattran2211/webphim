@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{ route('movie.create') }}" class="btn btn-primary">Thêm phim</a>

                <!-- Bọc bảng trong một div để có thể cuộn -->
                <div class="table-responsive">
                    <table class="table" id="tablephim">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Title English</th>
                                <th scope="col">Số tập đã thêm</th>
                                <th scope="col">Số tập</th>
                                <th scope="col">Từ khóa</th>
                                <th scope="col">Thời lượng</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Image</th>
                                <th scope="col">Resolution</th>
                                <th scope="col">Phụ đề</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Ngày cập nhật</th>
                                <th scope="col">Năm phim</th>
                                <th scope="col">Top views</th>
                                <th scope="col">Season</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Quốc Gia</th>
                                <th scope="col">Phim Hot</th>
                                <th scope="col">Thể loại</th>
                                <th scope="col">Thuộc phim</th>
                                <th scope="col">Manager</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $key => $cate)
                                <tr>
                                    <th scope="row">{{ $cate->id }}</th>
                                    <td>{{ $cate->title }}</td>
                                    <td>{{ $cate->name_english }}</td>
                                    <td>{{ $cate->episode_count }}</td>
                                    <td>{{ $cate->sotap }}</td>
                                    <td>{{ $cate->tags }}</td>
                                    <td>{{ $cate->thoiluong }}</td>
                                    <td>{{ $cate->slug }}</td>
                                    <td><img width="60%" height="100px" src="{{ asset('uploads/movie/' . $cate->image) }}"></td>
                                    <td>
                                        @if ($cate->resolution == 0)
                                            HD
                                        @elseif($cate->resolution == 1)
                                            SD
                                        @elseif($cate->resolution == 2)
                                            HDCam
                                        @elseif($cate->resolution == 3)
                                            Cam
                                        @elseif($cate->resolution == 4)
                                            FullHD
                                        @else
                                            Trailer
                                        @endif
                                    </td>
                                    <td>
                                        @if ($cate->resolution != 5)
                                            @if ($cate->phude == 0)
                                                Phụ đề
                                            @else
                                                Thuyết minh
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $cate->ngaytao }}</td>
                                    <td>{{ $cate->ngaycapnhat }}</td>
                                    <td>
                                        {!! Form::selectYear('year', 2000, 2025, isset($cate->year) ? $cate->year : '', [
                                            'class' => 'select-year',
                                            'id' => $cate->id,
                                        ]) !!}
                                    </td>
                                    <td>
                                        {!! Form::select(
                                            'topview',
                                            ['0' => 'Ngày', '1' => 'Tuần', '2' => 'Tháng'],
                                            isset($cate->topview) ? $cate->topview : '',
                                            ['class' => 'select-topview', 'id' => $cate->id],
                                        ) !!}
                                    </td>

                                    <td>
                                        <form method="POST">
                                            @csrf
                                            {!! Form::selectRange('season', 0, 20, isset($cate->season) ? $cate->season : '', [
                                                'class' => 'select-season',
                                                'id' => $cate->id,
                                            ]) !!}
                                        </form>
                                    </td>

                                    <td>{{ $cate->description }}</td>
                                    <td>
                                        @if ($cate->status)
                                            Hiển thị
                                        @else
                                            Không
                                        @endif
                                    </td>
                                    <td>
                                        {!! Form::select('category_id', $category, isset($cate) ? $cate->category_id : '', [
                                            'class' => 'form-control category_choose',
                                            'id' => $cate->id,
                                        ]) !!}
                                    </td>
                                    <td>
                                        {!! Form::select('country_id', $country, isset($cate) ? $cate->country_id : '', [
                                            'class' => 'form-control country_choose',
                                            'id' => $cate->id,
                                        ]) !!}
                                    </td>
                                    <td>
                                        @if ($cate->phim_hot == 1)
                                            Có
                                        @else
                                            Không
                                        @endif
                                    </td>

                                    <td>
                                        @foreach ($cate->movie_genre as $gen)
                                            <span class="badge badge-dark">{{ $gen->title }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        {!! Form::select(
                                            'thuocphim',
                                            ['phimle' => 'Phim lẻ', 'phimbo' => 'Phim bộ'],
                                            isset($cate) ? $cate->thuocphim : '',
                                            ['class' => 'form-control thuocphim_choose', 'id' => $cate->id],
                                        ) !!}
                                    </td>

                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['movie.destroy', $cate->id],
                                            'onsubmit' => 'return confirm("Xóa?")',
                                        ]) !!}
                                        {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}

                                        {!! Form::close() !!}
                                        <a href="{{ route('movie.edit', $cate->id) }}" class="btn btn-warning">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
