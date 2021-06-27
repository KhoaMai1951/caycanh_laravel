@extends('layouts.admin_layout')

@section('title', 'Danh sách dữ liệu cây cảnh')

@section('content')
    <!-- TITLE -->
    <div class="alert alert-primary" role="alert">
        <h1>Danh sách chỉnh sửa cây cảnh của ng dùng</h1>
    </div>

    @if(session()->has('deleted'))
        <div class="alert alert-success">
            <strong>Đã xóa</strong>
        </div>
    @endif

    @if(count($list) == 0)
        <div class="alert alert-warning">
            Không có dữ liệu
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped bg-light">
                <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên thường gọi</th>
                    <th scope="col">Tên khoa học</th>
                    <th scope="col">Email người dùng</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $i => $plant)
                    <tr>
                        <th>{{$i+1}}</th>
                        <td>{{$plant->common_name}}</td>
                        <td>{{$plant->scientific_name}}</td>
                        <td>{{$plant->email}}</td>
                        <td><img width="100" height="100" src="{{ $plant->image_url }}" alt="" title="" />
                        </td>
                        <td>
                            <a class="btn btn-primary" href="/admin/server_plant/detail_edit?server_plant_user_edit_id={{$plant->server_plant_user_edit_id}}&server_plant_id={{$plant->server_plant_id}}"
                               role="button">Chi tiết</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection

