<div class="card">

    <div class="card-header">
        {{ $profileUser->name }} favorited a <a href="{{$activity->subject->favorited->path() }}">reply</a>
        {{-- <a href="{{$activity->subject->thread->path()}}">
            {{ $activity->subject->thread->title }}
        </a> --}}
      {{$activity->subject->created_at->diffForHumans()}}
    </div>

    <div class="card-body">
        {{ $activity->subject->favorited->body }}
    </div>
</div>
