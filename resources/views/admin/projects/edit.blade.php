@extends('layouts.app');

{{-- @section('title', $project->title); --}}
@section('actions')
    <div class="container mt-3">
        <a class="btn btn-primary mb-3" href="{{ route('admin.projects.index') }}">Go Back</a>
    </div>
@endsection


@section('content')
    <div class="container mt-2">

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <h4>Please correct the following mistakes: </h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.projects.update', $project) }}" method="POST">
            @method('PUT') @csrf

            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ $project->title }}" />
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <label for="album" class="form-label">Text</label>
            <input type="text" class="form-control @error('album') is-invalid @enderror" id="album" name="text"
                value="{{ $project->text }}" />
            @error('text')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <label for="img" class="form-label">Image</label>
            <input type="text" class="form-control @error('img') is-invalid @enderror" id="img" name="img"
                value="{{ $project->image }}" />
            @error('img')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary mt-4">Save</button>
        </form>
    </div>
@endsection
