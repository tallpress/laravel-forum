@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Threads</div>

                <div class="card-body">
                  @forelse ($threads as $thread)
                    <article>
                      <h4>
                        <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                      </h4>
                      <h6><a href="/profiles/{{$thread->creator->name}}">{{ $thread->creator->name }}</a></h6>
                      <strong>{{ $thread->created_at->diffForHumans() }}</strong>

                      <p>
                        {{ $thread->body }}
                      </p>

                      <a href="{{ $thread->path() }}">
                        <p>{{ $thread->replies_count }} {{str_plural('reply', $thread->replies_count)}}</p>
                      </a>
                    </article>
                  <hr>
                  @empty
                    <p>
                      There are no related results at this time.
                    </p>
                  @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
