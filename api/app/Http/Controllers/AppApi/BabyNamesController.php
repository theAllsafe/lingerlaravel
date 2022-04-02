<?php

namespace App\Http\Controllers\AppApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Validator;
use DB;
use App\Models\BabyNames;
use Mail;

class BabyNamesController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function store( Request $request ){
        
        $rules = [

            'date'            =>'required',
            
            'time'            =>'required',
            
            'gender'          =>'required',
            
            'nickname'        =>'required',
            
            'city'            =>'required',

            'father_name'     =>'required',
            
            'mother_name'     =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=>false,'code'=>$this->valerrorStatus, 'message'=>$validation->errors()->first() ] , $this->valerrorStatus );

        } 
            
            $request->merge(['user_id'=>$request->user()->id]);         
            $add = BabyNames::create( $request->all() );
            
        if($add){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus); 
        }

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'!Wrong' ] , $this->errorStatus );
        
    }
    
    public function reply(Request $request)
    {
        
        $user = BabyNames::where( 'user_id',$request->user()->id)->orderBy('id','desc')->first();
        if($user)
        {

            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Data found','data'=>$user],$this->successStatus);
        
        }
        else{

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'!Data not found' ] , $this->errorStatus );
        
        }
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
