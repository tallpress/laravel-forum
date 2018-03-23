@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a thread</div>

                <div class="card-body">
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                        @if (auth()->check())
                        <form action="/threads" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label for="title">Title: </label>
                              <input type="text" name="title" class="form-control">

                              <label for="body">Body: </label>
                              <textarea name="body" rows="8" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </form>
                        @else
                        <p>Please <a href="{{ route('login') }}">sign in</a> to publish a new thread</p>
                        @endif
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
