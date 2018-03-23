@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <a href="#">{{ $thread->creator->name }}</a><strong>{{ $thread->title }}</strong></div>

                <div class="card-body">
                  {{ $thread->body }}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
          @foreach ( $thread->replies as $reply )
            @include ('threads.reply')
          @endforeach
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
          <form action="/threads/{thread}/replies" method="POST">
              {{ csrf_field() }}
              <div class="form-group">
                <textarea placeholder="Comment here..." name="body" rows="8" cols="80" class="form-control"></textarea>
              </div>
              <button type="submit" class="btn btn-default">Post</button>
          </form>
        </div>
    </div>

</div>
@endsection
