<?php

namespace App\Http\Controllers;

use App\Models\Tbl_mw_worktimes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WorktimeController extends Controller
{
    public function index()
    {
        $worktimes=Tbl_mw_worktimes::with(['addedByUser','editedByUser'])->get();
        return view('admin.worktimes',['worktimes'=>$worktimes]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'worktime' => 'required|string|max:100',           
        ]);

        try {
            $worktimes = new Tbl_mw_worktimes();
            $worktimes->worktime = $validatedData['worktime']; 
            $worktimes->addedby = Auth::user()->id;           
            $worktimes->added_date = Carbon::now();          
            $worktimes->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Work Time created successfully',
                'data' =>  [
                    'id' => $worktimes->id,
                    'worktime' => $worktimes->worktime,
                    'addedby' => optional($worktimes->addedByUser)->name, // Return the user's name
                    'added_date' => $worktimes->added_date,
                    'editedby' => optional($worktimes->editedByUser)->name, 
                    'edited_date' => $worktimes->edited_date,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Work Time: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        $worktimes = Tbl_mw_worktimes::find($request->worktimes_id);
    
        if (!$worktimes) {
            return response()->json(['success' => false, 'message' => 'Work Time not found'], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => $worktimes
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_mw_worktimes,id',
            'worktime' => 'required|string|max:100',
            
        ]);

        $worktimes = Tbl_mw_worktimes::find($validatedData['id']);
        $worktimes->worktime = $validatedData['worktime'];  
        $worktimes->editedby = Auth::user()->id;
        $worktimes->edited_date = Carbon::now();            
        $worktimes->save();
       
        return response()->json([
            'success' => true,
            'message' => 'Work Time updated successfully',
            'data' =>  [
                'id' => $worktimes->id,
                'worktime' => $worktimes->worktime,
                'addedby' => optional($worktimes->addedByUser)->name, // Return the user's name
                'added_date' => $worktimes->added_date,
                'editedby' => optional($worktimes->editedByUser)->name, 
                'edited_date' => $worktimes->edited_date,
            ]
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_mw_worktimes,id',
        ]);

        $worktimes = Tbl_mw_worktimes::find($validatedData['id']);
        if (!$worktimes) {
            return response()->json([
                'success' => false,
                'message' => 'Work Time not found',
            ], 404);
        }
        $worktimes->delete();

        return response()->json([
            'success' => true,
            'message' => 'Work Time deleted successfully',
        ]);
    } 
}
