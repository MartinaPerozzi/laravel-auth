@extends('layouts.app')

{{-- @section('title', $project->title); --}}
@section('actions')
    <div class="container mt-3">
        <a class="btn btn-primary mb-3" href="{{ route('admin.projects.index') }}">Go Back</a>
    </div>
@endsection


@section('content')
    <div class="container mt-2">
        {{-- Lista errori --}}
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

        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype=“multipart/form-data”>
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

            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                value="{{ $project->image }}" />
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="image-edit mt-3">
                <img src="{{ $project->getImageUri() }}" alt="Image">
            </div>

            <button type="submit" class="btn btn-primary mt-4 mb-4">Save</button>
        </form>
    </div>
@endsection
