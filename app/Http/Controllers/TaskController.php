<?php

namespace App\Http\Controllers;

use App\Models\Tbl_departments;
use App\Models\Tbl_mw_tasks;
use App\Models\Tbl_mw_worktimes;
use App\Models\Tbl_staffs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        $tasks=Tbl_mw_tasks::with(['addedByUser','editedByUser','department','staff'])->get();
        $department = Tbl_departments::all();
        $user = Tbl_staffs::with('user')->get();
        return view('admin.tasks', [
            'tasks' => $tasks,
            'department' => $department,
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dep_id' => 'required|integer|exists:tbl_departments,id',
            'user_id' => 'required|integer|exists:tbl_staffs,user_id',
            'task' => 'required|max:1000',           
        ]);

        try {
            $tasks = new Tbl_mw_tasks();
            $tasks->dep_id = $validatedData['dep_id'];  
            $tasks->user_id = $validatedData['user_id'];  
            $tasks->task = $validatedData['task'];   
            $tasks->addedby = Auth::user()->id;           
            $tasks->added_date = Carbon::now();          
            $tasks->save();

            $department = Tbl_departments::find($validatedData['dep_id']);
            $tasks->department = $department->department;

            $user = User::find($validatedData['user_id']);
            $tasks->staff_name = $user->name;

            $tasks->added_user = Auth::user()->name;
            $tasks->editedby ='';
            return response()->json([
                'success' => true,
                'message' => 'task created successfully',
                'data' => $tasks
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create task: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tbl_mw_tasks,id',
        ]);
        $tasks = Tbl_mw_tasks::with('department','staff')->find($request->id);
        if (!$tasks) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }
        return response()->json([
            'success' => true,
            'data' => [
                'task' => $tasks->task ,
                'dep_id' => $tasks->dep_id, 
                'user_id' => $tasks->staff->id, 
            ]
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_mw_tasks,id',
            'dep_id' => 'required|integer|exists:tbl_departments,id',
            'user_id' => 'required|integer|exists:tbl_staffs,user_id',
            'task' => 'required|max:1000',
            
        ]);

        $tasks = Tbl_mw_tasks::find($validatedData['id']);
        $tasks->dep_id = $validatedData['dep_id'];
        $tasks->user_id = $validatedData['user_id'];
        $tasks->task = $validatedData['task']; 
        $tasks->editedby = Auth::user()->id;
        $tasks->edited_date = Carbon::now();             
        $tasks->save();

        $department = Tbl_departments::find($validatedData['dep_id']);
        $tasks->department = $department->department;

        $user = User::find($validatedData['user_id']);
        $tasks->staff_name = $user->name;
        $tasks->editedby=Auth::user()->name;

        $staff_user = User::find($tasks->addedby);
        $tasks->added_user=$staff_user->name;
        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'data' =>$tasks,
        ]);
    }
    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_mw_tasks,id',
        ]);

        $tasks = Tbl_mw_tasks::find($validatedData['id']);
        if (!$tasks) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }
        $tasks->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully',
        ]);
    } 

}
