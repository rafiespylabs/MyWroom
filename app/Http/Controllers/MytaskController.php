<?php

namespace App\Http\Controllers;

use App\Models\Tbl_mw_mytasks;
use App\Models\Tbl_mw_statuses;
use App\Models\Tbl_mw_tasks;
use App\Models\Tbl_mw_worktimes;
use App\Models\Tbl_staffs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MytaskController extends Controller
{
    public function index()
    {
        $user_id=Auth::user()->id;
        $mytasks = Tbl_mw_mytasks::with(['addedByUser','editedByUser','task','status','worktime','user'])
        ->where('user_id',$user_id)
        ->whereDate('added_date',Carbon::now())
        ->get();
        $task = Tbl_mw_tasks::all();
        $status = Tbl_mw_statuses::all();       
        $worktime = Tbl_mw_worktimes::all();
        $user = Tbl_staffs::with('user')->get();
        return view('admin.mytasks', [
            'mytasks' => $mytasks,
            'task' => $task,
            'status' => $status,
            'worktime' => $worktime,
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'task_id' => 'required|integer|exists:tbl_mw_tasks,id',
            'task_status_id' => 'required|integer|exists:tbl_mw_statuses,id',
            'task_status_date' => 'required',
            'worktime_id' => 'required|integer|exists:tbl_mw_worktimes,id',
            'user_id' => 'required|integer|exists:tbl_staffs,id',       
        ]);

        try {

            $status = Tbl_mw_statuses::find($validatedData['task_status_id']);
            $mytasks = new Tbl_mw_mytasks();
            $mytasks->task_id = $validatedData['task_id'];  
            $mytasks->task_status_id = $validatedData['task_status_id'];             
            $mytasks->task_status_date = $status && $status->added_date
                ? Carbon::parse($status->added_date)->format('Y-m-d H:i:s')
                : Carbon::now()->format('Y-m-d H:i:s');
            $mytasks->worktime_id = $validatedData['worktime_id'];  
            $mytasks->user_id = $validatedData['user_id'];   
            $mytasks->addedby = Auth::user()->id;           
            $mytasks->added_date = Carbon::now();          
            $mytasks->save();

            $task = Tbl_mw_tasks::find($validatedData['task_id']);
            $mytasks->task = $task->task;

            $status = Tbl_mw_statuses::find($validatedData['task_status_id']);
            if ($status) {
                $mytasks->task_status = $status->status;
                $mytasks->task_status_date = $status->added_date; 
            } else {
                return response()->json(['success' => false, 'message' => 'Invalid task status ID.']);
            }

            $worktime = Tbl_mw_worktimes::find($validatedData['worktime_id']);
            $mytasks->worktime = $worktime->worktime;

            $user = Tbl_staffs::find($validatedData['user_id']);
            $mytasks->user_id = $user->user_id;
            
            return response()->json([
                'success' => true,
                'message' => 'My task created successfully',
                'data' => [
                    'id' => $mytasks->id,
                    'task' => $task ? $task->task : null,
                    'task_status' => $status ? $status->status : null,
                    'task_status_date' => $status ? $status->added_date : null,
                    'worktime' => $worktime ? $worktime->worktime : null,
                    'user_id' => $user ? $user->user_id : null,                    
                    'addedby' => optional($mytasks->addedByUser)->name,
                    'added_date' => $mytasks->added_date,
                    'editedby' => optional($mytasks->editedByUser)->name, 
                    'edited_date' => $mytasks->edited_date,
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
            'mytasks_id' => 'required|exists:tbl_mw_mytasks,id',
        ]);
        $mytask = Tbl_mw_mytasks::with('task','status','worktime','user')->find($request->mytasks_id);
        if (!$mytask) {
            return response()->json(['success' => false, 'message' => 'My Task not found'], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $mytask
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_mw_mytasks,id',
            'task_id' => 'required|integer|exists:tbl_mw_tasks,id',
            'task_status_id' => 'required|integer|exists:tbl_mw_statuses,id',
            'task_status_date' => 'required',
            'worktime_id' => 'required|integer|exists:tbl_mw_worktimes,id',
            'user_id' => 'required|integer|exists:users,id',
            
        ]);
        $status = Tbl_mw_statuses::find($validatedData['task_status_id']);
        $mytasks = Tbl_mw_mytasks::find($validatedData['id']);
        $mytasks->task_id = $validatedData['task_id'];
        $mytasks->task_status_id = $validatedData['task_status_id'];
        $mytasks->task_status_date = $status && $status->added_date
            ? Carbon::parse($status->added_date)->format('Y-m-d H:i:s')
            : Carbon::now()->format('Y-m-d H:i:s');
        $mytasks->worktime_id = $validatedData['worktime_id'];
        $mytasks->user_id = $validatedData['user_id'];
        $mytasks->editedby = Auth::user()->id;
        $mytasks->edited_date = Carbon::now();             
        $mytasks->save();
        $task = Tbl_mw_tasks::find($validatedData['task_id']);
        $mytasks->task = $task->task;
        $status = Tbl_mw_statuses::find($validatedData['task_status_id']);
        if ($status) 
        {
            $mytasks->task_status = $status->status;
            $mytasks->task_status_date = $status->added_date; 
        } 
        else 
        {
            return response()->json(['success' => false, 'message' => 'Invalid task status ID.']);
        }
        $worktime = Tbl_mw_worktimes::find($validatedData['worktime_id']);
        $mytasks->worktime = $worktime->worktime;
        $user = User::find($validatedData['user_id']);       
        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'data' => [
                'id' => $mytasks->id,
                'task' => $task ? $task->task : null,
                'task_status' => $status ? $status->status : null,
                'task_status_date' => $status ? $status->added_date : null,
                'worktime' => $worktime ? $worktime->worktime : null,
                'user' => $user ? $user->name : null,  
                'addedby' => optional($mytasks->addedByUser)->name, 
                'added_date' => $mytasks->added_date,
                'editedby' => optional($mytasks->editedByUser)->name, 
                'edited_date' => $mytasks->edited_date,
            ],
        ]);
    }

    

    public function getStatusDate(Request $request)
    {
        $status = Tbl_mw_statuses::find($request->task_status_id);

        if ($status) {
            return response()->json([
                'success' => true,
                'task_status_date' => $status->added_date 
                    ? Carbon::parse($status->added_date)->format('Y-m-d H:i:s')
                    : Carbon::now()->format('Y-m-d H:i:s')
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Status not found']);
        }
    }


    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_mw_mytasks,id',
        ]);

        $mytasks = Tbl_mw_mytasks::find($validatedData['id']);
        if (!$mytasks) {
            return response()->json([
                'success' => false,
                'message' => 'My Task not found',
            ], 404);
        }
        $mytasks->delete();

        return response()->json([
            'success' => true,
            'message' => 'My Task deleted successfully',
        ]);
    } 
    public function statusUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_mw_mytasks,id',
            'task_status_id' => 'required|integer|exists:tbl_mw_statuses,id',
            'comment' => 'nullable|string',
        ]);
        $mytask = Tbl_mw_mytasks::find($validatedData['id']);
        $mytask->task_status_id =$validatedData['task_status_id'];
        $mytask->task_status_date = Carbon::now()->format('Y-m-d H:i:s');
        $mytask->comment =$validatedData['comment'];
        $mytask->save();
        return response()->json([
            'success' => true,
             'data'=>$mytask,
            'message' => 'Task Status Changed Successfully',
        ]);
    }
    
}
