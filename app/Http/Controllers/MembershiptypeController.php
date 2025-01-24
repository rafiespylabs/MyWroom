<?php

namespace App\Http\Controllers;

use App\Models\Tbl_membership_type;
use Illuminate\Http\Request;

class MembershiptypeController extends Controller
{
    public function index()
    {
        $membershiptypes=Tbl_membership_type::all();
        return view('admin.membershiptypes',['membershiptypes'=>$membershiptypes]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'membership_type' => 'required|string|max:100',           
        ]);

        try {
            $existRecord=Tbl_membership_type::where('membership_type',$validatedData['membership_type'])->exists();
            if($existRecord)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Already Exist MemberShip Type',
                ]);
            }
            $membershiptypes = new Tbl_membership_type();
            $membershiptypes->membership_type = $validatedData['membership_type'];           
            $membershiptypes->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Membership Type Category created successfully',
                'data' => $membershiptypes,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Membership Type: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        $membershiptypes = Tbl_membership_type::find($request->id);
    
        if (!$membershiptypes) {
            return response()->json(['success' => false, 'message' => 'Membership Type not found'], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => $membershiptypes
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_membership_types,id',
            'membership_type' => 'required|string|max:100',
            
        ]);

        $membershiptypes = Tbl_membership_type::find($validatedData['id']);
        $membershiptypes->membership_type = $validatedData['membership_type'];             
        $membershiptypes->save();
       
        return response()->json([
            'success' => true,
            'message' => 'Membership Type updated successfully',
            'data' => $membershiptypes,
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_membership_types,id',
        ]);

        $membershiptypes = Tbl_membership_type::find($validatedData['id']);
        if (!$membershiptypes) {
            return response()->json([
                'success' => false,
                'message' => 'Membership Type not found',
            ], 404);
        }
        $membershiptypes->delete();

        return response()->json([
            'success' => true,
            'message' => 'Membership Type deleted successfully',
        ]);
    } 
}
