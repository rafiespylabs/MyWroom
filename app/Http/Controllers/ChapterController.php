<?php

namespace App\Http\Controllers;

use App\Models\Tbl_chapter;
use App\Models\Tbl_city;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChapterController extends Controller
{
    public function index()
    {
        $chapters=Tbl_chapter::with(['city'])->get();
        $city = Tbl_city::all();
        return view('admin.chapters', [
            'chapters' => $chapters,
            'city' => $city,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'city_id' => 'required|integer|exists:tbl_cities,id',
            'chapter_name' => 'required|string|max:100',           
        ]);

        try {
            $existRecord=Tbl_chapter::where('chapter_name',$validatedData['chapter_name'])
            ->where('city_id',$validatedData['city_id'])
            ->exists();
            if($existRecord)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Already Exist Chapter',
                ]);
            }
            $chapters = new Tbl_chapter();
            $chapters->city_id = $validatedData['city_id'];  
            $chapters->chapter_name = $validatedData['chapter_name'];           
            $chapters->save();

            $city = Tbl_city::find($validatedData['city_id']);
            $chapters->city_name = $city->city_name;
            
            return response()->json([
                'success' => true,
                'message' => 'Chapter created successfully',
                'data' => $chapters,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Chapter: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tbl_chapters,id',
        ]);


        $chapters = Tbl_chapter::with('city')->find($request->id);
    
        if (!$chapters) {
            return response()->json(['success' => false, 'message' => 'Chapter not found'], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => [
                'chapter_name' => $chapters->chapter_name ,
                'city_id' => $chapters->city_id, 
            ]
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_chapters,id',
            'city_id' => 'required|integer|exists:tbl_cities,id',
            'chapter_name' => 'required|string|max:100',
            
        ]);

        $chapters = Tbl_chapter::find($validatedData['id']);
        $chapters->city_id = $validatedData['city_id'];
        $chapters->chapter_name = $validatedData['chapter_name'];             
        $chapters->save();

        $city = Tbl_city::find($validatedData['city_id']);
            $chapters->city_name = $city->city_name;
       
        return response()->json([
            'success' => true,
            'message' => 'Chapter updated successfully',
            'data' => $chapters,
        ]);
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:tbl_chapters,id',
        ]);

        $chapters = Tbl_chapter::find($validatedData['id']);
        if (!$chapters) {
            return response()->json([
                'success' => false,
                'message' => 'Chapter not found',
            ], 404);
        }
        $chapters->delete();

        return response()->json([
            'success' => true,
            'message' => 'Chapter deleted successfully',
        ]);
    } 
}
