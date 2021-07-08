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
                <img class="mb-5" width="300" height="300" src="{{ $server_plant->image_url }}" alt="" title=""/>
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
                               name="server_plant_user_edit_id" value="{{ $user_edit_plant->id }}" autocomplete="name"
                               autofocus>
                        <input hidden type="text"
                               name="server_plant_id" value="{{ $user_edit_plant->server_plant_id }}"
                               autocomplete="name" autofocus>
                        <input hidden type="text"
                               name="user_id" value="{{ $user_edit_plant->user_id }}" autocomplete="name" autofocus>
                        <!-- Tên thường gọi -->
                        <div class="form-group bg-light">
                            <label class="required">Tên thường gọi</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text"
                                   placeholder="Tên thường gọi" name="common_name"
                                   value="{{ old('name', $user_edit_plant->common_name) }}" autocomplete="name"
                                   autofocus>
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
                                   value="{{ old('scientific_name', $user_edit_plant->scientific_name) }}"
                                   autocomplete="scientific_name" autofocus/>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- Thông tin -->
                        <div class="form-group bg-light">
                            <label class="required">Thông tin</label>
                            <textarea class="form-control @error('information') is-invalid @enderror" type="text"
                                      placeholder="Thông tin" name="information"
                                      autocomplete="information" autofocus cols="40"
                                      rows="10">{{ old('information', $user_edit_plant->information)}}</textarea>

                            @error('information')
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
                                <option {{$user_edit_plant->pet_friendly ? 'selected' : ''}} value="1">Có</option>
                                <option {{$user_edit_plant->pet_friendly == false ? 'selected' : ''}} value="0">Không
                                </option>
                            </select>
                        </div>
                        <!-- ĐỘ KHÓ -->
                        <div class="form-group bg-light">
                            <label class="required">Độ khó (1-5)</label>
                            <input value={{$user_edit_plant->difficulty}} type="number" name="difficulty" min="1" max="5">
                        </div>
                        <!-- MỨC TƯỚI -->
                        <div class="form-group bg-light">
                            <label class="required">Mức độ tưới nước (1-5)</label>
                            <input value={{$user_edit_plant->water_level}} type="number" name="water_level" min="1" max="5">
                        </div>
                        <!-- MỨC SÁNG -->
                        <div class="form-group bg-light">
                            <label class="required">Mức độ ánh sáng mặt trời (1-5)   </label>
                            <input value={{$user_edit_plant->sunlight}} type="number" name="sunlight" min="1" max="5">
                        </div>
                        <!-- NHIỆT ĐỘ -->
                        <div class="form-group bg-light @error('min_temperature') is-invalid @enderror ">
                            <label class="required">Nhiệt độ</label><br>
                            Nhỏ nhất: <input value="{{ old('min_temperature') ?? old('min_temperature') ?? $user_edit_plant->min_temperature}}" type="number" name="min_temperature" min="1" max="100">
                            Lớn nhất: <input value="{{ old('max_temperature') ?? old('max_temperature') ?? $user_edit_plant->max_temperature}}" type="number" name="max_temperature" min="1" max="100">
                            @error('min_temperature')
                            <strong >Nhiệt độ nhỏ nhất phải nhỏ hơn nhiệt độ lớn nhất</strong>
                            @enderror
                        </div>
                        <!-- ĐỘ PH -->
                        <div class="form-group bg-light @error('scientific_name') is-invalid @enderror ">
                            <label class="required">Độ PH</label><br>
                            Nhỏ nhất: <input value="{{ old('min_ph') ?? old('min_ph') ?? $user_edit_plant->min_ph}}" type="number" step="0.1" name="min_ph" min="1" max="10">
                            Lớn nhất: <input value="{{ old('max_ph') ?? old('max_ph') ?? $user_edit_plant->max_ph}}" type="number" step="0.1" name="max_ph" min="1" max="10">
                            @error('min_ph')
                            <strong >Độ PH nhỏ nhất phải nhỏ hơn độ PH lớn nhất</strong>
                            @enderror
                        </div>
                    </div>
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
                               name="server_plant_user_edit_id" value="{{ $user_edit_plant->id }}" autocomplete="name"
                               autofocus>
                        <input hidden type="text"
                               name="server_plant_id" value="{{ $server_plant->id }}" autocomplete="name" autofocus>
                        <input hidden type="text"
                               name="id" value="{{ $server_plant->id }}" autocomplete="name" autofocus>
                        <!-- Tên thường gọi -->
                        <div class="form-group bg-light">
                            <label class="required">Tên thường gọi</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text"
                                   placeholder="Tên thường gọi" name="common_name"
                                   value="{{ old('name', $server_plant->common_name) }}" autocomplete="name" autofocus>
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
                                   value="{{ old('scientific_name', $server_plant->scientific_name) }}"
                                   autocomplete="scientific_name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <!-- Thông tin -->
                        <div class="form-group bg-light">
                            <label class="required">Thông tin</label>
                            <textarea class="form-control @error('information') is-invalid @enderror" type="text"
                                      placeholder="Thông tin" name="information"
                                      autocomplete="information" autofocus cols="40"
                                      rows="10">{{ old('information', $server_plant->information)}}</textarea>

                            @error('information')
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
                                <option {{$server_plant->pet_friendly ? 'selected' : ''}} value="1">Có</option>
                                <option {{$server_plant->pet_friendly == false ? 'selected' : ''}} value="0">Không
                                </option>
                            </select>
                        </div>
                        <!-- ĐỘ KHÓ -->
                        <div class="form-group bg-light">
                            <label class="required">Độ khó (1-5)</label>
                            <input value={{$server_plant->difficulty}} type="number" name="difficulty" min="1" max="5">
                        </div>
                        <!-- MỨC TƯỚI -->
                        <div class="form-group bg-light">
                            <label class="required">Mức độ tưới nước (1-5)</label>
                            <input value={{$server_plant->water_level}} type="number" name="water_level" min="1" max="5">
                        </div>
                        <!-- MỨC SÁNG -->
                        <div class="form-group bg-light">
                            <label class="required">Mức độ ánh sáng mặt trời (1-5)   </label>
                            <input value={{$server_plant->sunlight}} type="number" name="sunlight" min="1" max="5">
                        </div>
                        <!-- NHIỆT ĐỘ -->
                        <div class="form-group bg-light @error('min_temperature') is-invalid @enderror ">
                            <label class="required">Nhiệt độ</label><br>
                            Nhỏ nhất: <input value="{{ old('min_temperature') ?? old('min_temperature') ?? $server_plant->min_temperature}}" type="number" name="min_temperature" min="1" max="100">
                            Lớn nhất: <input value="{{ old('max_temperature') ?? old('max_temperature') ?? $server_plant->max_temperature}}" type="number" name="max_temperature" min="1" max="100">
                            @error('min_temperature')
                            <strong >Nhiệt độ nhỏ nhất phải nhỏ hơn nhiệt độ lớn nhất</strong>
                            @enderror
                        </div>
                        <!-- ĐỘ PH -->
                        <div class="form-group bg-light @error('scientific_name') is-invalid @enderror ">
                            <label class="required">Độ PH</label><br>
                            Nhỏ nhất: <input value="{{ old('min_ph') ?? old('min_ph') ?? $server_plant->min_ph}}" type="number" step="0.1" name="min_ph" min="1" max="10">
                            Lớn nhất: <input value="{{ old('max_ph') ?? old('max_ph') ?? $server_plant->max_ph}}" type="number" step="0.1" name="max_ph" min="1" max="10">
                            @error('min_ph')
                            <strong >Độ PH nhỏ nhất phải nhỏ hơn độ PH lớn nhất</strong>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>

                </form>
            </div>
        </div>
    </div>
@endsection

