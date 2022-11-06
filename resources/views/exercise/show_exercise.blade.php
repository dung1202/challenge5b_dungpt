@extends('master')

@section('content')
<h2>Chi tiết bài tập</h2>
<div class="row">
    <div class="col-12">
        <span>Tên bài: </span><span>{{ $exercise->name }}</span>
    </div>
    <div class="col-12">
        <span>Mô tả: </span><span>{{ $exercise->description }}</span>
    </div>
    <div class="col-12">
        <span>Đề bài</span>
        @foreach ($exercise->file as $item)
            <a href="{{ asset($item) }}" style="display: block;">Xem trực tiếp</a>
            <a href={{"../../". $item}} download>Tải xuống đề bài</a>
        @endforeach
    </div>
    <div class="col-12">
        <h2>Học sinh nộp bài</h2>
        @foreach ($submits as $submit)
            @php
                $submit->file_submit = json_decode($submit->file_submit, true);
            @endphp
            <div class="row">
                <div class="col-12">
                    <span>Học sinh: </span>{{ $submit->user()->first()->name }}
                    @foreach ($submit->file_submit as $item)
                        <a href="{{ asset($item) }}" style="display: block;">Xem trực tiếp</a>
                        <a href={{"../../". $item}} download>Tải xuống đề bài</a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection