<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Task;
use App\Project;
use App\AssociationTask;
use App\DependencyTask;
use Carbon\Carbon;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        //  Getting the project name
        $project = Project::findOrFail($task->id_project);

        //  Getting the Employees assigned to this Task
        $id_assigned_emp = DB::table('associationtask')
            ->select('id_employee')
            ->where('id_task', '=', $id);
        $assigned_emp = DB::table('users')
            ->joinSub($id_assigned_emp, 'assigned_emp', function ($join) {
                $join->on('users.id', '=', 'assigned_emp.id_employee');
            })->select('id', 'name', 'email')->get();
        $assigned_emp = json_decode($assigned_emp, true);

        //  Getting the Tasks that this Task is depandant on
        $id_held_back_by = DB::table('dependencytask')
            ->select('id_priority')
            ->where('id_dependant', '=', $id);
        $held_back_by = DB::table('tasks')
            ->joinSub($id_held_back_by, 'held_back_by', function ($join) {
                $join->on('tasks.id', '=', 'held_back_by.id_priority');
            })->select('id', 'name')->get();
        $held_back_by = json_decode($held_back_by, true);

        //  Getting the Tasks depandant on this Task
        $id_holding_back = DB::table('dependencytask')
            ->select('id_dependant')
            ->where('id_priority', '=', $id);
        $holding_back = DB::table('tasks')
            ->joinSub($id_holding_back, 'holding_back', function ($join) {
                $join->on('tasks.id', '=', 'holding_back.id_dependant');
            })->select('id', 'name')->get();
        $holding_back = json_decode($holding_back, true);

        return view(
            'projects.tasks.show',
            [
                'task' => $task,
                'project' => $project,
                'assigned_emp' => $assigned_emp,
                'held_back_by' => $held_back_by,
                'holding_back' => $holding_back
            ]
        );
    }

    public function store(Request $request, $id)
    {
        $user = auth()->user();
        if ($user->isEmployee()) {
            return redirect('/');
        }
        $this->validate($request, [
            'name' => ['required', 'string', 'max:30'],
            'description' => ['max:65535'],
            'filelink' => ['max:255'],
            'bdate' => ['required'],
            'edate' => ['required'],
            'emp' => ['required'],
        ]);

        if (request('edate') < request('bdate')) {
            return redirect('/projects/' . $id)->with('addtaskfail', 'End date can not be prior to Begin date, task not saved');
        }

        if (request('ptasks') <> null) {
            foreach (request('ptasks') as $idp) {
                $ptask = Task::select('id', 'edate', 'fdate')
                    ->where('id', '=', $idp)
                    ->first();
                if (!(request('bdate') >= $ptask->edate)) { //optionally add finish date condition
                    return redirect('/projects/' . $id)->with('addtaskfailp', 'Begin date of new task can not be prior to End date of prioritized task, task not saved.');
                }
            }
        }

        $task = new Task();
        $task->name = request('name');
        $task->description = request('description');
        $task->filelink = request('filelink');
        $task->bdate = request('bdate');
        $task->edate = request('edate');
        $task->id_project = $id;
        $task->save();

        $ptasks = request('ptasks');
        if ($ptasks <> null) {
            foreach ($ptasks as $pt) {
                $dependancytask = new DependencyTask();
                $dependancytask->id_dependant = $task->id;
                $dependancytask->id_priority = $pt;
                $dependancytask->save();
            }
        }
        $emp = request('emp');
        foreach ($emp as $e) {
            $associationtask = new AssociationTask();
            $associationtask->id_task = $task->id;
            $associationtask->id_employee = $e;
            $associationtask->save();
        }

        return redirect('/projects/' . $id)->with('addtasksuccess', 'Task added successfully');
    }

    public function destroy($idp, $idt)
    {
        $user = auth()->user();
        if ($user->isEmployee()) {
            return redirect('/');
        }

        $task = Task::findOrFail($idt);
        $task->delete();

        return redirect('/projects/' . $idp)->with('deletetasksuccess', 'Task deleted successfully');
    }

    public function mytasks()
    {
        $user = auth()->user();
        $asso = DB::table('associationtask')
            ->select('id_task')
            ->where('id_employee', '=', $user->id);
        $tasks = Task::select('id', 'name', 'bdate', 'edate', 'fdate')
            ->joinSub($asso, 'tasks', function ($join) {
                $join->on('tasks.id', '=', 'tasks.id_task');
            })->search()->paginate(15);

        return view('projects.tasks.mytasks', [
            'tasks' => $tasks,
        ]);
    }

    public function markfinished(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->fdate = Carbon::now()->toDateString();
        if (request("filelink") <> null) {
            $task->filelink = request('filelink');
        }
        $task->save();
        return redirect('/projects/tasks/' . $id)->with('marked', 'Task marked as done');
    }

    public function unmarkfinished($id)
    {
        $task = Task::findOrFail($id);
        $task->fdate = null;
        $task->save();
        return redirect('/projects/tasks/' . $id)->with('unmarked', 'Task marked as ongoing');
    }

    public function edit($id)
    {
        $user = auth()->user();
        if ($user->isEmployee()) {
            return redirect('/');
        }

        $task = Task::findOrFail($id);

        $user = auth()->user();
        $employees = $user->myEmployees($user->id)->select('id', 'name', 'email')->get();

        $tasks = Task::select('id', 'name', 'edate')
            ->where('id_project', '=', $task->id_project)
            ->get();

        return view(
            'projects.tasks.update',
            [
                'task' => $task,
                'employees' => $employees,
                'tasks' => $tasks
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        if ($user->isEmployee()) {
            return redirect('/');
        }
        $this->validate($request, [
            'name' => ['required', 'string', 'max:30'],
            'description' => ['max:65535'],
        ]);

        if (request('ptasks') <> null) {
            foreach (request('ptasks') as $idp) {
                $ptask = Task::select('id', 'edate', 'fdate')
                    ->where('id', '=', $idp)
                    ->first();
                if (!(request('bdate') >= $ptask->edate)) {
                    return redirect('/projects/tasks/edit/' . $id)->with('addtaskfailp', 'Begin date of new task can not be prior to End date of prioritized task, task not saved.');
                }
            }
            $ptasks = request('ptasks');
            foreach ($ptasks as $pt) {
                $ptaskcheck = DependencyTask::where('id_priority', '=', $pt)
                    ->where('id_dependant', '=', $id)
                    ->get('id');
                if ($ptaskcheck->isEmpty()) {
                    $dependancytask = new DependencyTask();
                    $dependancytask->id_dependant = $id;
                    $dependancytask->id_priority = $pt;
                    $dependancytask->save();
                }
            }
        }

        if ($request->input('emp') <> null) {
            $association = DB::table('associationtask')
                ->where('id_task', '=', $id)
                ->delete();

            $emp = request('emp');
            foreach ($emp as $e) {
                $associationtask = new AssociationTask();
                $associationtask->id_task = $id;
                $associationtask->id_employee = $e;
                $associationtask->save();
            }
        }

        if (request('edate') < request('bdate')) {
            return redirect('/projects/tasks/edit/' . $id)->with('edittaskfail', 'Conflicting data: End date can not be prior to Begin date, task not saved.');
        }

        $task = Task::findOrFail($id);
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->filelink = $request->input('filelink');
        $task->bdate = request('bdate');
        $task->edate = request('edate');
        $task->save();

        return redirect('/projects/tasks/' . $task->id)->with('teditsuccess', 'Task edited');
    }
}
