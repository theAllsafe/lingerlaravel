<?php

namespace App\Http\Controllers\AppApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TempUser;
use Hash;
use Validator;
use DB;
use Mail;

class AuthController extends Controller
{
	public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function signup( Request $request ){
		
		
		$rules = [

            'first_name'            =>'required|min:2',
            
            'last_name'             =>'required|min:2',
            
            'mobile_no'             =>'required|min:8',

            'email'  			    =>'required|email|unique:users',

            'password'              =>'required|min:6',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=>false,'code'=>$this->valerrorStatus, 'message'=>$validation->errors()->first() ] , $this->valerrorStatus );

        } 
        if( !User::where( 'email', $request->email )->first() ){
            $otp= rand(1000,9999);
			$request->merge( [ 'otp'=>$otp,'name'=>$request->first_name." ".$request->last_name]);
			$request[ 'password' ] = Hash::make( $request->password );
			
// 			print_r("qwe"); exit;
			$user = TempUser::create( $request->all() );
			$apiToken=$user->createToken('auth_token')->accessToken;
			$data = [
            'otp' => $otp
            ];
            $email = array('email' => $request->input('email'));
            
            Mail::send('mail', $data, function($message) use ($email){
                $message->subject('OTP for registration');
                $message->to($email['email']);
                $message->from('dheeraj@theallsafe.com','Linger');
            });
			return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Signup successful','user'=>$user,'token'=>$apiToken],$this->successStatus);
            
        }
        else{

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'!Wrong' ] , $this->errorStatus );
        
        }
		
	}
	public function signin( Request $request ){
		
		$rules = [

            'email'          =>'required',

            'password'       =>'required|min:6',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'success'=>false,'code'=>$this->valerrorStatus, 'message'=>$validation->errors()->first() ] , $this->valerrorStatus );

        }
		$user = User::where( 'email', $request->email )->orWhere( 'mobile_no', $request->email )->first();
		if( $user && Hash::check( $request->password, $user->password) && $user->role==2){
			$otp= rand(1000,9999);
			$data = [
            'otp' => $otp
            ];
            $email = array('email' => $request->input('email'));
            
            // Mail::send('mail', $data, function($message) use ($email){
            //     $message->subject('signin');
            // $message->to($email['email']);
            // $message->from('dheeraj@8bittask.com','Linger');
            // });
            // $data_update[ 'otp' ] = $otp;
            // User::where( ['email'=>$email['email']] )->update( $data_update );
			$apiToken=$user->createToken('token')->accessToken;
			return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Login successful','user'=>$user,'token'=>$apiToken],$this->successStatus);
            
		}
		
		return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'Wrong email and password combination' ] , $this->errorStatus );
        
	}
	
	public function otp_verification( Request $request ){
		
		$rules = [

            'user_id'  =>'required',

            'otp'      =>'required|min:4'

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>$validation->errors()->first() ]);

        }
		
		$TempUser = TempUser::where( ['id'=>$request->user_id] )->first();
		if( !User::where( 'email', $TempUser->email )->first() ){
    	if($TempUser)
    	{
    	    $create['name']=$TempUser->name;
    	    $create['email']=$TempUser->email;
    		$create['mobile_no']=$TempUser->mobile_no;
    		$create['password']=$TempUser->password;
    		$create['role']=2;
    		$create['login_status']=1;
    // 		if( $user->otp==$request->otp){
    		if($TempUser->otp==$request->otp){
            // if( $user->otp==1111){
    			
    			$user = User::create($create);
    			$token = $user->createToken( env( 'ACCESS_TOKEN' ) )->accessToken;
    			return response( [ 'status'=>true, 'statuscode'=> 200, 'massage'=> 'Otp verification successful', 'data'=>$user, '_access_token'=>$token ]  );
    			
    		}else{
    		    return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>'Wrong otp' ] , 200 );
    		}
    	}
		}else{
		    return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>'Email already sign up' ] , 200 );
		}
		return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>'Wrong user Id' ] , 200 );
		
	}
	
	public function studentlist()
    {
        $users=User::join('tbl_student','tbl_student.sid','=','users.id')->where('users.role','3')->get();
        if( count( $users ) > 0 ){
		
			return response( [  'success'=>true, 'message'=>'Student found', 'student'=>$users ], 200 );
		
		}
		
		return response( [ 'success'=>false, 'message'=>'Student Not found', 'student'=>[] ], 200 );
    }
    
	public function schoollist(){
	    $user_id=$_GET['user_id'];
        if($_GET){
            $school_name=$_GET['school_name'];
            $city=$_GET['city'];
            if($city){
                $school = User::join('tbl_institute','users.id','=','tbl_institute.institute_id')->where( 'users.role', '2' )->where('tbl_institute.city','LIKE','%'.$city.'%')->select( 'users.id as uid','users.name','users.image','users.mobile_number','users.about','users.email','tbl_institute.*')->get()->toArray();   
            }else{
                $school = User::join('tbl_institute','users.id','=','tbl_institute.institute_id')->where( 'users.role', '2' )->where('users.name','LIKE','%'.$school_name.'%')->select( 'users.id as uid','users.name','users.image','users.mobile_number','users.about','users.email','tbl_institute.*')->get()->toArray();   
            }
        }else{
            $school = User::join('tbl_institute','tbl_institute.institute_id','=','users.id')->where( 'users.role', '2' )->select( 'users.id as uid','users.name','users.image','users.mobile_number','users.about','users.email','tbl_institute.*')->get()->toArray();
        }
        if($school){
            $school=$this->like($school,$user_id);
        }
        if( count( $school ) > 0 ){
            return response( [ 'success'=>true,'message'=>'School found', 'data'=>$school ], 200 );
        }else{
            return response( [ 'success'=>false,'message'=>'School Not found', 'data'=>[] ], 200 );
        }
	}
	
	public function like($data,$user_id)
    {
        if ($data) {
            $x = array_map(function ($index) use ($user_id) {
                $newdata = Like::where(['school_id' => $index['uid'],'user_id' => $user_id])->get();
                $index['Like'] = $newdata;
                return $index;
            }, $data);
        }
            return $x;
    }
	
	public function school_like( Request $request ){
		
		
		$rules = [
            'school_id'          =>'required',
            
            'user_id'          =>'required',
            
            'is_like'          =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false, 'message'=>$validation->messages()->first() ] , 200 );

        } 
            $data['is_like']=$request->is_like;
            if( Like::where( ['school_id'=>$request->school_id,'user_id'=>$request->user_id] )->update( $data )){
    			return response( [ 'success'=>true, 'message'=>'updated successfully' ] , 200 );
    			
    		}
			$add2= new Like;
			$add2->school_id=$request->input('school_id');
            $add2->user_id=$request->input('user_id');
            $add2->is_like=$request->input('is_like');
            $add2->save();
			return response( [ 'success'=>true, 'message'=>'Add successfull'],200 );
            
		
	}
	
	public function favorite(){
	    $user_id=$_GET['user_id'];
        if($_GET){
            $school_name=$_GET['school_name'];
            $city=$_GET['city'];
            if($city){
                $school = User::join('tbl_institute','users.id','=','tbl_institute.institute_id')->join('tbl_school_like','users.id','=','tbl_school_like.school_id')->where(['tbl_school_like.user_id'=>$user_id,'users.role'=>'2'])->where('tbl_institute.city','LIKE','%'.$city.'%')->select( 'tbl_school_like.is_like','users.id as uid','users.name','users.image','users.mobile_number','users.about','users.email','tbl_institute.*')->get()->toArray();   
            }else{
                $school = User::join('tbl_institute','users.id','=','tbl_institute.institute_id')->join('tbl_school_like','users.id','=','tbl_school_like.school_id')->where(['tbl_school_like.user_id'=>$user_id,'users.role'=>'2'])->where('users.name','LIKE','%'.$school_name.'%')->select( 'tbl_school_like.is_like','users.id as uid','users.name','users.image','users.mobile_number','users.about','users.email','tbl_institute.*')->get()->toArray();   
            }
        }else{
            $school = User::join('tbl_institute','tbl_institute.institute_id','=','users.id')->join('tbl_school_like','users.id','=','tbl_school_like.school_id')->where(['tbl_school_like.user_id'=>$user_id,'users.role'=>'2'])->select( 'tbl_school_like.is_like','users.id as uid','users.name','users.image','users.mobile_number','users.about','users.email','tbl_institute.*')->get()->toArray();
        }
        if( count( $school ) > 0 ){
            return response( [ 'success'=>true,'message'=>'School found', 'data'=>$school ], 200 );
        }else{
            return response( [ 'success'=>false,'message'=>'School Not found', 'data'=>[] ], 200 );
        }
	}
}
