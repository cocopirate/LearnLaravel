@extends('layouts.default')

@section('title', '更新密码')

@section('content')
    <div class="row col-md-12">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>更新密码</h5>
                </div>
                <div class="panel-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('password.update') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}" />

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label col-md-4" >邮箱地址：</label>
                            <div class="col-md-6">
                                <input id="email" type="email" name="email" class="form-control" value="{{ $email or old('$email') }}" required autofocus/>
                                @if($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label col-md-4">密码：</label>
                            <div class="col-md-6">
                                <input id="password" type="password" name="password" class="form-control" required />
                                @if($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password_confirm" class="control-label col-md-4">密码：</label>
                            <div class="col-md-6">
                                <input id="password_confirm" type="password" name="password_confirmation" class="form-control" required />
                                @if($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">修改密码</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection