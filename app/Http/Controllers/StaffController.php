<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tbl_staffs;
use App\Models\Tbl_branches;
use App\Models\Tbl_departments;
use App\Models\Tbl_designations;
use App\Models\Tbl_roles;
use Response;
use Redirect;
use Hash;
use Carbon\Carbon;
class StaffController extends Controller
{
   public function index()
   {
        $branches=Tbl_branches::all();
        $departments=Tbl_departments::all();
        $designations=Tbl_designations::all();
        $roles=Tbl_roles::all();
        return view('admin.staffs',['branches'=>$branches,'designations'=>$designations,
        'roles'=>$roles,'departments'=>$departments]);
   }
   public function list()
    {
        $staffs=Tbl_staffs::with('department','designation','branch','user')->latest('id')->get();
        $html='';
        $i=1;
        foreach($staffs as $staff)
        {
            $branch=$staff->branch->branch ?? '';
            $department=$staff->department->department ?? '';
            $designation=$staff->designation->designation ?? '';
            $created_date = $staff->created_date ? Carbon::parse($staff->created_date)->format('d/m/Y') : '';
            $html.='<tr>';
            $html.='<td>'.$i.'</td>';
            $html.='<td>'.$staff->user->name.'</td>';
            $html.='<td>'.$staff->user->user_name.'</td>';
            $html.='<td>'.$staff->user->email.'</td>';
            $html.='<td>'.$staff->mobile_number.'</td>';
            $html.='<td>'.$branch.'</td>';
            $html.='<td>'.$department.'</td>';
            $html.='<td>'.$designation.'</td>';
            $html.='<td>'.$created_date.'</td>';
            $html.='<td><i class="fa fa-edit edit_staff" data-id="'.$staff->id.'" data-bs-toggle="modal" data-bs-target="#EditModal"></i>
            <i class="fa fa-trash delete_staff" data-id="'.$staff->id.'"></i>
             <i class="fa fa-key reset_password" data-id="'.$staff->id.'" data-bs-toggle="modal" data-bs-target="#ResetPasswordModal"></i></td>';
            $html.='</tr>';
            $i++;
        }
        return Response::json($html);
    }
   public function store(Request $request)
   {
      $user=new User;
      $user->name=$request->name;
      $user->email=$request->email;
      $user->user_name=$request->user_name;
      $user->password=Hash::make($request->password);
      $user->role_id=$request->role_id;
      if($user->save())
      {
        $staff=new Tbl_staffs;
        $staff->user_id=$user->id;
        $staff->Join_date=$request->join_date;
        $staff->branch_id=$request->branch_id;
        $staff->mobile_number=$request->mobile_number;
        $staff->profile_image=$request->profile_image;
        $staff->dept_id=$request->dept_id;
        $staff->design_id=$request->design_id;
        $staff->address=$request->address;  
        $staff->created_date=date('Y-m-d');    
        $staff->added_by=Auth::user()->id;
        $staff->save();
      }
      return Response::json([ 'success' => true,'data'=>['user'=>$user,'staff'=>$staff]]);
   }
   public function show(Request $request)
   {
      $staff_id=$request->staff_id;
      $staff=Tbl_staffs::with('department','designation','branch','user')->find($staff_id);
      return Response::json($staff);
   }
   public function update(Request $request)
   {
      $staff_id=$request->staff_id;
      $staff=Tbl_staffs::find($staff_id);
      $staff->Join_date=$request->join_date;
      $staff->mobile_number=$request->mobile_number;
      $staff->profile_image=$request->profile_image;
      $staff->branch_id=$request->branch_id;
      $staff->dept_id=$request->dept_id;
      $staff->design_id=$request->design_id;
      $staff->address=$request->address; 
      $staff->save(); 

      $user=User::find($staff->user_id);
      $user->name=$request->name;
      $user->email=$request->email;
      $user->user_name=$request->user_name;
      $user->role_id=$request->role_id;
      $user->save();
      return Response::json([ 'success' => true,'data'=>['user'=>$user,'staff'=>$staff]]);
   }
   public function destroy(Request $request)
   {
      $staff_id=$request->staff_id;
      $staff=Tbl_staffs::find($staff_id);
      $staff->delete();
      $user=User::find($staff->user_id);
      $user->delete();
      return Response::json([ 'success' => true]);
   }
   public function password_reset(Request $request)
   {
      $staff_id=$request->staff_id;
      $staff=Tbl_staffs::find($staff_id);
      $user=User::find($staff->user_id);
      $user->password=Hash::make($request->password);
      $user->save();
      return Response::json([ 'success' => true]);
   }
}
