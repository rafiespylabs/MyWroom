<?php

namespace App\Http\Controllers;

use App\Models\Tbl_mw_task_days;
use App\Models\Tbl_mw_tasks;
use App\Models\Tbl_mw_worktimes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskdayController extends Controller
{
    public function index($task_id='')
    {
        $tasks = Tbl_mw_tasks::select('id', 'task')->get();
        $worktimes = Tbl_mw_worktimes::select('id', 'worktime')->get();
        return view('admin.taskdays',['tasks'=>$tasks,'worktimes'=>$worktimes,'task_id'=>$task_id]);
    }


    public function list(Request $request)
    {
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        $task_id = $request->input('task_id', 0);
        $query = Tbl_mw_task_days::with(['addedByUser', 'editedByUser', 'task', 'worktime']);
         if($task_id)
         {
            $query->where('task_id',$task_id);
         }
        $totalFiltered = $query->count(); 

        $taskdays = $query->skip($start)
            ->take($limit)
            ->latest('id')
            ->get();

        $data = [];
        $slNo = $start + 1;
        foreach ($taskdays as $taskday) {
            $createdUser = $taskday->addedByUser->name ?? ' ';
            $editedUser = $taskday->edited_by ? ($taskday->editedByUser->name ?? '') : ''; 
            $createdDate = Carbon::parse($taskday->added_date)->tz('Asia/Kolkata')->format('d/m/Y h:i A');
            $editedDate = $taskday->edited_date 
            ? Carbon::parse($taskday->edited_date)->tz('Asia/Kolkata')->format('d/m/Y h:i A') 
            : '';

            $editButton = '<button class="btn btn-sm btn-primary edit_taskdays" onclick="edittaskdays('.$taskday->id.')" title="Edit">
                            <i class="fa fa-edit"></i>
                        </button>';
            $deleteButton = '<button class="btn btn-sm btn-danger delete_taskdays" onclick="deletetaskdays('.$taskday->id.')" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>';

            $data[] = [
                'sl_no' => $slNo++,
                'task' => $taskday->task->task ?? null,
                'worktime' => $taskday->worktime->worktime ?? null,
                'added_by' => $createdUser,
                'added_date' => $createdDate,
                'edited_by' => $editedUser,
                'edited_date' => $editedDate,
                'action' => $editButton . ' ' . $deleteButton,
                'id' => $taskday->id,
            ];
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalFiltered, 
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'task_id' => 'required|integer|exists:tbl_mw_tasks,id',  
            'worktime_id' => 'required|integer|exists:tbl_mw_worktimes,id',  
        ]);

        try {  

            $taskdays = new Tbl_mw_task_days();
            $taskdays->task_id  = $validatedData['task_id'];         
            $taskdays->worktime_id  = $validatedData['worktime_id'];              
            $taskdays->added_by = Auth::user()->id;           
            $taskdays->added_date = Carbon::now();             
            $taskdays->save();            
            
            return response()->json([
                'success' => true,
                'message' => 'Task day created successfully',
                'data' => [
                    'id' => $taskdays->id,
                    'task' => $taskdays->tasks->task ?? null,
                    'worktime' => $taskdays->worktimes->worktime ?? null,
                    'added_by' => $taskdays->added_by,
                    'added_date' => $taskdays->added_date,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create task day : ' . $e->getMessage(),
            ], 500);
        }
    }   

    public function edit($id)
    {
        $taskdays = Tbl_mw_task_days::with('task','worktime')->find($id);
        $tasks = Tbl_mw_tasks::select('id', 'task')->get();
        $worktimes = Tbl_mw_worktimes::select('id', 'worktime')->get();

        if (!$taskdays) {
            return response()->json(['error' => 'Task day not found'], 404);
        }

        return response()->json([
            'taskdays' => $taskdays, 
            'task' => $tasks,        
            'worktime' => $worktimes,
        ]);
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'task_id' => 'required|integer|exists:tbl_mw_tasks,id',  
            'worktime_id' => 'required|integer|exists:tbl_mw_worktimes,id', 
        ]);
        $taskdays = Tbl_mw_task_days::find($id);

        if (!$taskdays) {
            return response()->json(['error' => 'task day not found'], 404);
        }

        try {
            $taskdays->task_id  = $validatedData['task_id'];         
            $taskdays->worktime_id  = $validatedData['worktime_id'];             
            $taskdays->edited_by = Auth::user()->id;
            $taskdays->edited_date = Carbon::now();
            $taskdays->save();

            return response()->json([
                'success' => true,
                'message' => 'task day updated successfully',
                'data' => [
                    'id' => $taskdays->id,
                    'task' => $taskdays->tasks->task ?? null,
                    'worktime' => $taskdays->worktimes->worktime ?? null,
                    'added_by' => $taskdays->added_by,
                    'added_date' => $taskdays->added_date,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update task day: ' . $e->getMessage(),
            ], 500);
        }
    }
    
    public function destroy($id)
    {
        try {

            $taskdays = Tbl_mw_task_days::find($id);
            
            if (!$taskdays) {
                return response()->json([
                    'error' => 'task day not found!'
                ], 404);
            }
            
            $taskdays->delete();
            
            return response()->json([
                'success' => 'task day deleted successfully!'
            ]);
        } catch (\Exception $e) {           
            return response()->json([
                'error' => 'Something went wrong! ' . $e->getMessage()
            ], 500);
        }
    }
}
