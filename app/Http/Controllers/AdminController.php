<?php
namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Response;
use Redirect;
use Hash;
class AdminController extends Controller
{
    public function index()
    {
        $user_id=Auth::user()->id;
        return view('admin.dashboard');
    }
}
