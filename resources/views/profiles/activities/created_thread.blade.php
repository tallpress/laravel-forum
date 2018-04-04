<div class="card">

    <div class="card-header">
        {{ $profileUser->name }} published <a href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a>
      {{ $activity->subject->created_at->diffForHumans() }}
    </div>

    <div class="card-body">
      {{ $activity->subject->body }}
    </div>
</div>
