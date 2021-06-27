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
        <h5 class="card-header">Chi tiết chờ duyệt chuyên gia </h5>
        @if(session()->has('saved'))
            <div class="alert alert-success">
                <strong>Đã update</strong>
            </div>
        @endif
        <div class="card-body">
            <form method="POST" action="/admin/expert_pending/grant_expert">
                @csrf
                <div class="form-group ">
                    <!--ID -->
                    <input hidden type="text"
                           name="id" value="{{ $pendingExpert->id }}" autocomplete="name" autofocus>
                    <!--USER ID -->
                    <input hidden type="text"
                           name="user_id" value="{{ $pendingExpert->user_id }}" autocomplete="name" autofocus>
                    <!--IMAGES -->
                    <input hidden type="text"
                           name="images" value="{{ $pendingExpert->imagesForPendingExpert }}" autocomplete="name" autofocus>

                    <!-- Bio -->
                    <label><b>User id: </b></label> <p>{{$pendingExpert->user_id}}</p>
                    <!-- Bio -->
                    <label><b>Bio: </b></label> <p>{{$pendingExpert->bio}}</p>

                    <!-- Experience in -->
                    <label><b>Chuyên về: </b></label> <p>{{$pendingExpert->experience_in}}</p>

                    <!-- HÌNH ẢNH-->
                    <label><b>Hình ảnh: </b></label>
                    <div class="row">
                        @foreach($pendingExpert->imagesForPendingExpert as $image)
                            <div class="column">
                                <img src="{{$image->dynamic_url}}" alt="Snow" style="width:100%">
                            </div>
                        @endforeach
                    </div>

                </div>

                <a class="btn btn-warning ml-2" href="/admin/expert_pending/list_pending" role="button">Quay lại</a>

                <button type="submit" class="btn btn-primary">Duyệt</button>

                <a class="btn btn-danger ml-2" href="" role="button">Xóa</a>

            </form>
        </div>
@endsection

