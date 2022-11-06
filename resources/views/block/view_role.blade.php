@extends('master')

@section('content')
<h2>Danh sách học sinh</h2>
<a href="{{ route('role.create') }}" class="btn btn-primary" style="margin-bottom: 20px;">Add user</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Name</th>
            <th scope="col">Display name</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $role)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $role->name }}</td>
                <td>{{ $role->display_name }}</td>
                <td>
                    <a href="{{ route('role.edit', ['role' => $role->id]) }}" class="btn btn-success">Edit</a>
                    <a onclick="return confirm('Bạn có muốn xoá?');" href="{{ route('role.destroy', ['role' => $role->id]) }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection