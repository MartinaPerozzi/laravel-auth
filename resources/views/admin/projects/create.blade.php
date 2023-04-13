@extends('layouts.app')

@section('title')
    <div class="container">
        <h2>Create new content</h2>
    </div>
@endsection

@section('content')
    <div class="form-add container mt-4">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype=“multipart/form-data”>
            @csrf

            <label for="title" class="form-label ">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title') }}" />
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <label for="text" class="form-label">Text</label>
            <input type="text" class="form-control @error('album') is-invalid @enderror" id="album" name="text"
                value="{{ old('text') }}" />
            @error('text')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                value="{{ old('image') }}" />
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary mt-3">Salva</button>
        </form>
    @endsection

    @section('actions')
        <div class="container mt-3">
            <a class="btn btn-primary mb-3" href="{{ route('admin.projects.index') }}">Go Back</a>
        </div>
    @endsection
