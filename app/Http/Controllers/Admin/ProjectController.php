<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $projects = Project::all(); senza paginazione
        // $projects = Project::paginate(10); con paginazione
        // $projects = Project::orderBy('updated_at')->paginate(10); con ordine ultima modifica

        // SORT & ORDER
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : 'updated_at';
        $order = (!empty($order_request = $request->get('order'))) ? $order_request : 'DESC';

        $projects = Project::orderBy($sort, $order)->paginate(10)->withQueryString();

        return view('admin.projects.index', compact('projects', 'sort', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  AGGIUNGO LA ROTTA CREATE
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request->all());
        // Gestione dello SLUG- PARTE 1 in Model Project.php
        $project = new Project;
        $project->fill($request->all());
        $project->slug = Project::generateUniqueSlug($project->title);
        $project->save();
        return to_route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // ROTTA SHOW!
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $this->validation($request->all(), $project->id);

        $project->fill($request->all());
        $project->slug = Project::generateUniqueSlug($project->title);
        $project->save();

        return to_route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index');
    }

    private function validation($data)
    {
        $validator = Validator::make(
            $data,
            [
                'title' => 'required|string|max:50',
                'text' => 'string|max:100',
                "img" => 'nullable|string',

            ],
            [
                'title.required' => 'The Title is required',
                'title.string' => 'The title must be a string',
                'title.max' => 'The max length of the title must be 50 characters',

                'text.string' => 'The text must be a string',
                'text.max' => 'The max length of the text must be 100 characters',

                'img.string' => 'The image must be a string, please insert a valide url',
            ]
        )->validate();
        return $validator;
    }
}
