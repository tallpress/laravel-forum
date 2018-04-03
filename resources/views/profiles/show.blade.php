@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $profileUser->name }}</div>
                <div class="card-body">
                  <h6>{{ "Past activities" }}</h6>
                  <br>

                  @foreach ($activities as $date => $activity)
                     <h3>{{ $date }}</h3>
                    @foreach ($activity as $record)
                        @include ("profiles.activities.{$record->type}", ['activity' => $record])
                    @endforeach
                  @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
