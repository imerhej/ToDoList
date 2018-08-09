<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tasks');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'priority' => 'required'
        ]);

        $task = new Task();

        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;

        $task->save();

        return ['redirect' => route('tasks.index')];
    }

    public function getTasks()
    {
        return Task::orderBy('priority', 'ASC')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Task::findOrFail($id);
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
        $this->validate($request, [
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'priority' => 'required'
        ]);
        $task = Task::findOrFail($id);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;

        $task->save();

        return ['redirect' => route('tasks.index')];
    }

    public function updateCompleted($id)
    {

        $task = Task::findOrFail($id);
        if ($task->completed == 0) {
            $task->completed = 1;

            $task->save();
        } else if ($task->completed == 1) {
            $task->completed = 0;

            $task->save();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }
}
