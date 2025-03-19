<?php

namespace App\Http\Controllers;
use App\Models\Tbl_chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class ChapterSelectionController extends Controller
{
    public function selection(Request $request)
    {
        $select_chapter_id=$request->select_chapter;
        $chapter_details=Tbl_chapter::find($select_chapter_id);
        $request->session()->put('selected_chapter_id', $select_chapter_id);
        $request->session()->put('selected_chapter_name', $chapter_details->chapter_name);
        return response()->json([
            'success' => true,
            'message' => 'Chapter Selected Successfully',
        ]);
    }
    public function dashboard()
    {
        $selected_chapter_name= Session::get('selected_chapter_name');
        return view('chapter.dashboard',['selected_chapter_name'=>$selected_chapter_name]);
    }
}
