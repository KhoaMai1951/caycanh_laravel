@extends('layouts.admin_layout')

@section('title', 'Danh sách dữ liệu cây cảnh')

@section('content')
    <!-- TITLE -->
    <div class="alert alert-primary" role="alert">
        <h1>Danh sách đang chờ duyệt chuyên gia</h1>
    </div>

    @if(session()->has('deleted'))
        <div class="alert alert-success">
            <strong>@lang('custom_message.deleted')</strong>
        </div>
    @endif

    @if(count($pendings) == 0)
        <div class="alert alert-warning">
            Không có dữ liệu
        </div>
    @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>id user</th>
                <th>username</th>
                <th>bio</th>
                <th>kinh nghiệm trong</th>
                <th width="300px;">Action</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($pendings) && $pendings->count())
                @foreach($pendings as $key => $value)
                    <tr>
                        <td>{{ $value->user_id }}</td>
                        <td>{{ $value->test }}</td>
                        <td>{{ $value->bio }}</td>
                        <td>{{ $value->experience_in }}</td>
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

        {!! $pendings->links() !!}
    @endif
@endsection

