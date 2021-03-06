<li>
    <img class="gravatar" src="{{ $user->gravatar() }}" alt="{{ $user->name }}" />
    <a class="username" href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>

    @can('destroy', $user)
        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
        </form>
    @endcan
</li>