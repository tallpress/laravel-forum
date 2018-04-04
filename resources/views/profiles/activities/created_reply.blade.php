<div class="card">

    <div class="card-header">
        {{ $profileUser->name }} replied to
        <a href="{{$activity->subject->thread->path()}}">
            {{ $activity->subject->thread->title }}
        </a>
      {{$activity->subject->created_at->diffForHumans()}}
    </div>

    <div class="card-body">
        {{ $activity->subject->body }}
    </div>
    
</div>
