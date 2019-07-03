<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::whereNull('status')->get();
        $users = User::where('role', 'developer')->get();
        return view('tasks', compact('tasks', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new-task');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = Carbon::now();
        $request->validate([
            'title' => 'required|unique:tasks|max:255',
            'description' => 'required',
            'deadline' => 'required|date|after:' . $date
        ]);

        $task = new Task();
        $task->fill($request->all());
        $task->save();

        return redirect()->route('tasks.create');
    }

    public function userTask(Request $request)
    {
        $user = Auth::user();

        foreach ($request->developer as $developer) {
            $user->managerTask()->attach($request->task, ['developer_id' => $developer]);
        }

        Task::find($request->task)->update(['status' => 'assigned']);

        return redirect()->back();
    }

    public function assignedTasks()
    {
        $tasks = Auth::user()->managerTask()->get()->unique('id');

        return view('assigned-tasks', compact('tasks'));
    }

    public function developerTasks()
    {
        $tasks = Auth::user()->developerTask()->get();
        return view('developers-tasks', compact('tasks'));
    }

    public function taskStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required'
        ]);

        if($task->status == 'done') {
            return response()->json(['status' => 'error']);
        }

        if($task->update(['status' => $request->status])) {
           return response()->json(['status' => 'success']);
        } else {
           return response()->json(['status' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
