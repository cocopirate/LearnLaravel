<form method="POST" action="{{ route('statuses.store') }}">
    @include('shared._errors')
    {{ csrf_field() }}
    <textarea class="form-control" placeholder="聊聊新鲜事儿..." row="3" name="content_text">{{ old('content_text') }}</textarea>
    <button type="submit" class="btn btn-primary pull-right" style="margin-top: 20px">发布</button>
</form>