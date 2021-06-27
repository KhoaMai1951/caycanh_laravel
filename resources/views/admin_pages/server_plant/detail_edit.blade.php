@extends('layouts.admin_layout')

@section('title', 'Chi tiết cây cảnh')

@section('content')
    <div class="card">
        <h5 class="card-header">Chi tiết cây cảnh chỉnh sửa của người dùng</h5>
        @if(session()->has('saved'))
            <div class="alert alert-success">
                <strong>Đã update</strong>
            </div>
        @endif
        <div class="row">
        <div class="col-lg-12">
            <label>Hình ảnh: </label>
            <img class="mb-5" width="300" height="300" src="{{ $server_plant->image_url }}" alt="" title="" />
        </div>
        </div>
        <div class="row">

            <div class="col-6">
                <h1>Chỉnh sửa của người dùng</h1>
                <form method="POST" action="/admin/server_plant/has_viewed">
                    @csrf
                    <div class="form-group ">
                        <!--ID -->
                        <input hidden type="text"
                               name="server_plant_user_edit_id" value="{{ $user_edit_plant->id }}" autocomplete="name" autofocus>
                        <input hidden type="text"
                               name="server_plant_id" value="{{ $user_edit_plant->server_plant_id }}" autocomplete="name" autofocus>
                        <input hidden type="text"
                               name="user_id" value="{{ $user_edit_plant->user_id }}" autocomplete="name" autofocus>
                        <!-- Tên thường gọi -->
                        <label class="required">Tên thường gọi</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                               placeholder="Tên thường gọi" name="common_name"
                               value="{{ old('name', $user_edit_plant->common_name) }}" autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    <!-- Tên khoa học -->
                        <label class="required">Tên khoa học</label>
                        <input class="form-control @error('scientific_name') is-invalid @enderror" type="text"
                               placeholder="Tên thường gọi" name="scientific_name"
                               value="{{ old('scientific_name', $user_edit_plant->scientific_name) }}" autocomplete="scientific_name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    <!-- Thông tin -->
                        <label class="required">Thông tin</label>
                        <textarea class="form-control @error('information') is-invalid @enderror" type="text"
                                  placeholder="Thông tin" name="information"
                                  autocomplete="information" autofocus cols="40" rows="10">{{ old('information', $user_edit_plant->information)}}</textarea>

                        @error('information')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

{{--                    <a class="btn btn-info ml-2" href="/admin/server_plant/accept_contribute/{{$plant->id}}" role="button">Thêm vào DB chính thức</a>--}}

                    <button type="submit" class="btn btn-primary">Duyệt xong</button>

                </form>
            </div>
            <div class="col-6">
                <h1>Dữ liệu hiện tại</h1>
                <form method="POST" action="/admin/server_plant/admin_update_for_user_edit">
                    @csrf
                    <div class="form-group ">
                        <!--ID -->
                        <input hidden type="text"
                               name="server_plant_user_edit_id" value="{{ $user_edit_plant->id }}" autocomplete="name" autofocus>
                        <input hidden type="text"
                               name="server_plant_id" value="{{ $server_plant->id }}" autocomplete="name" autofocus>
                        <input hidden type="text"
                               name="id" value="{{ $server_plant->id }}" autocomplete="name" autofocus>
                        <!-- Tên thường gọi -->
                        <label class="required">Tên thường gọi</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                               placeholder="Tên thường gọi" name="common_name"
                               value="{{ old('name', $server_plant->common_name) }}" autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    <!-- Tên khoa học -->
                        <label class="required">Tên khoa học</label>
                        <input class="form-control @error('scientific_name') is-invalid @enderror" type="text"
                               placeholder="Tên thường gọi" name="scientific_name"
                               value="{{ old('scientific_name', $server_plant->scientific_name) }}" autocomplete="scientific_name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    <!-- Thông tin -->
                        <label class="required">Thông tin</label>
                        <textarea class="form-control @error('information') is-invalid @enderror" type="text"
                                  placeholder="Thông tin" name="information"
                                  autocomplete="information" autofocus cols="40" rows="10">{{ old('information', $server_plant->information)}}</textarea>

                        @error('information')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

{{--                    <a class="btn btn-danger ml-2" href="/admin/server_plant/list_plant" role="button">Quay lại</a>--}}

{{--                    <a class="btn btn-info ml-2" href="/admin/server_plant/accept_contribute/{{$plant->id}}" role="button">Thêm vào DB chính thức</a>--}}

                    <button type="submit" class="btn btn-primary">Lưu </button>

                </form>
            </div>
        </div>
    </div>
@endsection

