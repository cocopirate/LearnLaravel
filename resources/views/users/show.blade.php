@extends('layouts.default')

@section('title', $user->name)

@section('content')
<div class="row col-md-12 center-block">
    <section class="user_info">
        @include('shared._user_info', ['user' => $user])
    </section>
</div>
@stop