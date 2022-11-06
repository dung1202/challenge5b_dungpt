@extends('master')

@section('content')
<h2>Chúc mừng bạn đã trả lời đúng</h2>
<div class="row">
    <div class="col-12" style="color: #217ff3">
        {{ $reply }}
    </div>
</div>
@endsection