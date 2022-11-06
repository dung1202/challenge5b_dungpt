@extends('master')

@section('content')
<h2>Thêm học sinh</h2>
<div class="row">
    <form method="POST" action="{{ route('exercise.store') }}" class="col-8" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Tên bài tập</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="exercise_name">
            @error('exercise_name')
                <span style="color: red;">{{ $errors->first('exercise_name') }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputText1">Mô tả</label>
            <textarea class="form-control shadow-none textarea" id="exampleInputText1" name="description" cols="30" rows="5"></textarea>
            @error('description')
                <span style="color: red;">{{ $errors->first('description') }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputFile1">File bài tập</label>
            <input type="file" class="form-control" id="exampleInputFile1" name="exercise_file[]" multiple>
            @error('exercise_file')
                <span style="color: red;">{{ $errors->first('exercise_file') }}</span>
            @enderror
            @if ($errors->has('exercise_file.*'))
                <span style="color: red;">{{ $errors->first('exercise_file.*') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="students">Học sinh nhận bài</label>
            <select name="students[]" multiple class="col-12" id="students">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection