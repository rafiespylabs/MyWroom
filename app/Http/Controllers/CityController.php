<?php
namespace App\Http\Controllers;
use App\Models\Tbl_city;
use App\Models\Tbl_country;
use App\Models\Tbl_district;
use App\Models\Tbl_state;
use App\Models\Tbl_chapter;
use Illuminate\Http\Request;
use Response;
class CityController extends Controller
{
    public function index()
    {
        $cities=Tbl_city::with(['country','state','district'])->get();
        $country = Tbl_country::all();
        $state = Tbl_state::all();
        $district = Tbl_district::all();
        return view('admin.cities', [
            'cities' => $cities,
            'country' => $country,
            'state' => $state,
            'district' => $district,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'country_id' => 'required|integer|exists:tbl_countries,id',
            'state_id' => 'required|integer|exists:tbl_states,id',
            'district_id' => 'required|integer|exists:tbl_districts,id',
            'city_name' => 'required|string|max:100',           
        ]);

        try {
            $existRecord=Tbl_city::where('city_name',$validatedData['city_name'])->exists();
            if($existRecord)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Already Exist City',
                ]);
            }
            $cities = new Tbl_city();
            $cities->country_id = $validatedData['country_id'];  
            $cities->state_id = $validatedData['state_id'];  
            $cities->district_id = $validatedData['district_id'];  
            $cities->city_name = $validatedData['city_name'];           
            $cities->save();

            $country = Tbl_country::find($validatedData['country_id']);
            $cities->country_name = $country->country_name;

            $state = Tbl_state::find($validatedData['state_id']);
            $cities->state_name = $state->state_name;

            $district = Tbl_district::find($validatedData['district_id']);
            $cities->district_name = $district->district_name;
            
            return response()->json([
                'success' => true,
                'message' => 'City created successfully',
                'data' => $cities,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create City: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tbl_cities,id',
        ]);


        $cities = Tbl_city::with('country','state','district')->find($request->id);
    
        if (!$cities) {
            return response()->json(['success' => false, 'message' => 'City not found'], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => [
                'city_name' => $cities->city_name ,
                'country_id' => $cities->country_id, 
                'state_id' => $cities->state_id, 
                'district_id' => $cities->district_id, 
            ]
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_cities,id',
            'country_id' => 'required|integer|exists:tbl_countries,id',
            'state_id' => 'required|integer|exists:tbl_states,id',
            'district_id' => 'required|integer|exists:tbl_districts,id',
            'city_name' => 'required|string|max:100',
            
        ]);

        $cities = Tbl_city::find($validatedData['id']);
        $cities->country_id = $validatedData['country_id'];
        $cities->state_id = $validatedData['state_id'];
        $cities->district_id = $validatedData['district_id'];
        $cities->city_name = $validatedData['city_name'];             
        $cities->save();

        $country = Tbl_country::find($validatedData['country_id']);
            $cities->country_name = $country->country_name;

            $state = Tbl_state::find($validatedData['state_id']);
            $cities->state_name = $state->state_name;

            $district = Tbl_district::find($validatedData['district_id']);
            $cities->district_name = $district->district_name;
       
        return response()->json([
            'success' => true,
            'message' => 'City updated successfully',
            'data' => $cities,
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_cities,id',
        ]);

        $cities = Tbl_city::find($validatedData['id']);
        if (!$cities) {
            return response()->json([
                'success' => false,
                'message' => 'City not found',
            ], 404);
        }
        $cities->delete();

        return response()->json([
            'success' => true,
            'message' => 'City deleted successfully',
        ]);
    } 
    public function getchapters(Request $request)
    {
        $city_id=$request->city_id;
        $chapters = Tbl_chapter::where('city_id',$city_id)->get();
        return Response::json(['success' => true,'chapters'=>$chapters]);
    }
}
