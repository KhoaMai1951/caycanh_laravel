@extends('layouts.admin_layout')

@section('title', 'Thêm thẻ bài viết mới')

@section('content')
    <style>
        .column {
            float: left;
            width: 33.33%;
            padding: 5px;
        }
    </style>
    <div class="card">
        <h5 class="card-header">Thêm thẻ bài viết mới </h5>
        <div class="card-body">
            <form method="POST" action="/admin/tag/add_tag">
                @csrf
                <div class="form-group ">
                    <!-- TAG Name -->
                    <label><b>Tên thẻ: </b>
                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                               placeholder="Tên thẻ" name="name"
                               value="{{ old('name') }}" autocomplete="name" autofocus>
                        <br>
                        <!-- TAG TYPE NAME -->
                        <label><b>Tên loại thẻ: </b></label><br>
                        <select name="tag_type_id">
                            @foreach($tag_types as $tag_type)
                                <option
                                    value={{$tag_type->id}}>{{$tag_type->name}}</option>
                            @endforeach
                        </select>
                </div>

                <a class="btn btn-warning ml-2" href="/admin/tag/list_tag" role="button">Quay lại</a>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
@endsection

