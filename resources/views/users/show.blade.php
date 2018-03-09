@extends('layouts.default')

@section('title', $user->name)

@section('content')
<div class="row col-md-12 center-block">
    <div class="col-md-8 col-md-offset-2">
        <section class="user_info">
            @include('shared._user_info', ['user' => $user])
        </section>
        <section class="stats">
            @include('shared._stats')
        </section>
        @if(Auth::check())
            @include('shared._follow_form')
        @endif
        @if(count($statuses) > 0)
            <ol class="statuses">
                @foreach($statuses as $status)
                    @include('statuses._status')
                @endforeach
            </ol>
            {!! $statuses->render() !!}
        @endif
    </div>
</div>
@stop