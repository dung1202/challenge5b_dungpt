@extends('master')

@section('content')
<h2>Sửa học sinh</h2>
<div class="row">
    <form method="POST" action="{{ route('role.update', ['role' => $role->id]) }}" class="col-8">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="{{ $role->name }}">
            @error('name')
                <span style="color: red;">{{ $errors->first('name') }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail2">Display name</label>
            <input type="text" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" name="display_name" value="{{ $role->display_name }}">
            @error('display_name')
                <span style="color: red;">{{ $errors->first('display_name') }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Quyền nhân viên</label>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="checkAll" 
                    {{ $listPermissionsOfRole->diff($listPermissions)->isEmpty() ? 'checked' : '' }}> Check All
                </label>
            </div>
            @foreach ($permissions as $permission)
                <div class="checkbox">
                    <label>
                        <input type="checkbox" class="check" name="permissions[]" 
                        value="{{ $permission->id }}"
                        {{ $listPermissions->contains($permission->id) ? 'checked' : '' }}
                        > {{ $permission->display_name }}
                    </label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection