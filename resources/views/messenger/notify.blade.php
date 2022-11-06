@extends('master')

@section('content')
<h2>Tin nhắn của bạn</h2>
<div class="row">
    <div class="col-12">
        <h5>Tin đã gửi</h5>
        <div>
            @foreach ($linkTo as $k => $links)
                @foreach ($links as $link)
                    <a class="btn btn-primary" href="{{ route('messenger.create', ['user' => $links->first()->user_from]) }}" style="max-width: 110px; min-width: 110px;">
                        {{ mb_strlen($link->messenger) > 10 ? substr($link->messenger, 0, 10) . ' ...' : $link->messenger . ' ...' }}
                    </a>
                    <div style="height: 14px;"></div>
                @endforeach
            @endforeach
        </div>
    </div>
    <div class="col-12">
        <h5>Tin đã nhận</h5>
        <div>
            @foreach ($linkFrom as $link)
                <a class="btn btn-primary" href="{{ route('messenger.create', ['user' => $link->user_from]) }}" style="max-width: 110px; min-width: 110px;">
                    {{ mb_strlen($link->messenger) > 10 ? substr($link->messenger, 0, 10) . ' ...' : $link->messenger . ' ...' }}
                </a>
                <div style="height: 14px;"></div>
            @endforeach
        </div>
    </div>
</div>
@endsection