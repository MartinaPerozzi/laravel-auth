@extends('layouts.app')

@section('actions')
    <div class="container">
        <a class="btn btn-primary" href="{{ route('admin.projects.create') }}">Create new</a>
    </div>
@endsection
@section('content')
    <div class="container">
        <h1 class="mb-3">Projects</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Abstract</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->getAbstract() }}</td>
                        <td>
                            <a href="{{ route('admin.projects.show', $project) }}"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>

                @empty
                @endforelse

            </tbody>
        </table>
        {{-- PAGINATION --}}
        {{ $projects->links() }}
    </div>
@endsection
