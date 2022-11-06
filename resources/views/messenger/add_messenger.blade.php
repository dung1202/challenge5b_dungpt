@extends('master')

@section('content')
@php
    function call($children, $messAdd=[]){
        $empty = [];
        $messDb = new \Illuminate\Database\Eloquent\Collection([]);
        $check = empty($messAdd) ? true : false;
        $messAdd = $check ? $children : $messAdd;
        foreach ($messAdd as $km => $messengerChildren) {
            foreach ($messengerChildren->messengerHasChildren()->get() as $k => $v) {
                $messDb->push($v);
                $id = $messengerChildren->id;
                $start = $children->search(function($i) use($id) {
                    return $i->id === $id;
                });

                $children->splice($start + 1 + $k, 0, [$v]);
                if (!$v->messengerHasChildren()->get()->isEmpty()) {
                    $empty[] = $v->id;
                }
            }
        }
        if (empty($empty)) {
            return $children;
        }
        return call($children, $messDb);
    }
@endphp
<div class="d-flex justify-content-center row">
@foreach ($messengers as $messenger)
    <div class="col-md-8">
        <div class="d-flex flex-column comment-section" id="{{ 'myGroup' . $messenger->id }}">
            <div class="bg-white p-2">
                 <div class="d-flex flex-row user-info">{{--<img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40"> --}}
                    <div class="d-flex flex-column justify-content-start ml-2">
                        <span class="d-block font-weight-bold name">{{ $messenger->userTo()->first()->name }}</span>
                        <span class="date text-black-50"> {{ $messenger->updated_at }}</span>
                    </div>
                </div>
                <div class="mt-2">
                    <p class="comment-text">{{ $messenger->messenger }}</p>
                </div>
            </div>
            <div class="bg-white p-2">
                <div class="d-flex flex-row fs-12">
                    <div class="like p-2 cursor">
                        <i class="fa fa-thumbs-o-up"></i>
                        <span class="ml-1">Like</span>
                    </div>
                    <div class="like p-2 cursor action-collapse" data-toggle="collapse" aria-expanded="true" 
                    aria-controls="{{ 'collapse-' . $messenger->id }}" 
                    href="{{ '#collapse-' . $messenger->id }}">
                        <i class="fa fa-commenting-o"></i>
                        <span class="ml-1">Comment</span>
                    </div>
                    {{-- || ( auth()->user()->isRole('teacher') --}}
                    @if (auth()->user()->id == $messenger->user_to)
                        <div class="like p-2 cursor action-collapse" data-toggle="collapse" aria-expanded="true" 
                        aria-controls="{{ 'edit-collapse-' . $messenger->id }}" 
                        href="{{ '#edit-collapse-' . $messenger->id }}"
                        href-link="{{ route('messenger.edit', ['mess' => $messenger->id]) }}"
                        onclick="editToAjax(this, {{ $messenger->id }}, '{{ 'edit-collapse-' . $messenger->id }}')">
                            <i class="fa fa-share"></i>
                            <span class="ml-1">Edit</span>
                        </div>
                        <div class="like p-2 cursor">
                            <i class="fa fa-thumbs-o-up"></i>
                            <span class="ml-1"><a onclick="return confirm('Bạn muốn xoá tin nhắn?');" href="{{ route('messenger.delete', ['mess' => $messenger->id]) }}">Delete</a></span>
                        </div>
                    @endif
                </div>
            </div>
            <div id="{{ 'collapse-' . $messenger->id }}" class="bg-light p-2 collapse" data-parent="{{ '#myGroup' . $messenger->id }}">
                <form action="{{ route('messenger.store', ['user' => $messenger->userTo()->first()->id, 'mess' => $messenger->id,]) }}" method="POST">
                    @csrf
                    <div class="d-flex flex-row align-items-start">
                        {{-- <img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40"> --}}
                        <textarea class="form-control ml-1 shadow-none textarea" name="messenger"></textarea>
                    </div>
                    @error('messenger')
                        <span style="color: red; margin-left: 40px;">{{ $errors->first('messenger') }}</span>
                    @enderror
                    <div class="mt-2 text-right">
                        <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                        <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
                    </div>
                </form>
            </div>
            @if (auth()->user()->id == $messenger->user_to || auth()->user()->isRole('admin')
            || ( auth()->user()->isRole('teacher') && $messenger->userTo()->first()->isRole('student') ))
                <div id="{{ 'edit-collapse-' . $messenger->id }}" class="bg-light p-2 collapse" data-parent="{{ '#myGroup' . $messenger->id }}">
                    <form action="{{ route('messenger.update', ['mess' => $messenger->id,]) }}" method="POST">
                        @csrf
                        <div class="d-flex flex-row align-items-start">
                            {{-- <img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40"> --}}
                            <textarea class="form-control ml-1 shadow-none textarea" name="messenger"></textarea>
                        </div>
                        @error('messenger')
                            <span style="color: red; margin-left: 40px;">{{ $errors->first('messenger') }}</span>
                        @enderror
                        <div class="mt-2 text-right">
                            <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                            <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
        @if (!$messenger->messengerHasChildren()->get()->isEmpty())
            @php
                $messengerChildrens = $messenger->messengerHasChildren()->get();
                $messengerChildrens = call($messengerChildrens);
            @endphp
            @foreach ($messengerChildrens as $messengerChildren)
                <div class="d-flex flex-column comment-section" id="{{ 'myGroup' . $messengerChildren->id }}" style="padding-left: 60px; background: white;">
                    <div class="bg-white p-2">
                         <div class="d-flex flex-row user-info">{{--<img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40"> --}}
                            <div class="d-flex flex-column justify-content-start ml-2">
                                <span class="d-block font-weight-bold name">{{ $messengerChildren->userTo()->first()->name }}</span>
                                <span class="date text-black-50">{{ $messenger->updated_at }}</span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="comment-text">
                                <a href="">{{ $messengerChildren->userFrom()->first()->name }}</a>
                                {{ $messengerChildren->messenger }}
                            </p>
                        </div>
                    </div>
                    <div class="bg-white p-2">
                        <div class="d-flex flex-row fs-12">
                            <div class="like p-2 cursor">
                                <i class="fa fa-thumbs-o-up"></i>
                                <span class="ml-1">Like</span>
                            </div>
                            <div class="like p-2 cursor action-collapse" data-toggle="collapse" aria-expanded="true" 
                            aria-controls="{{ 'collapse-' . $messengerChildren->id }}" 
                            href="{{ '#collapse-' . $messengerChildren->id }}">
                                <i class="fa fa-commenting-o"></i>
                                <span class="ml-1">Comment</span>
                            </div>
                            @if (auth()->user()->id == $messengerChildren->user_to || auth()->user()->isRole('admin')
                            || ( auth()->user()->isRole('teacher') && $messenger->userTo()->first()->isRole('student') )) 
                                <div class="like p-2 cursor action-collapse" data-toggle="collapse" aria-expanded="true" 
                                aria-controls="{{ 'edit-collapse-' . $messengerChildren->id }}" 
                                href-link="{{ route('messenger.edit', ['mess' => $messengerChildren->id]) }}"
                                href="{{ '#edit-collapse-' . $messengerChildren->id }}"
                                onclick="editToAjax(this, {{ $messengerChildren->id }}, '{{ 'edit-collapse-' . $messengerChildren->id }}')">
                                    <i class="fa fa-share"></i>
                                    <span class="ml-1">Edit</span>
                                </div>
                                <div class="like p-2 cursor">
                                    <i class="fa fa-thumbs-o-up"></i>
                                    <span class="ml-1"><a onclick="return confirm('Bạn muốn xoá tin nhắn?');" href="{{ route('messenger.delete', ['mess' => $messengerChildren->id]) }}">Delete</a></span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div id="{{ 'collapse-' . $messengerChildren->id }}" class="bg-light p-2 collapse" data-parent="{{ '#myGroup' . $messengerChildren->id }}">
                        <form action="{{ route('messenger.store', ['user' => $messengerChildren->userTo()->first()->id, 'mess' => $messengerChildren->id,]) }}" method="POST">
                            @csrf
                            <div class="d-flex flex-row align-items-start">
                                {{-- <img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40"> --}}
                                <textarea class="form-control ml-1 shadow-none textarea" name="messenger"></textarea>
                            </div>
                            @error('messenger')
                                <span style="color: red; margin-left: 40px;">{{ $errors->first('messenger') }}</span>
                            @enderror
                            <div class="mt-2 text-right">
                                <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                                <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
                            </div>
                        </form>
                    </div>
                    @if (auth()->user()->id == $messengerChildren->user_to || auth()->user()->isRole('admin')
                    || ( auth()->user()->isRole('teacher') && $messenger->userTo()->first()->isRole('student') ))
                        <div id="{{ 'edit-collapse-' . $messengerChildren->id }}" class="bg-light p-2 collapse" data-parent="{{ '#myGroup' . $messengerChildren->id }}">
                            <form action="{{ route('messenger.update', ['mess' => $messengerChildren->id,]) }}" method="POST">
                                @csrf
                                <div class="d-flex flex-row align-items-start">
                                    {{-- <img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40"> --}}
                                    <textarea class="form-control ml-1 shadow-none textarea" name="messenger"></textarea>
                                </div>
                                @error('messenger')
                                    <span style="color: red; margin-left: 40px;">{{ $errors->first('messenger') }}</span>
                                @enderror
                                <div class="mt-2 text-right">
                                    <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                                    <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
@endforeach
    <div class="col-md-8">
        <div class="d-flex flex-column comment-section">
            <div class="bg-light p-2">
                <form action="{{ route('messenger.store', ['user' => request()->route()->parameter('user')]) }}" method="POST">
                    @csrf
                    <div class="d-flex flex-row align-items-start">
                        {{-- <img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40"> --}}
                        <textarea class="form-control ml-1 shadow-none textarea" name="messenger"></textarea>
                    </div>
                    @error('messenger')
                        <span style="color: red; margin-left: 40px;">{{ $errors->first('messenger') }}</span>
                    @enderror
                    <div class="mt-2 text-right">
                        <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                        <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection