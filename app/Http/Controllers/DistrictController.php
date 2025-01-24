<?php

namespace App\Http\Controllers;

use App\Models\Tbl_country;
use App\Models\Tbl_district;
use App\Models\Tbl_state;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $districts=Tbl_district::with(['country','state'])->get();
        $country = Tbl_country::all();
        $state = Tbl_state::all();
        return view('admin.districts', [
            'districts' => $districts,
            'country' => $country,
            'state' => $state,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'country_id' => 'required|integer|exists:tbl_countries,id',
            'state_id' => 'required|integer|exists:tbl_states,id',
            'district_name' => 'required|string|max:100',           
        ]);

        try {
            $existRecord=Tbl_district::where('district_name',$validatedData['district_name'])->exists();
            if($existRecord)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Already Exist District',
                ]);
            }
            $districts = new Tbl_district();
            $districts->country_id = $validatedData['country_id'];  
            $districts->state_id = $validatedData['state_id'];  
            $districts->district_name = $validatedData['district_name'];           
            $districts->save();

            $country = Tbl_country::find($validatedData['country_id']);
            $districts->country_name = $country->country_name;

            $state = Tbl_state::find($validatedData['state_id']);
            $districts->state_name = $state->state_name;
            
            return response()->json([
                'success' => true,
                'message' => 'District created successfully',
                'data' => $districts,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create District: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tbl_districts,id',
        ]);


        $districts = Tbl_district::with('country','state')->find($request->id);
    
        if (!$districts) {
            return response()->json(['success' => false, 'message' => 'District not found'], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => [
                'district_name' => $districts->district_name ,
                'country_id' => $districts->country_id, 
                'state_id' => $districts->state_id, 
            ]
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_districts,id',
            'country_id' => 'required|integer|exists:tbl_countries,id',
            'state_id' => 'required|integer|exists:tbl_states,id',
            'district_name' => 'required|string|max:100',
            
        ]);

        $districts = Tbl_district::find($validatedData['id']);
        $districts->country_id = $validatedData['country_id'];
        $districts->state_id = $validatedData['state_id'];
        $districts->district_name = $validatedData['district_name'];             
        $districts->save();

        $country = Tbl_country::find($validatedData['country_id']);
            $districts->country_name = $country->country_name;

            $state = Tbl_state::find($validatedData['state_id']);
            $districts->state_name = $state->state_name;
       
        return response()->json([
            'success' => true,
            'message' => 'District updated successfully',
            'data' => $districts,
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_districts,id',
        ]);

        $districts = Tbl_district::find($validatedData['id']);
        if (!$districts) {
            return response()->json([
                'success' => false,
                'message' => 'District not found',
            ], 404);
        }
        $districts->delete();

        return response()->json([
            'success' => true,
            'message' => 'District deleted successfully',
        ]);
    } 
}
