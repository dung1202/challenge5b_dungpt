@extends('master')

{{-- @php
    dd($errors);
@endphp --}}

@section('content')
<div class="row">
    <div class="col-8">
        <h2>Đăng ký</h2>
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">User name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
                @error('username')
                    <span style="color: red;">{{ $errors->first('username') }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
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
                <input type="text" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" name="email">
                @error('email')
                    <span style="color: red;">{{ $errors->first('email') }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail3">Full name</label>
                <input type="text" class="form-control" id="exampleInputEmail3" aria-describedby="emailHelp" name="name">
                @error('name')
                    <span style="color: red;">{{ $errors->first('name') }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail4">SĐT</label>
                <input type="text" class="form-control" id="exampleInputEmail4" aria-describedby="emailHelp" name="sdt">
                @error('sdt')
                    <span style="color: red;">{{ $errors->first('sdt') }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="gender">Giới tính</label>
                <div class="col-3 row">
                    <select name="gender" id="gender">
                        <option value="" disabled selected>Chọn</option>
                        <option value="1">Nam</option>
                        <option value="0">Nữ</option>
                    </select>
                </div>
                @error('gender')
                    <span style="color: red;">{{ $errors->first('gender') }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection