@extends('master')

@section('content')
<h2>Thêm trò chơi</h2>
<div class="row">
    <form method="POST" action="{{ route('game.store') }}" class="col-8" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Tên trò chơi</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="game_name">
            @error('game_name')
                <span style="color: red;">{{ $errors->first('game_name') }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputText1">Gợi ý</label>
            <textarea class="form-control shadow-none textarea" id="exampleInputText1" name="game_desc" cols="30" rows="5"></textarea>
            @error('game_desc')
                <span style="color: red;">{{ $errors->first('game_desc') }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputFile1" style="color: #217ff3;">
                File (Nội dung là bài thơ, văn ... của đáp án, đáp án là tên file, 
                tên file được viết dưới định dạng không dấu và các từ cách nhau bởi 1 khoảng trắng) (.txt)
            </label>
            <input type="file" class="form-control" id="exampleInputFile1" name="game_file">
            @error('game_file')
                <span style="color: red;">{{ $errors->first('game_file') }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection