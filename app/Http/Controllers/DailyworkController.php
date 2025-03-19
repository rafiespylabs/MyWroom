<?php

namespace App\Http\Controllers;

use App\Models\Tbl_daily_works;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DailyworkController extends Controller
{
    public function index()
    {
        $dailyworks=Tbl_daily_works::with(['createdByUser','editedByUser'])->get();
        return view('admin.dailyworks',['dailyworks'=>$dailyworks]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|max:1000',
            'status' => 'required|string|in:start,ongoing,completed,pending', 
            'remark' => 'nullable|max:1000', 
        ]);
        
        try {
            $dailyworks = new Tbl_daily_works();
            $dailyworks->title = $validatedData['title'];           
            $dailyworks->description = $validatedData['description'];           
            $dailyworks->status = $validatedData['status'];           
            $dailyworks->remark = $validatedData['remark'];   
            $dailyworks->created_by = Auth::user()->id;           
            $dailyworks->created_date = Carbon::now();                    
            $dailyworks->save();
            
            $dailyworks->created_user=Auth::user()->name;
            $dailyworks->edited_by='';

            return response()->json([
                'success' => true,
                'message' => 'Daily work created successfully',
                'data' => $dailyworks,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Daily work: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        $dailyworks = Tbl_daily_works::find($request->dailyworks_id);
    
        if (!$dailyworks) {
            return response()->json(['success' => false, 'message' => 'Daily work not found'], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => $dailyworks
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_daily_works,id',
            'title' => 'required|string|max:100',
            'description' => 'required|max:1000', // Increased length
            'status' => 'required|string|in:start,ongoing,completed,pending', // Ensuring valid status
            'remark' => 'nullable|max:1000', // Allowing remark to be optional
            
        ]);

        $dailyworks = Tbl_daily_works::find($validatedData['id']);
        $dailyworks->title = $validatedData['title'];             
        $dailyworks->description = $validatedData['description'];             
        $dailyworks->status = $validatedData['status'];             
        $dailyworks->remark = $validatedData['remark']; 
        $dailyworks->edited_by = Auth::user()->id;
        $dailyworks->edited_date = Carbon::now();              
        $dailyworks->save();
       
        $dailyworks->edited_user=Auth::user()->name;
        $dailyworks->created_by=User::find($dailyworks->created_by)->name;
        return response()->json([
            'success' => true,
            'message' => 'Daily work updated successfully',
            'data' => $dailyworks,
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_daily_works,id',
        ]);

        $dailyworks = Tbl_daily_works::find($validatedData['id']);
        if (!$dailyworks) {
            return response()->json([
                'success' => false,
                'message' => 'Daily work not found',
            ], 404);
        }
        $dailyworks->delete();

        return response()->json([
            'success' => true,
            'message' => 'Daily work deleted successfully',
        ]);
    } 
}
