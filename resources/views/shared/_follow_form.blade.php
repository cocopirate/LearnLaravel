@if($user->id !== Auth::user()->id)
    <div id="follow_form">
        @if(Auth::user()->isFollow($user->id))
            <form method="POST" action="{{ route('followers.destroy', $user->id) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-sm btn-default">取消关注</button>
            </form>
        @else
            <form method="POST" action="{{ route('followers.store', $user->id) }}">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-sm btn-primary">关注</button>
            </form>
        @endif
    </div>
@endif