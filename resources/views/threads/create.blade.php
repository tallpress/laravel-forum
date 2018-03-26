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
                              <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>

                              <label for="channel_id">Choose a channel</label>
                              <select class="form-control" name="channel_id" id="channel_id">
                                <option>Choose one...</option>
                                @foreach (App\Channel::all() as $channel)
                                <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                @endforeach
                              </select>

                              <label for="body">Body: </label>
                              <textarea name="body" rows="8" class="form-control" value="{{ old('body') }}" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </form>
                        @else
                        <p>Please <a href="{{ route('login') }}">sign in</a> to publish a new thread</p>
                        @endif

                        @if (count($errors))
                        <ul class='alert alert-danger'>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                        @endif
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
