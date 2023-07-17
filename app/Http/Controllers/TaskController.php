<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            Task::create($request->post());

            return response()->json([
                'message' => 'Task Created Successfully!!'
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Something goes wrong while creating the task!!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);
        return response()->json([
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function markTaskCompleted(Request $request, string $id)
    {
        // Find the resource by ID
        $task = Task::findOrFail($id);

        // Update the resource properties based on the request data
        $task->completedAt = date('c');

        $task->save();

        // Return a response indicating the successful update
        return response()->json(['message' => 'Task updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Task::find($id)->delete();
            return response()->json([
                'message' => 'Task deleted with success!!'
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Something goes wrong while deleting the task!!'
            ], 500);
        }
    }
}
