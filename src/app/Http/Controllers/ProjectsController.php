<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        // validate

        // persist
        $projects = Project::all();

        return view('index', compact('projects'));
        // redirect
    }

    public function store()
    {
        // validate
        request()->validate(['title' => 'required', "description" => "required"]);

        // persist
        Project::create(request(['title', 'description']));

        // redirect
        return redirect("/projects");
    }
}
