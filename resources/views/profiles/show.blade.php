@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $profileUser->name }}</div>
                <div class="card-body">
                  <h6>{{ $profileUser->name . "\'s threads" }}</h6>
                  <br>
                  @foreach ($threads as $thread)
                    <div class="card">
                        <div class="card-header">
                          <strong>
                            <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                          </strong> was published by {{ $thread->creator->name }}
                          {{$thread->created_at->diffForHumans()}}
                        </div>
                        <div class="card-body">
                          {{ $thread->body }}
                        </div>
                    </div>
                  @endforeach
                  {{ $threads->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
