<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    // La funzione che era in web.php dove ho sostituito con l'AdminHomeController::class
    public function index()
    {
        $projects = Project::paginate(12);
        return view('guest.welcome', compact('projects'));
    }

    public function show(Project $project)
    {
        return view('guest.show', compact('project'));
    }

    // public function show()
    // {
    //     $project = Project::all();

    //     return view('guest.show', compact('project'));
    // }
}
