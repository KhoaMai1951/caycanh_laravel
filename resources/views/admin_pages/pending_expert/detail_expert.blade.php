@extends('layouts.admin_layout')

@section('title', 'Chi tiết chuyên gia')

@section('content')
    <style>
        .column {
            float: left;
            width: 33.33%;
            padding: 5px;
        }
    </style>
    <div class="card">
        <h5 class="card-header">Chi tiết chuyên gia </h5>
        <div class="card-body">
            <form method="POST" action="/admin/expert_pending/delete_expert">
                @csrf
                <div class="form-group ">
                    <!--ID -->
                    <input hidden type="text"
                           name="id" value="{{ $user->id }}" autocomplete="name" autofocus>

                    <!-- Username -->
                    <label><b>Username: </b></label> <p>{{$user->username}}</p>

                    <!-- Name -->
                    <label><b>Họ tên: </b></label> <p>{{$user->name}}</p>

                    <!-- Email -->
                    <label><b>Email: </b></label> <p>{{$user->email}}</p>

                    <!-- Bio -->
                    <label><b>Bio: </b></label> <p>{{$user->bio}}</p>

                </div>

                <a class="btn btn-warning ml-2" href="/admin/expert_pending/list_expert" role="button">Quay lại</a>

                <button type="submit" class="btn btn-danger ml-2">Xóa chuyên gia</button>

            </form>
        </div>
@endsection

