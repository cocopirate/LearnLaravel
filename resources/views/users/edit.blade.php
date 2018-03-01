@extends('layouts.default')

@section('title', '个人资料编辑')

@section('content')
    <div class="row col-md-12">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>个人资料编辑</h5>
                </div>
                <div class="panel-body">

                    @include('shared._errors')

                    <div class="gravatar_edit">
                        <a href="http://gravatar.com/emails" target="_blank">
                            <img class="gravatar" src="{{ $user->gravatar('200') }}" alt="{{ $user->name }}"/>
                        </a>
                    </div>

                    <form method="POST" action="{{route('users.update', $user->id)}}">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group">
                            <label for="name">姓名：</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                        </div>

                        <div class="form-group">
                            <label for="email">邮箱：</label>
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="password">密码：</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">确认密码：</label>
                            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop