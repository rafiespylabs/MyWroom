<?php
namespace App\Http\Controllers;
use App\Models\Tbl_country;
use App\Models\Tbl_state;
use Illuminate\Http\Request;
class CountryController extends Controller
{
    public function index()
    {
        $countries=Tbl_country::all();
        return view('admin.countries',['countries'=>$countries]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'country_name' => 'required|string|max:100',           
        ]);

        try {
            $existRecord=Tbl_country::where('country_name',$validatedData['country_name'])->exists();
            if($existRecord)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Already Exist Country',
                ]);
            }
            $countries = new Tbl_country();
            $countries->country_name = $validatedData['country_name'];           
            $countries->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Country created successfully',
                'data' => $countries,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create country: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        $countries = Tbl_country::find($request->countries_id);
    
        if (!$countries) {
            return response()->json(['success' => false, 'message' => 'Country not found'], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => $countries
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_countries,id',
            'country_name' => 'required|string|max:100',
            
        ]);

        $countries = Tbl_country::find($validatedData['id']);
        $countries->country_name = $validatedData['country_name'];             
        $countries->save();
       
        return response()->json([
            'success' => true,
            'message' => 'Country updated successfully',
            'data' => $countries,
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_countries,id',
        ]);

        $countries = Tbl_country::find($validatedData['id']);
        if (!$countries) {
            return response()->json([
                'success' => false,
                'message' => 'Country not found',
            ], 404);
        }
        $countries->delete();

        return response()->json([
            'success' => true,
            'message' => 'Country deleted successfully',
        ]);
    } 
    public function getStates(Request $request)
    {
        $country_id=$request->country_id;
        $states = Tbl_state::where('country_id',$country_id)->get();
        if (!$states) {
            return response()->json(['success' => false, 'message' => 'States not found'], 404);
        }
        return response()->json([
            'success' => true,
            'states' => $states
        ]);
    }
}
