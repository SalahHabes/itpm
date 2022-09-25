<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Project;
use App\Task;
use App\Http\Controllers\Auth;


class ProjectsController extends Controller
{
        public function __construct(){
            $this->middleware('auth');
        }

        public function index(){
            $user = auth()->user();
            if ($user->isEmployee()){
                return redirect('/');
            }

            $projects = Project::select('id', 'name', 'created_at')
                ->where('id_manager', '=', $user->id)
                ->orderBy('updated_at', 'desc')
                ->search()->paginate(7);

            $results = json_decode($projects, true);
            return view('projects.index', [
                'projects' => $projects,
            ]);
        }

        public function create() {
            $user = auth()->user();
            if ($user->isEmployee()){
                return redirect('/');
            }
            return view('projects.create');
        }
        
        public function store(Request $request) {
            $user = auth()->user();
            if ($user->isEmployee()){
                return redirect('/');
            }
            $this->validate($request,[
                'name' => ['required', 'string', 'max:30'],
                'description' => ['max:65535'],
            ]);

            $project = new Project();
            $project->name = request('name');
            $project->description = request('description');
            
            $project->id_manager = $user->id;

            //error_log($project);
            $project->save();
            
            return redirect('/projects/'.$project->id)->with('createproject','Project created successfully');
        }

        public function show($id) {
            $user = auth()->user();
            if ($user->isEmployee()){
                return redirect('/');
            }
            $project = Project::findOrFail($id);
            $tasks = Task::where('id_project', '=', $id)
                ->orderBy('bdate', 'asc')
                ->select('id', 'name', 'bdate', 'edate', 'fdate')->search()->paginate(15);

            $employees = $user->myEmployees($user->id)->get();
            
            $data['project'] = $project;
            $data['tasks'] = $tasks;
            $data['employees'] = $employees;
            
            return view('projects.tasks.index', ['data' => $data]);
        }

        public function edit($id) {
            $user = auth()->user();
            if ($user->isEmployee()){
                return redirect('/');
            }
            $project = Project::findOrFail($id);
            return view('/projects/update')->with('project' , $project);
        }

        public function update(Request $request, $id) {
            $user = auth()->user();
            if ($user->isEmployee()){
                return redirect('/');
            }
            $this->validate($request,[
                'name' => ['required', 'string', 'max:30'],
                'description' => ['max:65535'],
            ]);

            $project = Project::findOrFail($id);
            $project->name = $request->input('name');
            $project->description = $request->input('description');

            $project->save();

            return redirect('/projects/'.$project->id)->with('editsuccess','Project edited');
        }
        
        public function destroy($id) {
            $user = auth()->user();
            if ($user->isEmployee()){
                return redirect('/');
            }

            $project = Project::findOrFail($id);
            $project->delete();

            return redirect('/projects');
        }
}
