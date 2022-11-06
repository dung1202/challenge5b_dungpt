@extends('master')

@section('content')
<h2>Sửa bài tập</h2>
<div class="row">
    <form method="POST" action="{{ route('exercise.update', ['id' => $exercise->id]) }}" class="col-8" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Tên bài tập</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="exercise_name" value="{{ $exercise->name }}">
            @error('exercise_name')
                <span style="color: red;">{{ $errors->first('exercise_name') }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputText1">Mô tả</label>
            <textarea class="form-control shadow-none textarea" id="exampleInputText1" name="description" cols="30" rows="5">{{ $exercise->description }}</textarea>
            @error('description')
                <span style="color: red;">{{ $errors->first('description') }}</span>
            @enderror
        </div>
        <div class="form-group">
            <span>File bài tập hiện tại: </span>
            @foreach ($exercise->file as $item)
                <a href="{{ asset($item) }}" style="display: block;">{{ asset($item) }}</a>
            @endforeach
            <label for="exampleInputFile1">Chọn file khác</label>
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
                    <option value="{{ $student->id }}" {{ $studentsExercise->contains($student->id) ? 'selected' : '' }}>{{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection