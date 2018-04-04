@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="page-header">
                <h1>
                    {{ $profileUser->name }}
                    <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                </h1>
            </div>

              <br>

              @foreach ($activities as $date => $activity)
                 <h3>{{ $date }}</h3>
                @foreach ($activity as $record)
                    @include ("profiles.activities.{$record->type}", ['activity' => $record])
                    <br>

                @endforeach
              @endforeach

        </div>
    </div>
</div>

@endsection
