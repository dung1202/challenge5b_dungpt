@extends('master')

@section('content')

@if (auth()->user()->isRole('teacher'))
    <a href="{{ route('exercise.create') }}" class="btn btn-primary" style="margin-bottom: 20px;">Giao bài</a>
    <a href="{{ route('game.create') }}" class="btn btn-primary" style="margin-bottom: 20px;">Trò chơi đoán chữ</a>
@endif
<h2>Danh sách bài tập</h2>
@if ($exercises->isEmpty())
    <span style="color: red; margin: -5px 0 5px 0; display: block;">Chưa tạo bài tập</span>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên bài tập</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($exercises as $exercise)
        <tr>
            <th scope="row">{{ $loop->index + 1 }}</th>
            <td>{{ $exercise->name }}</td>
            <td>{{ $exercise->description }}</td>
            <td>
                @if (!auth()->user()->isRole('student'))
                    <a href="{{ route('exercise.show', ['id' => $exercise->id]) }}" class="btn btn-success">Detail</a>
                    <a href="{{ route('exercise.edit', ['id' => $exercise->id]) }}" class="btn btn-success">Edit</a>
                    <a onclick="return confirm('Bạn có muốn xoá?');" href="{{ route('exercise.destroy', ['id' => $exercise->id]) }}" class="btn btn-danger">Delete</a>
                @endif
                @if (!auth()->user()->isRole('student'))
                    @continue
                @endif
                <a href="{{ route('submit.create', ['exercise' => $exercise->id]) }}" class="btn btn-primary">Trả bài</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
<h2>Danh sách trò chơi</h2>
@if ($games->isEmpty())
    <span style="color: red; margin: -5px 0 5px 0; display: block;">Chưa tạo trò chơi</span>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên trò chơi</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($games as $game)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $game->name }}</td>
                <td>
                    <a href="{{ route('game.show', ['id' => $game->id]) }}" class="btn btn-success">Chơi</a>
                    @if (!auth()->user()->isRole('student'))
                    <a onclick="return confirm('Bạn có muốn xoá?');" href="{{ route('game.destroy', ['id' => $game->id]) }}" class="btn btn-danger">Delete</a>
                        @if (!auth()->user()->isRole('teacher'))
                            @continue
                        @endif
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{ '#game' . $game->id }}">
                            Show gợi ý
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="{{ 'game' . $game->id }}" tabindex="-1"
                            aria-labelledby="exampleModalCenteredScrollableTitle" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <form action="{{ route('game.update', ['id' => $game->id]) }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">{{ $game->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <h5>Gợi ý</h5>
                                                <textarea class="form-control shadow-none textarea" name="hint">{{ $game->description }}</textarea>
                                            </div>
                                            <div class="col-12 form-group">
                                                <h5>Đáp án (Viết hoa / thường / không dấu đều chính xác)</h5>
                                                <input type="text" class="form-control" name="result" value="{{ $game->result }}">
                                            </div>
                                            <div class="col-12">
                                                <h5>Nội dung</h5>
                                                <textarea class="form-control shadow-none textarea" name="content">{{ $game->game_content }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @error('hint')
                            <span style="color: ">{{ $errors->first('hint') }}</span>
                        @enderror
                        @error('content')
                            <span style="color: ">{{ $errors->first('content') }}</span>
                        @enderror
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
<h2>Danh sách người dùng</h2>
{{-- @if (auth()->check() && !auth()->user()->isRole('student'))
    <a href="{{ route('user.create') }}" class="btn btn-primary" style="margin-bottom: 20px;">Add user</a>
@endif --}}
@if ($users->isEmpty())
    <span style="color: red; margin: -5px 0 5px 0; display: block;">Chưa tạo user</span>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">User name</th>
            <th scope="col">Họ tên</th>
            <th scope="col">Giới tính</th>
            <th scope="col">Email</th>
            <th scope="col">SĐT</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($users as $user)
            @if (auth()->user()->isRole('student') && $user->isRole('admin') || $user->id === auth()->user()->id)
                @continue
            @endif
            <tr>
                <th scope="row">{{ $i }}</th>
                <td>
                    {{ $user->username }}
                    <br>
                    <span style="color: red;">({{ $user->roles()->first()->display_name }})</span>
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->gender == 0 ? 'Nữ' : 'Nam' }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->sdt }}</td>
                <td>
                    @if ( auth()->check() && !auth()->user()->isRole('student') )
                        @if ( !$user->isRole('student') && auth()->user()->isRole('teacher') )
                        @else
                            <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-success">Edit</a>
                            <a onclick="return confirm('Bạn có muốn xoá?');" href="{{ route('user.destroy', ['user' => $user->id]) }}" class="btn btn-danger">Delete</a>
                        @endif
                    @endif
                    <a href="{{ route('messenger.create', ['user' => $user->id]) }}" class="btn btn-primary">Mesenger</a>
                </td>
            </tr>
            @php
                $i ++;
            @endphp
        @endforeach
    </tbody>
</table>
@endif
@endsection