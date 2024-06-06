<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();
        $projects = Project::where('type_id', $id)->get();
        //dd($projects);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        //dd($form_data);
        $form_data['slug'] = Project::generateSlug($form_data['title']);
        $form_data['type_id'] = Auth::id();
        
        $newProject = Project::create($form_data);
             
        return redirect()->route('admin.projects.show', $newProject->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $projects)
    {
        //dd($projects);
        $project = $projects;
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $projects)
    {
        $project = $projects;
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectrequest $request, Project $projects)
    {
        $project = $projects;
        $form_data = $request->all();
        $form_data['user_id'] = Auth::id();
        if ($project->title !== $form_data['title']) {
            $form_data['slug'] = Project::generateSlug($form_data['title']);
        }
        $project->update($form_data);
        return redirect()->route('admin.projects.show', $project->slug);

        /*$request->validate([
            'title' => 'required|max: 200',
            'image' => 'nullable|image|max: 255',
            'content' => 'nullable'
        ]);

        $project->update($request->all());
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');*/
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $projects)
    {
        $project = $projects;
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
