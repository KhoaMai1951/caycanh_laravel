@extends('layouts.admin_layout')

@section('title', 'Danh sách thẻ bài viết')

@section('content')
    <!-- TITLE -->
    <div class="alert alert-primary" role="alert">
        <h1>Danh sách thẻ bài viết</h1>
    </div>

    @if(session()->has('deleted'))
        <div class="alert alert-success">
            <strong>@lang('custom_message.deleted')</strong>
        </div>
    @endif

    @if(count($list) == 0)
        <div class="alert alert-warning">
            @lang('custom_message.no_item_found')
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped bg-light">
                <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên thẻ</th>
                    <th scope="col">Loại thẻ</th>
                    <th scope="col">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $i => $tag)
                    <tr>
                        <th>{{$i+1}}</th>
                        <td>{{$tag->name}}</td>
                        <td>{{$tag->tagType->name}}</td>
                        <td>
                            <a class="btn btn-primary" href="/admin/tag/tag_detail/{{$tag->id}}"
                               role="button">Chi tiết</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! $list->links() !!}
    @endif
@endsection

