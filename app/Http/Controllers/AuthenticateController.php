<?php
namespace App\Http\Controllers;
use App\Appmodel;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthenticateController extends Controller {
    public function index(){
        $data['msg']='';
        return view('users/login',$data);
    }
    public function login(Request $request){
        $data['msg']='';
      $Email = $request->input('email');
      $Password = $request->input('password');
     
      $encPassword=base64_encode($Password);
      if($Email=='itadmin@cueserve.com'){
         $emp = DB::table('hruserlogins')->where('LoginProvider',$Email)->where("ProviderKey",$encPassword)->where("Status",'1')->get();
         if (empty($emp)){
             $data['msg']='Unauthenticate User.';
          }
         else{
             foreach ($emp as $svalue) {
                   $eml=$svalue->LoginProvider;                
                   $name=$svalue->ProviderDisplayName;
                   $id=$svalue->UserId;
                    $status=$svalue->Status;
                    $key=mt_rand();
                      DB::table('hruserlogins')
                      ->where('UserId', $id)
                      ->update(array('Accesstoken' => $key));

                   $request->session()->put('Loginemail', $eml);
                   $request->session()->put('loginname', $name);
                   $request->session()->put('LoginId', $id);
                    $request->session()->put('Status', $status);
                   $userdetail=array(
                      'ID'=>$id,
                      'Email'=>$eml,
                      'Username'=>$name,
                      'Status'=>$svalue->Status,
                      'Accesstoken'=>$key,
                    );
                    return redirect('dashboard');
                 }
         }
         
      }else{
          
            $encPassword=base64_encode($Password);

            $emp = DB::table('hruserlogins')->where('LoginProvider',$Email)->where("ProviderKey",$encPassword)->get();
          if (empty($emp)){
             $data['msg']='Unauthenticate User.';
          }else{ foreach ($emp as $svalue) {
                   $eml=$svalue->LoginProvider;                
                   $name=$svalue->ProviderDisplayName;
                   $id=$svalue->UserId;
                    $status=$svalue->Status;
                    $key=mt_rand();
                        DB::table('hruserlogins')
                        ->where('UserId', $id)
                        ->update(array('Accesstoken' => $key)); 

                   $request->session()->put('Loginemail', $eml);
                   $request->session()->put('loginname', $name);
                   $request->session()->put('LoginId', $id);
                    $request->session()->put('Status', $status);
                   $userdetail=array(
                      'ID'=>$id,
                      'Email'=>$eml,
                      'Username'=>$name,
                      'Status'=>$svalue->Status,
                      'Accesstoken'=>$key,
                    );

                  if($status=='3'){
                    return redirect('profile');
                  }else {
                   return redirect('dashboard');
                  }
                } 
          }

          
      }
      
        return view('users/login',$data);
                
    }
   public function forgotPassword(Request $request){
        $data['msg']='';
        $emailid = $request->input('emailid');        
           
        return view('users/login',$data);    
    }
    public function ajaxforgotPassword(Request $request){
        $emailid = $request->input('emailid');
        $tag = new Appmodel();
         $em =$tag->checkEmailValidate($emailid); 
         if($em=='1'){
            $users = DB::select('select * from hrusers where Email = ?',[$emailid]);
            if(!empty($users)){
             $uid=$users[0]->Id; 
             if($uid!=''){
                 $url= 'http://trackit.cueserve.com/trackit-web/reset-password/'.$uid;
                 
                
               $toemail = $emailid;
                $subject = "Reset Password - TrackIt";

                $message = "Reset Password Url : ".$url;

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <bhavna@cueserve.com>' . "\r\n";

                mail($toemail,$subject,$message,$headers);
                 
                 $data['url']=$url;
                 $data['success']='1';
                 echo json_encode($data);
                 
                 
             }
            }else{
                echo json_encode('2');
            }    
         }else{
             echo json_encode('1');
         }
    }
   public function resetPassword(Request $request,$id){


        $data['msg']='';
        $newpassword = $request->input('newpassword');
        $confirmpassword = $request->input('confirmpassword');

        $data['succmsg']='';
        if($confirmpassword!='' && $newpassword!=''){
            $newpassword = base64_encode($request->input('newpassword'));
            $confirmpassword = base64_encode($request->input('confirmpassword'));
             $users = DB::select('select * from hrusers where UserId = ?',[$id]);
             if(!empty($users)){
                if($newpassword==$confirmpassword){
                    
                      DB::table('hrusers')
                  ->where('UserId', $id)
                  ->update(array('PasswordHash' => $newpassword,
                         ));
                       DB::table('hruserlogins')
                  ->where('UserId', $id)
                  ->update(array('ProviderKey' => $newpassword,
                         ));
                       $data['succmsg']='Reset password successfully.Please Login with new password';
                }else{
                    $data['msg']='Password and Confirm password does not match.';
                }
             }else{
                $data['msg']='User Not Exist';
             }
        }else{
           // $data['msg']='Please all fields required';
        }

       $data['id']=$id;
        return view('users/resetpassword',$data);          
    }


}












