<?php
namespace App\Http\Controllers;
use App\Appmodel;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller {
    public function index(){
        $users = DB::select('select * from hrusers');
        $data['totaluser']=count($users);
         $userss = DB::select("SELECT * FROM `hrusers` WHERE `UserStatus` = 'employee'");
         $data['totalemp']=count($userss);

         $user = DB::select("SELECT * FROM `hrusers` WHERE `UserStatus` = 'hr'");
         $data['totalhr']=count($user);
         $usemr = DB::select("SELECT * FROM `hrusers` WHERE `UserStatus` = 'manager'");
         $data['totalmanager']=count($usemr);
        return view('dashboard',$data);
    }
    public function insertUser(){
        $data['msg']='';
        return view('users/insertform',$data);
    } 
     public function usersCreate(Request $request){
        $authEmail = $request->session()->get('Loginemail');
        $loginname = $request->session()->get('loginname');
        $adminId = $request->session()->get('LoginId');
        $authStatus = $request->session()->get('Status');

        $Email = $request->input('Email');
        $Status = $request->input('Status');
        $error = '';

        $tag = new Appmodel();
        $chk =$tag->authenticate($request);
        
        if($chk!=''){
          if((!empty($Email)) && (!empty($Status))){
            
            $em =$tag->checkEmailValidate($Email);          
            $ems =$tag->checkEmailExist($Email);
            if($em=='1' && $ems=='0'){
                $parts = explode('@', $Email);
                $uname=$parts[0];

               $to = DB::table('hrusers')->insertGetId(
                   array('Email' => $Email,
                         'UserStatus' => $Status,
                         'Status' => '3',
                         'UserName' => $Email,
                         )
                );

               $to1 = DB::table('hruserlogins')->insertGetId(
                   array('LoginProvider' => $Email,
                         'ProviderDisplayName' => $Email,
                         'UserId' => $to,
                         'Status' => '3',
                         )
                );


                DB::table('hrusers')
              ->where('id', $to)
              ->update(array('UserId' => $to)); 
                $url= 'http://trackit.cueserve.com/trackit-web/reset-password/'.$to;
               
              

            $toemail = $Email;
            $subject = "User Login Details";

            $message = "
            <html>
            <head>
            <title>Reset Password Details</title>
            </head>
            <body>
            <table border='1'>
            <tr>
            <th>Email : ".$Email." </th>
            </tr>
<tr>
            <th>Reset Password : ".$url." </th>
            </tr>
            </table>
            </body>
            </html>
            ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <bhavna@cueserve.com>' . "\r\n";
            //$headers .= 'Cc: myboss@example.com' . "\r\n";

            mail($toemail,$subject,$message,$headers);

              $userdetail = array(
                                  'Email' => $Email,
                                  'UserID' => $to  );
                    return redirect('users');
                 
            }else{
              if($ems=='1'){
                  $data['msg']='Email ID already Exist';
                 }
              else{
                  
                  $data['msg']='Invalid Email format';
              }
            }

          }
          else{$data['msg']='All Fields required';
          }
        }else{
           
         return redirect('index');
        }
        return view('users/insertform',$data);
                      
    }
  public function listUser(REQUEST $request){
       $tag = new Appmodel();
        $chk =$tag->authenticate($request);
         
        if($chk!=''){
           $users = DB::select('select * from hrusers');
        }else{
           return redirect('index');
        }
      return view('users/list',['users'=>$users]);
  }
  public function inactivelistUser(REQUEST $request){
       $tag = new Appmodel();
        $chk =$tag->authenticate($request);
       
        if($chk!=''){
           $users = DB::select('select * from hrusers');
        }else{
           return redirect('index');
        }
      return view('users/inactivelist',['users'=>$users]);
  }
   public function deleteUser(Request $request,$id){     
      $value = session()->get('Loginemail');
     
       if($value!=''){

         $users = DB::select('select * from hrusers where UserId = ?',[$id]);
                 if(!empty($users)){
          DB::table('hruserlogins')
              ->where('UserId', $id)
              ->update(array('Status' => '2'));           
          return redirect('users');
        }else{
            return redirect('users');          
        }
        }else{
            return redirect('index');
        } $users = DB::select('select * from hrusers');
        return view('users/list',['users'=>$users]);
    }
    
   public function getUser($id){
        $value = session()->get('Loginemail');  
              
        if($value!=''){
          $users = DB::select('select * from hrusers where UserId = ?',[$id]);
          if(empty($users)){
           return redirect('index');
          }
        }else{
          return redirect('index');
        }
        $data['msg']='';
        return view('users/editform',['users'=>$users],$data);  
    }
     public function getviewUser($id){
        $value = session()->get('Loginemail');  
           
        if($value!=''){
          $users = DB::select('select * from hrusers where UserId = ?',[$id]);
          if(empty($users)){
           return redirect('index');
          }
        }else{
          return redirect('index');
        }
        return view('users/viewform',['users'=>$users]);  
    }


     public function updateUser1(Request $request,$id){
       //print_r($_FILES['ProfileImage']['name']);die;
       $FirstName = $request->input('FirstName');
      $LastName = $request->input('LastName');
      $PersonalEmail = $request->input('PersonalEmail');
      $NormalizedUserName = $request->input('NormalizedUserName');
      $PhoneNumber = $request->input('PhoneNumber');
      $ReferencePhoneNumber = $request->input('ReferencePhoneNumber');
      $BirthDate = date("Y-m-d", strtotime($request->input('BirthDate')));
      $AnniversaryDate = date("Y-m-d", strtotime($request->input('AnniversaryDate')));
      $EmergencyContactPerson = $request->input('EmergencyContactPerson');
      $BloodGroup = $request->input('BloodGroup');
      $FacebookId = $request->input('FacebookId');
      $FacebookPageLike = $request->input('FacebookPageLike');
      $LinkedIn = $request->input('LinkedIn');
      $Address = $request->input('Address');

      $adminId = $request->session()->get('LoginId');
       $tag = new Appmodel();
        $chk =$tag->authenticate($request);
       
        if($chk!=''){
          if((!empty($FirstName)) && (!empty($LastName)) &&
           (!empty($PhoneNumber)) && (!empty($ReferencePhoneNumber)) && (!empty($BirthDate)) && (!empty($EmergencyContactPerson)) && (!empty($Address))){
             $em =$tag->checkEmailValidate($PersonalEmail); 
             $ems =$tag->checkEmailExistPersonal($PersonalEmail);  
               if($em=='1' && $ems=='0'){

                 $users = DB::select('select * from hrusers where UserId = ?',[$id]);
                 if(!empty($users)){
                     DB::table('hrusers')
                  ->where('UserId', $id)
                  ->update(array('FirstName' => $FirstName,
                         'LastName' => $LastName,
                         'PersonalEmail' => $PersonalEmail,
                         'NormalizedUserName' => $NormalizedUserName,
                         'PhoneNumber' => $PhoneNumber,
                         'ReferencePhoneNumber' => $ReferencePhoneNumber,
                         'BirthDate' => $BirthDate,
                         'AnniversaryDate' => $AnniversaryDate,
                         'EmergencyContactPerson' => $EmergencyContactPerson,
                         'BloodGroup' => $BloodGroup,
                         'FacebookId' => $FacebookId,
                         'FacebookPageLike' => $FacebookPageLike,
                         'LinkedIn' => $LinkedIn,
                         'Address' => $Address,
                         ));


                    $users = DB::select('select * from hrusers where UserId = ?',[$id]);

                    return redirect('users');
                  }else{
                    return redirect('users');
                 }
               

               }else{//envalid email
                   return redirect('users');
               }  
          }else{
             return redirect('users');
          }
        }else{
           return redirect('index');
        }
        $users = DB::select('select * from hrusers where UserId = ?',[$id]);
        return view('users/editform',['users'=>$users],$data);  
    }
  public function updateUser(Request $request,$id){
       //print_r($_FILES['ProfileImage']['name']);die;
       $FirstName = $request->input('FirstName');
      $LastName = $request->input('LastName');
      $PersonalEmail = $request->input('PersonalEmail');
      $NormalizedUserName = $request->input('NormalizedUserName');
      $PhoneNumber = $request->input('PhoneNumber');
      $ReferencePhoneNumber = $request->input('ReferencePhoneNumber');
      $BirthDate = date("Y-m-d", strtotime($request->input('BirthDate')));
      $AnniversaryDate = date("Y-m-d", strtotime($request->input('AnniversaryDate')));
      $EmergencyContactPerson = $request->input('EmergencyContactPerson');
      $BloodGroup = $request->input('BloodGroup');
      $FacebookId = $request->input('FacebookId');
      $FacebookPageLike = $request->input('FacebookPageLike');
      $LinkedIn = $request->input('LinkedIn');
      $Address = $request->input('Address');
      $gender = $request->input('gender');
      $marriedstatus = $request->input('marriedstatus');
      $SpouseName = $request->input('SpouseName');
      $SpouseContact = $request->input('SpouseContact');
 $Relation= $request->input('Relation');

      $adminId = $request->session()->get('LoginId');
       $tag = new Appmodel();
        $chk =$tag->authenticate($request);
       
        if($chk!=''){
          if((!empty($FirstName)) && (!empty($LastName)) && (!empty($gender)) &&
           (!empty($PhoneNumber)) && (!empty($BirthDate)) && (!empty($Address))){
             $em =$tag->checkEmailValidate($PersonalEmail); 
             $ems =$tag->checkEmailExistPersonal($PersonalEmail,$id);  
             // && $ems=='0'
               if($em=='1' && $ems=='0'){

                 $users = DB::select('select * from hrusers where UserId = ?',[$id]);
                 if(!empty($users)){
                    $image = $request->file('image');
                    if($image==''){
			$img=$request->input('oldimg');
                    }else{
                        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                        $destinationPath = public_path('/images');
                        $image->move($destinationPath, $input['imagename']);
					 
			if($image!=''){
                            $img=$input['imagename'];
			}else{
			    $img=$request->input('oldimg');
                             }
			}
                     DB::table('hrusers')
                        ->where('UserId', $id)
                        ->update(array('FirstName' => $FirstName,
                         'LastName' => $LastName,
                         'PersonalEmail' => $PersonalEmail,
                         'NormalizedUserName' => $NormalizedUserName,
                         'PhoneNumber' => $PhoneNumber,
                         'ReferencePhoneNumber' => $ReferencePhoneNumber,
                         'BirthDate' => $BirthDate,
                         'AnniversaryDate' => $AnniversaryDate,
                         'EmergencyContactPerson' => $EmergencyContactPerson,
                         'BloodGroup' => $BloodGroup,
                         'FacebookId' => $FacebookId,
                         'FacebookPageLike' => $FacebookPageLike,
                         'LinkedIn' => $LinkedIn,
                         'Address' => $Address,
                         'ProfileImage'=>$img,
                         'Gender' => $gender,
                         'MaritalStatus' => $marriedstatus,
                         'SpouseName' => $SpouseName,
                         'SpouseContact' => $SpouseContact,
'ContactRelation' => $Relation,
                         ));

                         
                    /* --- Histroy logs --- */
                     $date = date('Y-m-d H:i:s');
                     $historyusers = DB::select('select * from hremployeehistory where UserId = ?',[$id]);
                     if(!empty($historyusers)){
                         //update
                        DB::table('hremployeehistory')
                        ->where('UserId', $id)
                        ->update(array('PersonalEmail' => $PersonalEmail,
                        'FirstName' => $FirstName,
                        'LastName' => $LastName,
                        'PhoneNumber' => $PhoneNumber,
                        'ReferencePhoneNumber' => $ReferencePhoneNumber,
                        'BirthDate' => $BirthDate,
                        'AnniversaryDate' => $AnniversaryDate,
                        'EmergencyContactNo' => $EmergencyContactPerson,
                        'BloodGroup' => $BloodGroup,
                        'FacebookId' => $FacebookId,
                        'FacebookPageLike' => $FacebookPageLike,
                        'LinkedIn' => $LinkedIn,
                        'Address' => $Address,
                        'Created' => $date,
                        'ProfileImage' => $img,                      
                         ));
                     }else{
                         //insert
                         
                         DB::table('hremployeehistory')->insert(
                        array('PersonalEmail' => $PersonalEmail,
                         'FirstName' => $FirstName,
                         'LastName' => $LastName,
                         'PhoneNumber' => $PhoneNumber,
                         'ReferencePhoneNumber' => $ReferencePhoneNumber,
                         'BirthDate' => $BirthDate,
                         'AnniversaryDate' => $AnniversaryDate,
                         'EmergencyContactNo' => $EmergencyContactPerson,
                         'BloodGroup' => $BloodGroup,
                         'FacebookId' => $FacebookId,
                         'FacebookPageLike' => $FacebookPageLike,
                         'LinkedIn' => $LinkedIn,
                         'Address' => $Address,
                         'Created' => $date,
                         'ProfileImage' => $img, 
                         'UserId' => $id,
                          )
                         );
                     }
                     
                     DB::table('hremployeehistryold')->insert(
                        array('PersonalEmail' => $PersonalEmail,
                         'FirstName' => $FirstName,
                         'LastName' => $LastName,
                         'PhoneNumber' => $PhoneNumber,
                         'ReferencePhoneNumber' => $ReferencePhoneNumber,
                         'BirthDate' => $BirthDate,
                         'AnniversaryDate' => $AnniversaryDate,
                         'EmergencyContactNo' => $EmergencyContactPerson,
                         'BloodGroup' => $BloodGroup,
                         'FacebookId' => $FacebookId,
                         'FacebookPageLike' => $FacebookPageLike,
                         'LinkedIn' => $LinkedIn,
                         'Address' => $Address,
                         'Created' => $date,
                         'ProfileImage' => $img, 
                         'UserId' => $id,
                          )
                         );
                     
                     
                    /* ---- Ended Code ---- */

                    $users = DB::select('select * from hrusers where UserId = ?',[$id]);

                    return redirect('view-user/'.$id);
                  }else{
                    return redirect('view-user/'.$id);
                 }
               

               }else{//envalid email
                   if($ems=='1'){
                       $data['msg']='Email Id already exist.';
                   }
                   //return redirect('users');
               }  
          }else{
             return redirect('view-user/'.$id);
          }
        }else{
           return redirect('index');
        }
        $users = DB::select('select * from hrusers where UserId = ?',[$id]);
        return view('users/editform',['users'=>$users],$data);  
    }



public function editprofile(Request $request){


 $id=$request->session()->get('LoginId');

       $FirstName = $request->input('FirstName');
      $LastName = $request->input('LastName');
      $PersonalEmail = $request->input('PersonalEmail');
      $NormalizedUserName = $request->input('NormalizedUserName');
      $PhoneNumber = $request->input('PhoneNumber');
      $ReferencePhoneNumber = $request->input('ReferencePhoneNumber');
      $BirthDate = date("Y-m-d", strtotime($request->input('BirthDate')));
      $AnniversaryDate = date("Y-m-d", strtotime($request->input('AnniversaryDate')));
      $EmergencyContactPerson = $request->input('EmergencyContactPerson');
      $BloodGroup = $request->input('BloodGroup');
      $FacebookId = $request->input('FacebookId');
      $FacebookPageLike = $request->input('FacebookPageLike');
      $LinkedIn = $request->input('LinkedIn');
      $Address = $request->input('Address'); $Relation= $request->input('Relation');
      
      /*----*/
      $gender = $request->input('gender');
      $marriedstatus = $request->input('marriedstatus');
      $SpouseName = $request->input('SpouseName');
      $SpouseContact = $request->input('SpouseContact');
		/*----*/
      $adminId = $request->session()->get('LoginId');
       $tag = new Appmodel();
        $chk =$tag->authenticate($request);
       
        if($chk!=''){
          if((!empty($FirstName)) && (!empty($LastName)) && (!empty($gender)) &&
           (!empty($PhoneNumber)) && (!empty($BirthDate)) && (!empty($Address))){
             $em =$tag->checkEmailValidate($PersonalEmail); 
             $ems =$tag->checkEmailExistPersonal($PersonalEmail,$id);  
             // && $ems=='0'
               if($em=='1' && $ems=='0'){

                 $users = DB::select('select * from hrusers where UserId = ?',[$id]);
                 if(!empty($users)){
                    $image = $request->file('image');
                    if($image==''){
			$img=$request->input('oldimg');
                    }else{
                        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                        $destinationPath = public_path('/images');
                        $image->move($destinationPath, $input['imagename']);
					 
			if($image!=''){
                            $img=$input['imagename'];
			}else{
			    $img=$request->input('oldimg');
                             }
			}

DB::table('hruserlogins')
                            ->where('UserId', $id)
                            ->update(array('Status' => '0',
                            ));

                    DB::table('hrusers')
                        ->where('UserId', $id)
                        ->update(array('FirstName' => $FirstName,
                         'LastName' => $LastName,
                         'PersonalEmail' => $PersonalEmail,
                         'NormalizedUserName' => $NormalizedUserName,
                         'PhoneNumber' => $PhoneNumber,
                         'ReferencePhoneNumber' => $ReferencePhoneNumber,
                         'BirthDate' => $BirthDate,
                         'AnniversaryDate' => $AnniversaryDate,
                         'EmergencyContactPerson' => $EmergencyContactPerson,
                         'BloodGroup' => $BloodGroup,
                         'FacebookId' => $FacebookId,
                         'FacebookPageLike' => $FacebookPageLike,
                         'LinkedIn' => $LinkedIn,
                         'Address' => $Address,
                         'ProfileImage'=>$img,
                         'Gender' => $gender,
                         'MaritalStatus' => $marriedstatus,
                         'SpouseName' => $SpouseName,
                         'SpouseContact' => $SpouseContact,
'ContactRelation'=>$Relation,
'ContactRelation'=>$Relation,'Status'=>'0',
                         ));

                         
                   

                    $users = DB::select('select * from hrusers where UserId = ?',[$id]);

                    return redirect('profile');
                  }else{
                    return redirect('profile');
                 }
               

               }else{//envalid email
                   if($ems=='1'){
                       $data['msg']='Email Id already exist.';
                   }
                   //return redirect('users');
               }  
          }else{
             return redirect('profile');
          }
        }else{
           return redirect('index');
        }
        $users = DB::select('select * from hrusers where UserId = ?',[$id]);
        
        return view('users/profile',['users'=>$users],$data);
    }
 public function profile(Request $request){
$id=$request->session()->get('LoginId');

       
       $tag = new Appmodel();
        $chk =$tag->authenticate($request);
       
        if($chk==''){
return redirect('index');
        }
        $users = DB::select('select * from hrusers where UserId = ?',[$id]);
$data['msg']='';
        return view('users/profile',['users'=>$users],$data);  
    }





     public function logout(Request $request){
      
      session_unset();
      $value = $request->session()->forget('Loginemail');
      $request->session()->forget('loginname');
      $request->session()->forget('LoginId');
      $request->session()->forget('Status');
      return redirect('index');
    }
   public function changePassword(Request $request){
        $data['msg']=''; $data['succmsg']='';
        $oldPassword = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');
        $ConfirmPassword = $request->input('ConfirmPassword');
        
        $loginemail = $request->session()->get('Loginemail');
        $LoginId = $request->session()->get('LoginId');
        
        $tag = new Appmodel();
        $chk =$tag->authenticate($request);
        if($chk==''){ return redirect('index'); }
        if($oldPassword!='' && $newPassword!=''){
            $encPassword=base64_encode($oldPassword);
            $emp = DB::table('hruserlogins')->where('UserID',$LoginId)->where("ProviderKey",$encPassword)->get();
            if(!empty($emp)){
                $newPassword=base64_encode($newPassword);
                $ConfirmPassword=base64_encode($ConfirmPassword);
                
                if($newPassword==$ConfirmPassword){
                    DB::table('hrusers')
                  ->where('UserId', $LoginId)
                  ->update(array('PasswordHash' => $newPassword,
                         ));
                       DB::table('hruserlogins')
                  ->where('UserId', $LoginId)
                  ->update(array('ProviderKey' => $newPassword,
                         ));
                    $data['succmsg']='Change Password successfully.';
                }else{
                    $data['msg']='New password and confirm password does not match';
                }
            }else{
                $data['msg']='Old Password does not match.';
            }
        }else{
            //$data['msg']='All fields required.';
            
        }
        return view('users/changepassword',$data);
    }
   public function historyLog(Request $request,$id){
        
        $value = session()->get('Loginemail');  
       
              
        if($value!=''){
         $users = DB::table('hremployeehistryold')->where('UserId',$id)->orderBy('Id', 'desc')->get();
           
          $log=array();
          if(empty($users)){
               $users=array();
          }
          }else{
              return redirect('index');
          }
          $data['uid']=$id;
         
        return view('users/historylog',['users'=>$users],$data);  
    } 
    public function activateUser(Request $request,$id){     
      $value = session()->get('Loginemail');
     
       if($value!=''){

         $users = DB::select('select * from hrusers where UserId = ?',[$id]);
                 if(!empty($users)){
          DB::table('hruserlogins')
              ->where('UserId', $id)
              ->update(array('Status' => '0'));   
              
               DB::table('hrusers')
              ->where('UserId', $id)
              ->update(array('Status' => '0'));   
                        
          return 3;//success
        }else{
            return 3;          
        }
        }else{
            return 2; //not login
        } return 1;//success
    }
    
   
}












