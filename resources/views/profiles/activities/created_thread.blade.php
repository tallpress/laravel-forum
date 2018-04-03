<div class="card">
    <div class="card-header">
        {{ $profileUser->name }} published <a href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a>
      {{-- <strong>
        <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
      </strong> was published by {{ $thread->creator->name }}
      {{$thread->created_at->diffForHumans()}} --}}
    </div>
    <div class="card-body">
      {{ $activity->subject->body }}
    </div>
</div>
