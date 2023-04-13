@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-primary mt-3 mb-3" href="{{ route('welcome') }}"> Go Back</a>
        <h2>{{ $project->title }}</h2>
        <p>{{ $project->text }}</p>
        <img src="{{ $project->image }}" alt="Project Image">
        {{-- @dump($project) --}}
    </div>
@endsection
