<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Str;

class TaskController extends Controller
{

    public function create()
    {
        return view('create');
    }


    public function store()
    {
        \request()->validate([
            'title' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
        ]);

        Task::create
        ([
            'user_id' => \request()->user()->id,
            'title' => \request('title'),
            'body' => \request('body'),
            'starting_time' => \request('start_time'),
            'finishing_time' => \request('end_time'),
            'slug' => Str::slug(\request('title'), '-'),
            'status' => false,
            'completed_at' => null,
        ]);
        session()->flash('success', 'Task Added Successfully!');
        return to_route('manage');
    }

    public function index()
    {
//        $user = request()->user()->tasks();
        $sort = request('sort', 'created_at'); // get the sort parameter or use the default value 'created_at'
        $order = request('order', 'desc'); // get the order parameter or use the default value 'desc'
        $filter = request('filter', null); // get the filter parameter or use the default value null

        $tasks = Task::where('user_id', auth()->user()->id)
            ->whereDate('finishing_time', '>', now()->subWeek())
            ->orderBy($sort, $order);

        if($filter !== null)
            $tasks = $tasks->where('status', $filter);

        $tasks = $tasks->paginate(10);

        return view('manage',
        [
            'tasks' => $tasks
        ]);
    }

    public function destroy(Task $task)
    {
        // Find the task by its id
        $task = Task::where('id', $task->id)->firstOrFail();

        // Delete the task from the database
        $task->delete();

        // Redirect back to the manage view with a success message
        session()->flash('success', 'Task deleted successfully!');
        return to_route('manage');
    }

    public function edit(Task $task)
    {
        $task = Task::where('id', $task->id)->firstOrFail();
        return view('update', ["task" => $task]);
    }

    public function update(Task $task)
    {
        $task = Task::where('slug', $task->id)->firstOrFail();

        request()->validate([
            'title' => 'required',
            'starting_time' => 'required|date',
            'finishing_time' => 'required|date|after_or_equal:start_time',
            'status' => 'boolean',
        ]);

        $task->fill(request()->all());
        $task->completed_at = now();

        $task->save();

        session()->flash('success', 'Task Updated Successfully!');
        return to_route('manage');
    }

}
