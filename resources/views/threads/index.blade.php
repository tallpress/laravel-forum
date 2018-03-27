@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Threads</div>

                <div class="card-body">
                  @foreach ($threads as $thread)
                    <article>
                      <h4>
                        <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                      </h4>
                      <h6><a href="#">{{ $thread->creator->name }}</a></h6>
                      <strong>{{ $thread->created_at->diffForHumans() }}</strong>

                      <p>
                        {{ $thread->body }}
                      </p>

                      <a href="{{ $thread->path() }}">
                        <p>{{ $thread->replies_count }} {{str_plural('reply', $thread->replies_count)}}</p>
                      </a>

                    </article>

                    <hr>
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
