@extends('master')

@section('content')
<h2>Thông tin tài khoản</h2>
<div class="row">
    <form method="POST" action="{{ route('user.info', ['user' => $user->id]) }}" class="col-8" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">User name</label>
            @if ($user->isRole('student'))
                <div id="exampleInputEmail1" class="form-control" aria-describedby="emailHelp">
                    {{ $user->username }}
                </div>
            @else    
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" value="{{ $user->username }}">
                @error('username')
                    <span style="color: red;">{{ $errors->first('username') }}</span>
                @enderror
            @endif
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">New password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            @error('password')
                <span style="color: red;">{{ $errors->first('password') }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">Re-password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="password_confirmation">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail2">Email</label>
            <input type="text" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" name="email" value="{{ $user->email }}">
            @error('email')
                <span style="color: red;">{{ $errors->first('email') }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail3">Full name</label>
            @if ($user->isRole('student'))
                <div id="exampleInputEmail1" class="form-control" aria-describedby="emailHelp">
                    {{ $user->name }}
                </div>
            @else 
                <input type="text" class="form-control" id="exampleInputEmail3" aria-describedby="emailHelp" name="name" value="{{ $user->name }}">
                @error('name')
                    <span style="color: red;">{{ $errors->first('name') }}</span>
                @enderror
            @endif
        </div>
        <div class="form-group">
            <label for="exampleInputEmail4">SĐT</label>
            <input type="text" class="form-control" id="exampleInputEmail4" aria-describedby="emailHelp" name="sdt" value="{{ $user->sdt }}">
            @error('sdt')
                <span style="color: red;">{{ $errors->first('sdt') }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="gender">Giới tính</label>
            <div class="col-3 row">
                <select name="gender" id="gender">
                    <option value="" disabled selected>Chọn</option>
                    <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Nam</option>
                    <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Nữ</option>
                </select>
                @error('gender')
                    <span style="color: red;">{{ $errors->first('gender') }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group  ">
            <label for="userAvatar" class="form-label">Upload avatar</label>
            <input name="avatar" type="file" class="form-control" id="userAvatar" accept="image/*">
            <label for="urlAvatar" class="form-label mt-3">Url ảnh</label>
            <input name="url_avatar" type="text" class="form-control" id="urlAvatar">
            <div class="figure">
                <img style="width: 200px;" src="{{ asset('storage/avatars/'.$user->avatar) }}" class="my-3 rounded">
                <figcaption class="figure-caption text-center">Avatar hiện tại</figcaption>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection