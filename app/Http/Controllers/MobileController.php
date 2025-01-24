<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tbl_attendances;
use Redirect;
use DB;
use Auth;
use Hash;
class MobileController extends Controller
{
    public function Login(Request $request)
    {
        $postdata = file_get_contents("php://input");					
        $json = str_replace(array("\t","\n"), "", $postdata);
        $data1 = json_decode($json);
        $email = $request->email;
        $password = $request->password;
        try
        {
            $credentials = $request->only('email' ,'password');
            if (Auth::attempt($credentials)) 
            {
                $user = User::where('email', $email)->first();
                echo json_encode(array('error' => false, "data" => $user, "message" => "Success"));
            }
            else
            {
                echo json_encode(array('error' => true, "message" => "Invalid Login Creadentials"));
            }
        }
        catch (Exception $e)
        {
          echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));
        }
    }
    public function listUsers()
    {
        $postdata = file_get_contents("php://input");					
        $json = str_replace(array("\t","\n"), "", $postdata);
        $data1 = json_decode($json);
        try
        {
            $users=User::all();
            if($users)
            {
                echo json_encode(array('error' => false, "data" => $users, "message" => "Success"));
            }
            else
            {
                echo json_encode(array('error' => false, "data" => $users, "message" => "Failed"));
            }
        }
        catch (Exception $e)
        {
          echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));
        }
    }
    public function Punchin(Request $request)
    {
        $postdata = file_get_contents("php://input");					
        $json = str_replace(array("\t","\n"), "", $postdata);
        $data1 = json_decode($json);
        $today=$request->date;
        $currenttime=$request->time;
        try
        {
            $checkuser=Tbl_attendances::where('staff_user_id',$request->userid)->where('date',$today)->exists();
            if ($checkuser) 
            {
                echo json_encode(array('error' => true, "message" => "User Already Punch In"));
            }
            else
            {
                $punchin=new Tbl_attendances;
                $punchin->staff_user_id=$request->userid;
                $punchin->longitude_punchin=$request->longitude;
                $punchin->lattitude_punchin=$request->latttitude;
                $punchin->punch_in_time=$currenttime;
                if($files=$request->file('punchinimage')){  
                    $punchinimage=time().$files->getClientOriginalName();  
                    $files->move('uploads/',$punchinimage);  
                    $punchin->punchinimage=$punchinimage;
                }
                else{
                    echo json_encode(array('error' => true, "message" => "Image Can't Upload"));
                }
                $punchin->date=$today;
                $punchin->save();
                $json_data = 0;
                 echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));
            }
        }
        catch (Exception $e)
        {
          echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));
        }
    }
    public function Punchout(Request $request)
    {
        $postdata = file_get_contents("php://input");					
        $json = str_replace(array("\t","\n"), "", $postdata);
        $data1 = json_decode($json);
        $today=$request->date;
        $currenttime=$request->time;
        try
        {
            $checkpunchin=Tbl_attendances::where('staff_user_id',$request->userid)->where('date',$today)->first();
            if ($checkpunchin) 
            {
               if($checkpunchin->punch_out_time==null)
               {
                $checkpunchin->punchout_lat=$request->longitude;
                $checkpunchin->punchout_long=$request->latttitude;
                $checkpunchin->punch_out_time=$currenttime;
                if($files=$request->file('punchoutimage')){  
                    $punchoutimage=time().$files->getClientOriginalName();  
                    $files->move('uploads/',$punchoutimage);  
                    $checkpunchin->punchoutimage=$punchoutimage;
                }
                $checkpunchin->date=$today;
                $checkpunchin->save();
                $json_data = 0;
                echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));
               }
               else
               {
                echo json_encode(array('error' => true,  "message" => "User Already Punch Out"));
               }
            }
            else
            {
                echo json_encode(array('error' => true, "message" => "failed"));
            }
        }
        catch (Exception $e)
        {
          echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));
        }
    }
}
