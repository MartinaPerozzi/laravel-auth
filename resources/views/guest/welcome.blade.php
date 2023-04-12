@extends('layouts.app')
@section('content')
    <div class="container">
        <h2> Projects </h2>
        <div class="row row-cols-4 justify-content-center">
            @forelse ($projects as $project)
                <div class="col mb-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ $project->image }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            <p class="card-text">{{ $project->getAbstract(10) }}</p>
                            <a href="{{ route('detail', $project) }}" class="btn btn-primary">See More</a>
                        </div>
                    </div>
                </div>
            @empty
                <h4>No Projects found</h4>
            @endforelse
        </div>
    </div>


    </div>

    </div>
@endsection
