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
    public function login()
    {
        $postdata = file_get_contents("php://input");					
        $json = str_replace(array("\t","\n"), "", $postdata);
        $data1 = json_decode($json);
        $email = $data1->username;
        $password = $data1->password;
        try
        {
            $checklogin = DB::table('users')->where('email', $email)
            // ->where('role_id','!=',1)
            ->first();
            if ($checklogin) 
            {
                if (Hash::check($password, $checklogin->password)) {
                    echo json_encode(array('error' => false, "data" => array('login_id' => $checklogin->id, 'name'=>$checklogin->name,'role' => $checklogin->role_id), "message" => "Success"));
                } else {
                    $json_data = "";
                    echo json_encode(array('error' => true, "message" => "Invalid Login Creadentials"));
                }
            } else {
                $json_data = "";
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
    public function punch_in(Request $request)
    {
        $postdata = file_get_contents("php://input");					
        $json = str_replace(array("\t","\n"), "", $postdata);
        $data1 = json_decode($json);
        $now = $request->time;
        try
        {
            $date = $request->date;;
            $punchincheck = Tbl_attendances::where('login_id', $request->login_id)
            ->where('date', $date)->exists();
            if ($punchincheck) 
            {
                echo json_encode(array('error' => true, "message" => "User Already Punch In"));
            }
            else
            {
                    if ($files = $request->file('image')) {
                        $name = $files->getClientOriginalName();
                        $files->move('uploads/', $name);
                        $puchin = new Tbl_attendances;
                        $puchin->login_id = $request->login_id;
                        $puchin->date = $date;
                        $puchin->punch_in = $now;
                        $puchin->punchin_lat = $request->punchin_lat;
                        $puchin->punchin_long = $request->punchin_long;
                        $puchin->punchin_image = $name;
                        $puchin->save();
                        $json_data = 1;
                        echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));
                    } else {
                        $json_data = 0;
                        echo json_encode(array('error' => true, "data" => $json_data, "message" => "Upload Image"));
                    }
            } 
        }
        catch (Exception $e)
        {
          echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));
        }
    }
    public function punchout(Request $request)
    {
        $postdata = file_get_contents("php://input");					
        $json = str_replace(array("\t","\n"), "", $postdata);
        $data1 = json_decode($json);
        $date = $request->date;
        $now=$request->time;
        try
        {
            $punchincheck = Tbl_attendances::where('login_id', $request->login_id)->where('date', $date)
            ->first();
            if ($punchincheck != null) 
            {
               
                    if ($files = $request->file('image')) 
                    {
                        $name = $files->getClientOriginalName();
                        $files->move('uploads/', $name);
                        $punchout = Tbl_attendances::where('login_id', $request->login_id)->where('date', $date)->first();
                        $punchout->punch_out = $now;
                        $punchout->punchout_lat = $request->punchout_lat;
                        $punchout->punchout_long = $request->punchout_long;
                        $punchout->punch_out_image = $name;
                        $punchout->save();
                        $json_data = 1;
                        echo json_encode(array('error' => false, "data" => $json_data, "message" => "Success"));
                    } else {
                        $json_data = 0;
                        echo json_encode(array('error' => true, "data" => $json_data, "message" => "Upload Image"));
                    }
                
            } 
            else 
            {
                echo json_encode(array('error' => true, "message" => "Please Punch in First"));
            }
        }
        catch (Exception $e)
        {
          echo	json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));
        }
    }
    public function attendance_status() 
    {
        $postdata = file_get_contents("php://input");
        $json = str_replace(array("\t", "\n"), "", $postdata);
        $data1 = json_decode($json);
        $login_id = $data1->login_id;
        $today = date('Y-m-d');
        try {
            $punchincheck = DB::table('tbl_attendances')->where('login_id', $login_id)->select('punch_in')->whereNotNull('punch_in')->where('date', $today)->exists();
            $punchoutcheck = DB::table('tbl_attendances')->where('login_id', $login_id)->select('punch_out')->where('date', $today)->whereNotNull('punch_out')->exists();
            if ($punchincheck) {
                echo json_encode(array('error' => true, "data" => array('punch_in' => $punchincheck, 'punch_out' => $punchoutcheck), "message" => "Error"));
            } else if ($punchoutcheck) {
                echo json_encode(array('error' => true, "data" => array('punch_in' => $punchincheck, 'punch_out' => $punchoutcheck), "message" => "Error"));
            } else {
                echo json_encode(array('error' => true, "data" => array('punch_in' => $punchincheck, 'punch_out' => $punchoutcheck), "message" => "Error"));
            }
        }
        catch(Exception $e) {
            echo json_encode(array('error' => true, "message" => "Sorry! Please check input parameters and values"));
        }
    }
}
