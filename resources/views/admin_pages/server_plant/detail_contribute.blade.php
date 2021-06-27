@extends('layouts.admin_layout')

@section('title', 'Chi tiết cây cảnh')

@section('content')
<div class="card">
    <h5 class="card-header">Chi tiết cây cảnh đóng góp</h5>
    @if(session()->has('saved'))
    <div class="alert alert-success">
        <strong>Đã update</strong>
    </div>
    @endif
    <div class="card-body">
        <form method="POST" action="/admin/server_plant/admin_update">
            @csrf
            <label>Hình ảnh: </label>
            <img class="mb-5" width="300" height="300" src="{{ $plant->image_url }}" alt="" title="" />
            <div class="form-group ">
                <!--ID -->
                <input hidden type="text"
                       name="id" value="{{ $plant->id }}" autocomplete="name" autofocus>
                <!-- Tên thường gọi -->
                <label class="required">Tên thường gọi</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text"
                       placeholder="Tên thường gọi" name="common_name"
                       value="{{ old('name', $plant->common_name) }}" autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!-- Tên khoa học -->
                <label class="required">Tên khoa học</label>
                <input class="form-control @error('scientific_name') is-invalid @enderror" type="text"
                       placeholder="Tên thường gọi" name="scientific_name"
                       value="{{ old('scientific_name', $plant->scientific_name) }}" autocomplete="scientific_name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!-- Thông tin -->
                <label class="required">Thông tin</label>
                <textarea class="form-control @error('information') is-invalid @enderror" type="text"
                          placeholder="Thông tin" name="information"
                          autocomplete="information" autofocus cols="40" rows="5">{{ old('information', $plant->information)}}</textarea>

                @error('information')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <a class="btn btn-danger ml-2" href="/admin/server_plant/list_plant" role="button">Quay lại</a>

            <a class="btn btn-info ml-2" href="/admin/server_plant/accept_contribute/{{$plant->id}}" role="button">Thêm vào DB chính thức</a>

            <button type="submit" class="btn btn-primary">Lưu</button>

        </form>
    </div>
    @endsection

