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
                <div class="form-group bg-light">
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
                <div class="form-group bg-light">
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
                <!-- THÂN THIỆN THÚ NUÔI -->
                <div class="form-group bg-light">
                    <label class="required">Thân thiện thú nuôi</label><br>
                    <select name="pet_friendly">
                        <option value="1">Có</option>
                        <option value="0">Không</option>
                    </select>
                </div>
                <!-- ĐỘ KHÓ -->
                <div class="form-group bg-light">
                    <label class="required">Độ khó (1-5)   </label><br>
                    <input value=1 type="number" name="quantity" min="1" max="5">
                </div>
                <!-- MỨC TƯỚI -->
                <div class="form-group bg-light">
                    <label class="required">Mức độ tưới nước (1-5)   </label>
                    <input value=1 type="number" name="water_level" min="1" max="5">
                </div>
                <!-- MỨC SÁNG -->
                <div class="form-group bg-light">
                    <label class="required">Mức độ ánh sáng mặt trời (1-5)   </label>
                    <input value=1 type="number" name="sunlight" min="1" max="5">
                </div>
                <!-- NHIỆT ĐỘ -->
                <div class="form-group bg-light @error('min_temperature') is-invalid @enderror ">
                    <label class="required">Nhiệt độ</label><br>
                    Nhỏ nhất: <input value="{{ old('min_temperature') ?? old('min_temperature') ?? 15}}"   type="number" name="min_temperature" min="1" max="100">
                    Lớn nhất: <input value="{{ old('max_temperature') ?? old('max_temperature') ?? 40}}"   type="number" name="max_temperature" min="1" max="100">
                    @error('min_temperature')
                    <strong >Nhiệt độ nhỏ nhất phải nhỏ hơn nhiệt độ lớn nhất</strong>
                    @enderror
                </div>
                <!-- ĐỘ PH -->
                <div class="form-group bg-light @error('scientific_name') is-invalid @enderror ">
                    <label class="required">Độ PH</label><br>
                    Nhỏ nhất: <input value="{{ old('min_ph') ?? old('min_ph') ?? 2}}"   type="number" name="min_ph" min="1" max="10">
                    Lớn nhất: <input value="{{ old('max_ph') ?? old('max_ph') ?? 6}}"   type="number" name="max_ph" min="1" max="10">
                    @error('min_ph')
                    <strong >Độ PH nhỏ nhất phải nhỏ hơn độ PH lớn nhất</strong>
                    @enderror
                </div>
                <!-- THÔNG TIN -->
                <div class="form-group bg-light">
                    <label>Thông tin cây cảnh </label><br>
                    <textarea  class="form-control @error('information') is-invalid @enderror" type="text"
                           placeholder="Nhập thông tin (tối đa 3000 kí tự)"
                           name="information"
                           value="{{ old('information') }}" rows="7" cols="50"
                           autocomplete="name" autofocus></textarea>
                </div>
                <!-- THÔNG TIN BÓN PHÂN -->
                <div class="form-group">
                    <label>Thông tin bón phân </label><br>
                    <textarea  class="form-control @error('information') is-invalid @enderror" type="text"
                               placeholder="Nhập thông tin (tối đa 3000 kí tự)"
                               name="feed_information"
                               value="{{ old('feed_information') }}" rows="7" cols="50"
                               autocomplete="name" autofocus></textarea>
                </div>
                <!-- VẤN ĐỀ THƯỜNG GẶP -->
                <div class="form-group">
                    <label>Vấn đề thường gặp </label><br>
                    <textarea  class="form-control @error('information') is-invalid @enderror" type="text"
                               placeholder="Nhập thông tin (tối đa 3000 kí tự)"
                               name="common_issue"
                               value="{{ old('common_issue') }}" rows="7" cols="50"
                               autocomplete="name" autofocus></textarea>
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

