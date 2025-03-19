<?php

namespace App\Http\Controllers;

use App\Models\Tbl_chapter;
use App\Models\Tbl_mw_mytask_trans;
use App\Models\Tbl_mw_mytasks;
use App\Models\Tbl_mw_statuses;
use App\Models\Tbl_mw_tasks;
use App\Models\Tbl_mw_worktimes;
use App\Models\Tbl_staffs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MytasktransController extends Controller
{
    public function index($mytask_id)
    {
        $mytasktrans=Tbl_mw_mytask_trans::
        with(['addedByUser','editedByUser','task','mytask.task', 'mytask.status','worktime','chapter','user'])
        ->where('mytask_id',$mytask_id)
        ->get();
        $task = Tbl_mw_tasks::all();
        $mytask = Tbl_mw_mytasks::all();
        $status = Tbl_mw_statuses::all();
        $worktime = Tbl_mw_worktimes::all();
        $chapter = Tbl_chapter::all();
        $user = Tbl_staffs::all();
        $statuses = Tbl_mw_statuses::all();
        return view('admin.mytasktrans', [
            'mytasktrans' => $mytasktrans,
            'task' => $task,
            'mytask' => $mytask,
            'status' => $status,
            'worktime' => $worktime,
            'chapter' => $chapter,
            'user' => $user,
            'mytask_id'=>$mytask_id,
            'statuses'=>$statuses
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([            
            'mytask_id' => 'required|integer|exists:tbl_mw_mytasks,id',
            'worktime_id' => 'required|integer|exists:tbl_mw_worktimes,id',
            'task_date' => 'required|date',
            'chapter_id' => 'required|integer|exists:tbl_chapters,id',
            'sub_task_status_id'=>'required|integer|exists:tbl_mw_statuses,id',
            'remarks' => 'nullable|string|max:100',
        ]);
        try {
            $mytasktrans = new Tbl_mw_mytask_trans();            
            $mytasktrans->mytask_id = $validatedData['mytask_id'];  
            $mytasktrans->worktime_id = $validatedData['worktime_id'];   
            $mytasktrans->task_date = $validatedData['task_date'];
            $mytasktrans->chapter_id = $validatedData['chapter_id'];  
            $mytasktrans->remarks = $validatedData['remarks'];              
            $mytasktrans->sub_task_status_id = $validatedData['sub_task_status_id'];   
            $mytasktrans->addedby = Auth::user()->id;           
            $mytasktrans->added_date = Carbon::now();          
            $mytasktrans->save();
            
            $mytask = Tbl_mw_mytasks::find($validatedData['mytask_id']);
            $mytasktrans->mytask = $mytask->id;

            $worktime = Tbl_mw_worktimes::find($validatedData['worktime_id']);
            $mytasktrans->worktime = $worktime->worktime;

            $chapter = Tbl_chapter::find($validatedData['chapter_id']);
            $mytasktrans->chapter_name = $chapter->chapter_name;   

            
            $added_user = User::find(Auth::user()->id);
            $mytasktrans->addedby = $added_user->name;   

            $status=Tbl_mw_statuses::find($validatedData['sub_task_status_id']);
            $mytasktrans->status= $status->status;   

            return response()->json([
                'success' => true,
                'message' => 'task created successfully',
                'data' => [
                    'id' => $mytasktrans->id,
                    'task' => $mytask ? $mytask->task : null,
                    'task_date' => $mytask ? $mytask->added_date : null,
                    'worktime' => $worktime ? $worktime->worktime : null,
                    'chapter_name' => $chapter ? $chapter->chapter_name : null,
                    'remarks' => $mytasktrans->remarks,
                    'status' => $status ? $status->status : null,
                    'addedby' =>  $added_user->name, 
                    'added_date' => $mytasktrans->added_date,
                    'editedby' => optional($mytasktrans->editedByUser)->name, 
                    'edited_date' => $mytasktrans->edited_date,
                ]
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
            'id' => 'required|exists:tbl_mw_mytask_trans,id',
        ]);
        $mytasktrans = Tbl_mw_mytask_trans::with('task','mytask','worktime','chapter','user')->find($request->id);
        if (!$mytasktrans) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }
        return response()->json([
            'success' => true,
            'data' => [
               'task' => $mytasktrans->mytask->task->task,
                    'task_date' => $mytasktrans->mytask->added_date,
                    'worktime' => $mytasktrans->worktime->worktime,
                    'chapter' => $mytasktrans->chapter->chapter,
                    'remarks' => $mytasktrans->remarks,
                    'status' => $mytasktrans->mytask->status->status,
                    'user_id' => $mytasktrans->user->user_id,    
            ]
        ]);
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_mw_mytask_trans,id',
            'task_id' => 'integer|exists:tbl_mw_tasks,id',
            'mytask_id' => 'required|integer|exists:tbl_mw_mytasks,id',
            'worktime_id' => 'required|integer|exists:tbl_mw_worktimes,id',
            'task_date' => 'required',
            'chapter_id' => 'required|integer|exists:tbl_chapters,id',
            'remarks' => 'required|string|max:100', 
            'sub_task_status_id' => 'required|integer|exists:tbl_mw_statuses,id',
            'user_id' => 'required|integer|exists:tbl_staffs,id',   
            
        ]);
        $mytasktrans = Tbl_mw_mytask_trans::find($validatedData['id']);
        $mytasktrans->task_id = $validatedData['task_id'];  
        $mytasktrans->mytask_id = $validatedData['mytask_id'];  
        $mytasktrans->worktime_id = $validatedData['worktime_id'];  
        $mytasktrans->task_date = $validatedData['task_date'];  
        $mytasktrans->chapter_id = $validatedData['chapter_id'];  
        $mytasktrans->remarks = $validatedData['remarks'];  
        $mytasktrans->sub_task_status_id = $validatedData['sub_task_status_id'];   
        $mytasktrans->user_id = $validatedData['user_id'];
        $mytasktrans->editedby = Auth::user()->id;
        $mytasktrans->edited_date = Carbon::now();             
        $mytasktrans->save();
        $task = Tbl_mw_tasks::find($validatedData['task_id']);
        if ($task) {
            $mytasktrans->task = $task->task;
            $mytasktrans->task_date = $task->added_date; 
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid task ID.']);
        }

        $mytask = Tbl_mw_mytasks::find($validatedData['mytask_id']);
        $mytasktrans->sub_task_status_id = $mytask->sub_task_status_id;

        $worktime = Tbl_mw_worktimes::find($validatedData['worktime_id']);
        $mytasktrans->worktime = $worktime->worktime;

        $chapter = Tbl_chapter::find($validatedData['chapter_id']);
        $mytasktrans->chapter = $chapter->chapter;

        $status = Tbl_mw_statuses::find($validatedData['sub_task_status_id']);
        $mytasktrans->status = $status->status;

        $user = Tbl_staffs::find($validatedData['user_id']);
        $mytasktrans->staff = $user->user_id;
        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'data' => [
                'id' => $mytasktrans->id,
                    'task' => $task ? $task->task : null,
                    'task_date' => $task ? $task->added_date : null,
                    'worktime' => $worktime ? $worktime->worktime : null,
                    'chapter' => $chapter ? $chapter->chapter : null,
                    'remarks' => $mytasktrans->remarks,
                    'status' => $status ? $status->status : null,
                    'user_id' => $user ? $user->user_id : null,                    
                    'addedby' => optional($mytasktrans->addedByUser)->name, 
                    'added_date' => $mytasktrans->added_date,
                    'editedby' => optional($mytasktrans->editedByUser)->name, 
                    'edited_date' => $mytasktrans->edited_date,
            ],
        ]);
    }
    public function getTaskDetails(Request $request)
    {
        $mytask = Tbl_mw_mytasks::with('status')->find($request->mytask_id);
        if (!$mytask) {
            return response()->json(['success' => false, 'message' => 'Task not found']);
        }
        return response()->json([
            'success' => true,
            'task_date' => $mytask->task->added_date ?? null, 
            'task_status' => $mytask && $mytask->status ? $mytask->status->status : 'No Status Found',
        ]);
    }
    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_mw_mytask_trans,id',
        ]);
        $mytasktrans = Tbl_mw_mytask_trans::find($validatedData['id']);
        if (!$mytasktrans) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found',
            ], 404);
        }
        $mytasktrans->delete();
        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully',
        ]);
    } 

}
