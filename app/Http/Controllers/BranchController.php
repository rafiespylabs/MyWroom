<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Tbl_branches;
use Response;
use Redirect;
class BranchController extends Controller
{
    public function index()
    {
        $branches=Tbl_branches::all();
       return view('admin.branches',['branches'=>$branches]);
    }
    public function store(Request $request)
    {
        $existRecord=Tbl_branches::where('branch',$request->branch)->exists();
        if($existRecord)
        {
            return response()->json([
                'success' => false,
                'message' => 'Already Exist Branch',
            ]);
        }
        $branch=new Tbl_branches;
        $branch->branch=$request->branch;
        $branch->save();
        return Response::json([ 'success' => true,'data'=>$branch]);
    }
    public function show(Request $request)
    {
        $branch_id=$request->branch_id;
        $branch=Tbl_branches::find($branch_id);
        return Response::json($branch);
    }
    public function update(Request $request)
    {
        $branch_id=$request->branch_id;
        $branch=Tbl_branches::find($branch_id);
        $branch->branch=$request->branch;
        $branch->save();
        return Response::json([ 'success' => true,'data'=>$branch]);
    }
    public function destroy()
    {

    }
}
