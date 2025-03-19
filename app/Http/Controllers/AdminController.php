<?php
namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tbl_chapter;
use Response;
use Redirect;
use Hash;
class AdminController extends Controller
{
    public function index()
    {
        $user_id=Auth::user()->id;
        $role_id=Auth::user()->role_id;
        return view('admin.dashboard');
    }
    public function getChapter()
    {
        $chapeters=Tbl_chapter::all();
        return view('admin.chapterselection',['chapeters'=>$chapeters]);
    }
}
