<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Tbl_designations;
use Response;
use Redirect;
class DesignationController extends Controller
{
    public function index()
    {
        $designations=Tbl_designations::all();
        return view('admin.designations',['designations'=>$designations]);
    }
    public function store(Request $request)
    {
        $existRecord=Tbl_designations::where('designation',$request->designation)->exists();
        if($existRecord)
        {
            return response()->json([
                'success' => false,
                'message' => 'Already Exist Designation',
            ]);
        }
        $designation=new Tbl_designations;
        $designation->designation=$request->designation;
        $designation->save();
        return Response::json([ 'success' => true,'data'=>$designation]);
    }
    public function show(Request $request)
    {
        $designation_id=$request->designation_id;
        $designation=Tbl_designations::find($designation_id);
        return Response::json($designation);
    }
    public function update(Request $request)
    {
        $designation_id=$request->designation_id;
        $designation=Tbl_designations::find($designation_id);
        $designation->designation=$request->designation;
        $designation->save();
        return Response::json([ 'success' => true,'data'=>$designation]);
    }
    public function destroy()
    {

    }
}
