@extends('layouts.admin_layout')

@section('title', 'Chi tiết cây cảnh')

@section('content')
<style>
    .column {
        float: left;
        width: 33.33%;
        padding: 5px;
    }
</style>
<div class="card">
    <h5 class="card-header">Chi tiết thẻ bài viết </h5>
    @if(session()->has('saved'))
    <div class="alert alert-success">
        <strong>Đã update</strong>
    </div>
    @endif
    @if(session()->has('added'))
        <div class="alert alert-success">
            <strong>Đã thêm</strong>
        </div>
    @endif
    <div class="card-body">
        <form method="POST" action="/admin/tag/update">
            @csrf
            <div class="form-group ">
                <!--ID -->
                <input hidden type="text"
                       name="id" value="{{ $tag->id }}" autocomplete="name" autofocus>

                <!-- TAG Name -->
                <label><b>Tên thẻ: </b>
                <input class="form-control @error('name') is-invalid @enderror" type="text"
                       placeholder="Tên thẻ" name="name"
                       value="{{ old('name', $tag->name) }}" autocomplete="name" autofocus>
                    <br>
                <!-- TAG TYPE NAME -->
                <label><b>Tên loại thẻ: </b><br>
                <select name="tag_type_id">
                    @foreach($tag_types as $tag_type)
                        <option {{$tag_type->id == $tag->tagType->id ? 'selected' : ''}} value={{$tag_type->id}}>{{$tag_type->name}}</option>
                    @endforeach
                </select>

            </div>

            <a class="btn btn-warning ml-2" href="/admin/tag/list_tag" role="button">Quay lại</a>
            <a class="btn btn-danger ml-2" href="" role="button">Xóa</a>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
    @endsection

