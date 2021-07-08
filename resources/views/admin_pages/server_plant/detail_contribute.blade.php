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
                <img class="mb-5" width="300" height="300" src="{{ $plant->image_url }}" alt="" title=""/>
                <div class="form-group ">
                    <!--ID -->
                    <input hidden type="text"
                           name="id" value="{{ $plant->id }}" autocomplete="name" autofocus>
                    <!-- Tên thường gọi -->
                    <div class="form-group bg-light">
                        <label class="required">Tên thường gọi</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                               placeholder="Tên thường gọi" name="common_name"
                               value="{{ old('name', $plant->common_name) }}" autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <!-- Tên khoa học -->
                    <div class="form-group bg-light">
                        <label class="required">Tên khoa học</label>
                        <input class="form-control @error('scientific_name') is-invalid @enderror" type="text"
                               placeholder="Tên thường gọi" name="scientific_name"
                               value="{{ old('scientific_name', $plant->scientific_name) }}"
                               autocomplete="scientific_name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <!-- THÂN THIỆN THÚ NUÔI -->
                    <br>
                    <div class="form-group bg-light">
                        <label class="required">Thân thiện thú nuôi</label>
                        <select name="pet_friendly">
                            <option {{$plant->pet_friendly ? 'selected' : ''}} value="1">Có</option>
                            <option {{$plant->pet_friendly == false ? 'selected' : ''}} value="0">Không</option>
                        </select>
                    </div>
                    <!-- ĐỘ KHÓ -->
                    <div class="form-group bg-light">
                        <label class="required">Độ khó (1-5)</label>
                        <input value={{$plant->difficulty}} type="number" name="difficulty" min="1" max="5">
                    </div>
                    <!-- MỨC TƯỚI -->
                    <div class="form-group bg-light">
                        <label class="required">Mức độ tưới nước (1-5)</label>
                        <input value={{$plant->water_level}} type="number" name="water_level" min="1" max="5">
                    </div>
                    <!-- MỨC SÁNG -->
                    <div class="form-group bg-light">
                        <label class="required">Mức độ ánh sáng mặt trời (1-5)   </label>
                        <input value={{$plant->sunlight}} type="number" name="sunlight" min="1" max="5">
                    </div>
                    <!-- NHIỆT ĐỘ -->
                    <div class="form-group bg-light @error('min_temperature') is-invalid @enderror ">
                        <label class="required">Nhiệt độ</label><br>
                        Nhỏ nhất: <input value="{{ old('min_temperature') ?? old('min_temperature') ?? $plant->min_temperature}}" type="number" name="min_temperature" min="1" max="100">
                        Lớn nhất: <input value="{{ old('max_temperature') ?? old('max_temperature') ?? $plant->max_temperature}}" type="number" name="max_temperature" min="1" max="100">
                        @error('min_temperature')
                        <strong >Nhiệt độ nhỏ nhất phải nhỏ hơn nhiệt độ lớn nhất</strong>
                        @enderror
                    </div>
                    <!-- ĐỘ PH -->
                    <div class="form-group bg-light @error('scientific_name') is-invalid @enderror ">
                        <label class="required">Độ PH</label><br>
                        Nhỏ nhất: <input value="{{ old('min_ph') ?? old('min_ph') ?? $plant->min_ph}}" type="number" step="0.1" name="min_ph" min="1" max="10">
                        Lớn nhất: <input value="{{ old('max_ph') ?? old('max_ph') ?? $plant->max_ph}}" type="number" step="0.1" name="max_ph" min="1" max="10">
                        @error('min_ph')
                        <strong >Độ PH nhỏ nhất phải nhỏ hơn độ PH lớn nhất</strong>
                        @enderror
                    </div>
                    <!-- Thông tin -->
                    <div class="form-group bg-light">
                        <label class="required">Thông tin</label>
                        <textarea class="form-control @error('information') is-invalid @enderror" type="text"
                                  placeholder="Thông tin" name="information"
                                  autocomplete="information" autofocus cols="40"
                                  rows="5">{{ old('information', $plant->information)}}</textarea>

                        @error('information')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <!-- THÔNG TIN BÓN PHÂN -->
                    <div class="form-group">
                        <label>Thông tin bón phân </label><br>
                        <textarea  class="form-control @error('information') is-invalid @enderror" type="text"
                                   placeholder="Nhập thông tin (tối đa 3000 kí tự)"
                                   name="feed_information"
                                   rows="7" cols="50"
                                   autocomplete="name" autofocus>{{ old('feed_information', $plant->feed_information )}}</textarea>
                    </div>
                    <!-- VẤN ĐỀ THƯỜNG GẶP -->
                    <div class="form-group">
                        <label>Vấn đề thường gặp </label><br>
                        <textarea  class="form-control @error('information') is-invalid @enderror" type="text"
                                   placeholder="Nhập thông tin (tối đa 3000 kí tự)"
                                   name="common_issue"
                                   value="{{ old('common_issue'), $plant->common_issue }}" rows="7" cols="50"
                                   autocomplete="name" autofocus></textarea>
                    </div>
                </div>

                <a class="btn btn-danger ml-2" href="/admin/server_plant/list_plant" role="button">Quay lại</a>

                <a class="btn btn-info ml-2" href="/admin/server_plant/accept_contribute/{{$plant->id}}" role="button">Thêm
                    vào DB chính thức</a>

                <button type="submit" class="btn btn-primary">Lưu</button>

            </form>
        </div>
@endsection

