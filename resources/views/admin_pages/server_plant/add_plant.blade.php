@extends('layouts.admin_layout')

@section('title', 'Chi tiết cây cảnh')

@section('content')
    <div class="card">
        <h5 class="card-header">Thêm mới cây cảnh</h5>
        @if(session()->has('saved'))
            <div class="alert alert-success">
                <strong>Đã thêm</strong>
            </div>
        @endif
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
            @csrf
                <!-- TÊN KHOA HỌC -->
                <div class="form-group">
                    <label class="required">Tên khoa học</label>
                    <input class="form-control @error('scientific_name') is-invalid @enderror" type="text"
                           placeholder="Nhập tên khoa học"
                           name="scientific_name"
                           value="{{ old('scientific_name') }}"
                           autocomplete="name" autofocus>
                    @error('scientific_name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- TÊN THƯỜNG GỌI -->
                <div class="form-group">
                    <label class="required">Tên thường gọi</label>
                    <input class="form-control @error('common_name') is-invalid @enderror" type="text"
                           placeholder="Nhập tên thường gọi"
                           name="common_name"
                           value="{{ old('common_name') }}"
                           autocomplete="name" autofocus>
                    @error('common_name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- UPLOAD IMAGE -->
                <div class="form-group">
                    <input type="file" name="image" class="form-control">
                </div>
                <!-- BUTTONS -->
                <a class="btn btn-danger ml-2" href="/admin/server_plant/list_plant" role="button">Quay lại</a>
                <button type="submit" class="btn btn-primary">Lưu</button>

            </form>
        </div>
@endsection

