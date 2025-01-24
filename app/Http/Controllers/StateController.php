<?php
namespace App\Http\Controllers;
use App\Models\Tbl_country;
use App\Models\Tbl_state;
use App\Models\Tbl_districts;
use Illuminate\Http\Request;
class StateController extends Controller
{
    public function index()
    {
        $states=Tbl_state::with(['country'])->get();
        $country = Tbl_country::all();
        return view('admin.states', [
            'states' => $states,
            'country' => $country,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'country_id' => 'required|integer|exists:tbl_countries,id',
            'state_name' => 'required|string|max:100',           
        ]);

        try {
            $existRecord=Tbl_state::where('state_name',$validatedData['state_name'])->exists();
            if($existRecord)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Already Exist State',
                ]);
            }
            $states = new Tbl_state();
            $states->country_id = $validatedData['country_id'];  
            $states->state_name = $validatedData['state_name'];           
            $states->save();

            $country = Tbl_country::find($validatedData['country_id']);
            $states->country_name = $country->country_name;
            
            return response()->json([
                'success' => true,
                'message' => 'State created successfully',
                'data' => $states,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create State: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tbl_states,id',
        ]);


        $states = Tbl_state::with('country')->find($request->id);
    
        if (!$states) {
            return response()->json(['success' => false, 'message' => 'State not found'], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => [
                'state_name' => $states->state_name ,
                'country_id' => $states->country_id, 
            ]
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_states,id',
            'country_id' => 'required|integer|exists:tbl_countries,id',
            'state_name' => 'required|string|max:100',
            
        ]);

        $states = Tbl_state::find($validatedData['id']);
        $states->country_id = $validatedData['country_id'];
        $states->state_name = $validatedData['state_name'];             
        $states->save();

        $country = Tbl_country::find($validatedData['country_id']);
            $states->country_name = $country->country_name;
       
        return response()->json([
            'success' => true,
            'message' => 'State updated successfully',
            'data' => $states,
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_states,id',
        ]);

        $states = Tbl_state::find($validatedData['id']);
        if (!$states) {
            return response()->json([
                'success' => false,
                'message' => 'State not found',
            ], 404);
        }
        $states->delete();

        return response()->json([
            'success' => true,
            'message' => 'State deleted successfully',
        ]);
    } 
    public function getDistricts(Request $request)
    {
        $state_id=$request->state_id;
        $districts = Tbl_districts::where('state_id',$state_id)->get();
        if (!$districts) {
            return response()->json(['success' => false, 'message' => 'Districts not found'], 404);
        }
        return response()->json([
            'success' => true,
            'districts' => $districts
        ]);
    }
}
