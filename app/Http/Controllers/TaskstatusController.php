<?php

namespace App\Http\Controllers;

use App\Models\Tbl_mw_statuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskstatusController extends Controller
{
    public function index()
    {
        $statuses=Tbl_mw_statuses::with(['addedByUser','editedByUser'])->get();
        return view('admin.statuses',['statuses'=>$statuses]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|string|max:100',           
        ]);

        try {
            $statuses = new Tbl_mw_statuses();
            $statuses->status = $validatedData['status']; 
            $statuses->addedby = Auth::user()->id;           
            $statuses->added_date = Carbon::now();          
            $statuses->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Status created successfully',
                'data' =>  [
                    'id' => $statuses->id,
                    'status' => $statuses->status,
                    'addedby' => optional($statuses->addedByUser)->name, // Return the user's name
                    'added_date' => $statuses->added_date,
                    'editedby' => optional($statuses->editedByUser)->name, 
                    'edited_date' => $statuses->edited_date,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create status: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        $statuses = Tbl_mw_statuses::find($request->statuses_id);
    
        if (!$statuses) {
            return response()->json(['success' => false, 'message' => 'Status not found'], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => $statuses
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_mw_statuses,id',
            'status' => 'required|string|max:100',
            
        ]);

        $statuses = Tbl_mw_statuses::find($validatedData['id']);
        $statuses->status = $validatedData['status'];  
        $statuses->editedby = Auth::user()->id;
        $statuses->edited_date = Carbon::now();            
        $statuses->save();
       
        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'data' =>  [
                'id' => $statuses->id,
                'status' => $statuses->status,
                'addedby' => optional($statuses->addedByUser)->name, // Return the user's name
                'added_date' => $statuses->added_date,
                'editedby' => optional($statuses->editedByUser)->name, 
                'edited_date' => $statuses->edited_date,
            ]
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_mw_statuses,id',
        ]);

        $statuses = Tbl_mw_statuses::find($validatedData['id']);
        if (!$statuses) {
            return response()->json([
                'success' => false,
                'message' => 'status not found',
            ], 404);
        }
        $statuses->delete();

        return response()->json([
            'success' => true,
            'message' => 'Status deleted successfully',
        ]);
    } 
}
