@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Threads</div>

                <div class="card-body">
                  @foreach ($threads as $thread)
                    <div class="card">
                      <article>
                        <h4>
                          <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                        </h4>

                        <h6><a href="#">{{ $thread->creator->name }}</a></h6>

                        <strong>{{ $thread->created_at->diffForHumans() }}</strong>
                        <p>
                          {{ $thread->body }}
                        </p>
                        <p style="text-align:right;padding-right:10px">{{ $thread->replies_count }} {{str_plural('reply', $thread->replies_count)}}</p>
                      </article>
                    </div>

                    <hr>
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
