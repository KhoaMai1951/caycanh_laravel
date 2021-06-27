@extends('layouts.admin_layout')

@section('title', 'Danh sách dữ liệu cây cảnh')

@section('content')
    <!-- TITLE -->
    <div class="alert alert-primary" role="alert">
        <h1>Danh sách chuyên gia</h1>
    </div>

    @if(session()->has('deleted'))
        <div class="alert alert-success">
            <strong>@lang('custom_message.deleted')</strong>
        </div>
    @endif

    @if(count($users) == 0)
        <div class="alert alert-warning">
            Không có dữ liệu
        </div>
    @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>STT</th>
                <th>Username</th>
                <th>Email</th>
                <th width="300px;">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($users) && $users->count())
                @foreach($users as $key => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->username }}</td>
                        <td>{{ $value->email }}</td>
                        <td>
                            <a class="btn btn-info" href="/admin/expert_pending/pending_detail/{{$value->id}}">Chi tiết</a>
                            <button class="btn btn-danger">Xóa</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
            @endif
            </tbody>
        </table>

        {!! $users->links() !!}
    @endif
@endsection

