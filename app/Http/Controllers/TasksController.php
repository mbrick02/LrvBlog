<?php

namespace App\Http\Controllers;

// Laracast del this from stub: use Illuminate\Http\Request;
//  instead they use a call to the task:
use App\Task;

class TasksController extends Controller
{
  public function index()
  {
      $tasks = Task::all();

      return view('tasks.index', compact('tasks'));
  }

  //  public function show($id)  // $id arg is replace by wildcard sent
  public function show(Task $task) // thru route model binding task is derived from arg sent
  // wildcard name from route must match route model binding arg = Task::find(wildcard)
  {
    // $task = Task::find($id); // wilcard/arg as SQL 'where' condition (not rout modl bind)

    return view('tasks.show', compact('task'));
  }
}
