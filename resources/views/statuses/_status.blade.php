<li id="status-{{ $status->id }}">
    <a href="{{ route('users.show', $user->id) }}">
        <img class="gravatar" src="{{ $user->gravatar() }}" alt="{{ $user->name }}"/>
    </a>
    <span class="user">
        <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
    </span>
    <span class="timestamp">
        {{ $status->created_at->diffForHumans() }}
    </span>
    <span class="content">
        {{ $status->content }}
    </span>

    @can('destroy', $status)
        <form method="POST" action="{{ route('statuses.destroy', $status->id) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button class="btn btn-sm btn-danger status-delete-btn">删除</button>
        </form>
    @endcan
</li>