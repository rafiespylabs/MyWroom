<?php

namespace App\Http\Controllers;

use App\Models\Tbl_enquiry_type;
use Illuminate\Http\Request;

class EnquirytypeController extends Controller
{
    public function index()
    {
        $enquirytypes=Tbl_enquiry_type::all();
        return view('admin.enquirytypes',['enquirytypes'=>$enquirytypes]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'enquiry_type' => 'required|string|max:100',           
        ]);

        try {
            $existRecord=Tbl_enquiry_type::where('enquiry_type',$validatedData['enquiry_type'])->exists();
            if($existRecord)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Already Exist Enquiry Type',
                ]);
            }
            $enquirytypes = new Tbl_enquiry_type();
            $enquirytypes->enquiry_type = $validatedData['enquiry_type'];           
            $enquirytypes->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Enquiry Type Category created successfully',
                'data' => $enquirytypes,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Enquiry Type: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        $enquirytypes = Tbl_enquiry_type::find($request->id);
    
        if (!$enquirytypes) {
            return response()->json(['success' => false, 'message' => 'Enquiry Type not found'], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => $enquirytypes
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_enquiry_types,id',
            'enquiry_type' => 'required|string|max:100',
            
        ]);

        $enquirytypes = Tbl_enquiry_type::find($validatedData['id']);
        $enquirytypes->enquiry_type = $validatedData['enquiry_type'];             
        $enquirytypes->save();
       
        return response()->json([
            'success' => true,
            'message' => 'Enquiry Type updated successfully',
            'data' => $enquirytypes,
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_enquiry_types,id',
        ]);

        $enquirytypes = Tbl_enquiry_type::find($validatedData['id']);
        if (!$enquirytypes) {
            return response()->json([
                'success' => false,
                'message' => 'Enquiry Type not found',
            ], 404);
        }
        $enquirytypes->delete();

        return response()->json([
            'success' => true,
            'message' => 'Enquiry Type deleted successfully',
        ]);
    } 
}
