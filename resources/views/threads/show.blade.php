@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <strong>{{ $thread->title }}</strong> was published by <a href="#">{{ $thread->creator->name }}</a>
                </div>

                <div class="card-body">
                  {{ $thread->body }}
                </div>
            </div>
            @foreach ( $replies as $reply )
              @include ('threads.reply')
            @endforeach
            <br>
            {{ $replies->links() }}

            @if (auth()->check())
              <form action="{{ $thread->path() }}/replies" method="POST">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <textarea placeholder="Comment here..." name="body" rows="8" cols="80" class="form-control"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Post</button>
              </form>
            @else
              <p>Please <a href="{{ route('login') }}">sign in</a> to comment</p>
            @endif
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <p>This thread was published on <strong>{{ $thread->created_at->toFormattedDateString() }}</strong> by
                <a href="#"><strong>{{ $thread->creator->name }}</strong></a> and currently has
                <strong>{{ $thread->replies_count }}</strong> {{ str_plural('reply', $thread->replies_count )}}.
              </p>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
