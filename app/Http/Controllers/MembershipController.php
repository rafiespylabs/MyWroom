<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Tbl_business_category;
use App\Models\Tbl_businesscategory;
use App\Models\Tbl_chapter;
use App\Models\Tbl_city;
use App\Models\Tbl_membership;
use App\Models\Tbl_membership_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships=Tbl_membership::with(['user','business_category','city','chapter','membership_type'])->get();
        $business_category = Tbl_business_category::all();
        $city = Tbl_city::all();
        $chapter = Tbl_chapter::all();
        $membership_type = Tbl_membership_type::all();
        return view('admin.memberships', [
            'memberships' => $memberships,
            'business_category' => $business_category,
            'city' => $city,
            'chapter' => $chapter,
            'membership_type' => $membership_type,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',            
            'business_category_id' => 'required|integer|exists:tbl_business_categories,id',
            'firm_name' => 'required|string|max:255',
            'city_id' => 'required|integer|exists:tbl_cities,id',
            'chapter_id' => 'required|integer|exists:tbl_chapters,id',
            'membership_type_id' => 'required|integer|exists:tbl_membership_types,id',
            'join_date' => 'required|date',        
        ]);

        try {

            $added_by = Auth::user()->id;
            $added_date = date('Y-m-d');
            $existRecord=Tbl_membership::where('email',$validatedData['email'])->orWhere('phone_number',$validatedData['phone_number'])->exists();
            if($existRecord)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Already Exist Email or Phone Number',
                ]);
            }
            $memberships = new Tbl_membership();
            $memberships->first_name = $validatedData['first_name'];  
            $memberships->middle_name = $validatedData['middle_name'];  
            $memberships->last_name = $validatedData['last_name'];  
            $memberships->email = $validatedData['email'];  
            $memberships->phone_number = $validatedData['phone_number'];  
            $memberships->address = $validatedData['address'];  
            $memberships->business_category_id = $validatedData['business_category_id'];  
            $memberships->firm_name = $validatedData['firm_name'];  
            $memberships->city_id = $validatedData['city_id'];  
            $memberships->chapter_id = $validatedData['chapter_id'];  
            $memberships->membership_type_id = $validatedData['membership_type_id'];  
            $memberships->join_date = $validatedData['join_date'];  
            $memberships->added_by = $added_by;    
            $memberships->added_date = $added_date;         
            $memberships->save();

            $business_category = Tbl_business_category::find($validatedData['business_category_id']);
            $memberships->business_category_name = $business_category->business_category_name;

            $city = Tbl_city::find($validatedData['city_id']);
            $memberships->city_name = $city->city_name;

            $chapter = Tbl_chapter::find($validatedData['chapter_id']);
            $memberships->chapter_name = $chapter->chapter_name;

            $membership_type = Tbl_membership_type::find($validatedData['membership_type_id']);
            $memberships->membership_type = $membership_type->membership_type;

            $added_user=User::find($added_by);
            $memberships->added_user =  $added_user->name;
            
            return response()->json([
                'success' => true,
                'message' => 'Membership Registered successfully',
                'data' => $memberships,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to Register: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tbl_memberships,id',
        ]);


        $memberships = Tbl_membership::with('business_category','city','chapter','membership_type')->find($request->id);
    
        if (!$memberships) {
            return response()->json(['success' => false, 'message' => 'Membership not found'], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => [
                'first_name' => $memberships->first_name ,
                'middle_name' => $memberships->middle_name, 
                'last_name' => $memberships->last_name, 
                'email' => $memberships->email, 
                'phone_number' => $memberships->phone_number, 
                'address' => $memberships->address, 
                'business_category_id' => $memberships->business_category_id, 
                'firm_name' => $memberships->firm_name, 
                'city_id' => $memberships->city_id, 
                'chapter_id' => $memberships->chapter_id, 
                'membership_type_id' => $memberships->membership_type_id, 
                'join_date' => $memberships->join_date, 
            ]
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_memberships,id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',            
            'business_category_id' => 'required|integer|exists:tbl_business_categories,id',
            'firm_name' => 'required|string|max:255',
            'city_id' => 'required|integer|exists:tbl_cities,id',
            'chapter_id' => 'required|integer|exists:tbl_chapters,id',
            'membership_type_id' => 'required|integer|exists:tbl_membership_types,id',
            'join_date' => 'required|date', 
            
        ]);

        $memberships = Tbl_membership::find($validatedData['id']);
        $memberships->first_name = $validatedData['first_name'];  
            $memberships->middle_name = $validatedData['middle_name'];  
            $memberships->last_name = $validatedData['last_name'];  
            $memberships->email = $validatedData['email'];  
            $memberships->phone_number = $validatedData['phone_number'];  
            $memberships->address = $validatedData['address'];  
            $memberships->business_category_id = $validatedData['business_category_id'];  
            $memberships->firm_name = $validatedData['firm_name'];  
            $memberships->city_id = $validatedData['city_id'];  
            $memberships->chapter_id = $validatedData['chapter_id'];  
            $memberships->membership_type_id = $validatedData['membership_type_id'];  
            $memberships->join_date = $validatedData['join_date'];  
            $memberships->save();    

            $business_category = Tbl_business_category::find($validatedData['business_category_id']);
            $memberships->business_category_name = $business_category->business_category_name;

            $city = Tbl_city::find($validatedData['city_id']);
            $memberships->city_name = $city->city_name;

            $chapter = Tbl_chapter::find($validatedData['chapter_id']);
            $memberships->chapter_name = $chapter->chapter_name;

            $membership_type = Tbl_membership_type::find($validatedData['membership_type_id']);
            $memberships->membership_type = $membership_type->membership_type;

            $added_user=User::find($memberships->added_by);
            $memberships->added_user =  $added_user->name;
       
        return response()->json([
            'success' => true,
            'message' => 'Membership updated successfully',
            'data' => $memberships,
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_memberships,id',
        ]);

        $memberships = Tbl_membership::find($validatedData['id']);
        if (!$memberships) {
            return response()->json([
                'success' => false,
                'message' => 'Membership not found',
            ], 404);
        }
        $memberships->delete();

        return response()->json([
            'success' => true,
            'message' => 'Membership deleted successfully',
        ]);
    } 
}
