@extends('layouts.app')

@section('actions')
    <div class="container mt-4 mb-3">
        <a class="btn btn-primary" href="{{ route('admin.projects.create') }}">Create new Project</a>
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
                            <a href="{{ route('admin.projects.edit', $project) }}"><i class="fa-solid fa-pen ms-3"></i></a>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $project->id }}">
                                <i class="fa-solid fa-trash-can ms-3 text-primary"></i>
                            </a>
                        </td>
                    </tr>

                @empty
                @endforelse

            </tbody>
        </table>
        {{-- PAGINATION --}}
        {{ $projects->links() }}
    </div>
    {{-- MODALE --}}
    @foreach ($projects as $project)
        <!-- Modal -->
        <div class="modal fade" id="delete-modal-{{ $project->id }}" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="delete-modal-{{ $project->id }}-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="delete-modal-{{ $project->id }}-label">Conferma eliminazione</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        Sei sicuro di voler eliminare la canzone <strong>{{ $project->title }}</strong> con ID
                        <strong> {{ $project->id }}</strong>? <br>
                        L'operazione non è reversibile!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="">
                            @method('delete')
                            @csrf

                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
