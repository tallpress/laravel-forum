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

                  @foreach ($activities as $activity)
                    @include ("profiles.activities.{$activity->type}")
                  @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
