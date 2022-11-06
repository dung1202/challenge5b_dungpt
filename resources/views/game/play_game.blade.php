@extends('master')

@section('content')
<h2>{{ $game->name }}</h2>
<div class="row">
    <div class="col-12">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenteredScrollable">
            Show gợi ý
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1"
            aria-labelledby="exampleModalCenteredScrollableTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">{{ $game->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ $game->description }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <form method="POST" action="{{ route('game.play', ['id' => $game->id]) }}" class="col-8" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Đáp án</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                name="play_name">
            @error('play_name')
                <span style="color: red;">{{ $errors->first('play_name') }}</span>
            @enderror
            @if (isset($error))
                <span style="color: red">{{ $error }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus');
    });
</script>
@endsection