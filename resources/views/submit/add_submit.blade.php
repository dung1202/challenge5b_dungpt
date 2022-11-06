@extends('master')

@section('content')
<h2>Nộp bài</h2>
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
    <form method="POST" action="{{ route('submit.store', ['exercise' => request()->route()->parameter('exercise')]) }}" class="col-8" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputFile1">File bài tập</label>
            <input type="file" class="form-control" id="exampleInputFile1" name="submit_file[]" multiple>
            @error('submit_file')
                <span style="color: red;">{{ $errors->first('submit_file') }}</span>
            @enderror
            @if ($errors->has('submit_file.*'))
                <span style="color: red;">{{ $errors->first('submit_file.*') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection