<?php

namespace App\Http\Controllers;

use App\Models\User; 
use App\Models\Attendance; 
use App\Models\Project; 
use App\Models\Visit; 
use Validator;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Auth; 
use Hash;
use DB;
use Laravel\Passport\Client as OClient; 
use Illuminate\Support\Facades\Http;
class ApiController extends Controller
{
    public $successStatus = 200;
    
    // User Login
    public function login(Request $request)
    {
        $rules = [

            'email'          =>'required',

            'password'          =>'required'

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'error'=>true, 'status'=> 400, 'msg'=>$validation->errors() ] , 400 );

        }
        
        $user = User::join('departments','departments.id','=','users.department_id')
	                ->join('designations','designations.id','=','users.designation_id')
	                ->select('users.*','departments.department_name','designations.designation_name')->where('users.email', $request->email )->where('users.login_status',1)->first();
            
        if( $user && Hash::check( $request->password, $user->password ) ){
            
            $token = $user->createToken('token')->accessToken;
            
            // Cookie::queue('_token', $token, 10);
            
            return response( [ 'error'=>false, 'status'=> 200, 'msg'=> 'Login successful', 'data'=>$user, '_access_token'=>$token ] , 200 );
            
        }
        
        return response( [ 'error'=>true, 'status'=> 400, 'msg'=>'Wrong username / email and password combination','data'=>[] ] , 400 );

    }
    
    public function profile(Request $request)
    {
        
		$data = User::join('departments','departments.id','=','users.department_id')
	                ->join('designations','designations.id','=','users.designation_id')
	                ->select('users.*','departments.department_name','designations.designation_name')
	                ->where(['users.id'=>$request->user()->id])->first()->toArray();
	    $data['status']="";
	    $status=Attendance::where('uid',$request->user()->id)->orderBy('id', 'DESC')->first();
	    if($status){
		
			$data['status']=$status->action;
		
		}
        	
		if( count( $data ) > 0 ){
		
			return response( [ 'error'=>false, 'status'=> 200, 'msg'=> 'Data Found', 'user'=>$data ] , 200 );
		
		}
		
		return response( [ 'error'=>true, 'status'=> 400, 'msg'=>'Data Not Found' ] , 200 );
		
	}
	
	public function attendance(Request $request)
	{
	    $rules = [

            'latitude'          =>'required',
            
            'longitude'          =>'required',

            'action'          =>'required',
            
            // 'time'          =>'required',
            
            'date'          =>'required'

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'error'=>true, 'status'=> 400, 'msg'=>$validation->errors() ] , 200 );

        }
        date_default_timezone_set("Asia/Calcutta");
        $add1= new Attendance;
        // where('date','LIKE','%'.date("Y-m-d").'%')->
        $data = Attendance::where('action',$request->input('action'))->where('uid',$request->user()->id)->orderBy('id', 'DESC')->get();
        if( count( $data ) > 0 )
        {
            $add1->periodId=$data[0]->periodId+1;
        }
            $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$request->input('latitude').','.$request->input('longitude').'&key=AIzaSyCQNHF1x6t170kqtU5yFaFpk2bFfvE8gdc';
            // Make the HTTP request
            // https://maps.googleapis.com/maps/api/geocode/json?latlng=19.017615,72.8561644&key=AIzaSyCQNHF1x6t170kqtU5yFaFpk2bFfvE8gdc
            $data = @file_get_contents($url);
            
            // print_r($data); exit;
            // Parse the json response
            $jsondata = json_decode($data);
            if($data)
            {
                $add1->location=$jsondata->results[0]->formatted_address; 
            }
        if($request->hasfile('img'))
        {
            $file=$request->file('img');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('admin_assets/upload',$filename);
            $add1->img=url('')."/admin_assets/upload/".$filename;
        }
        $add1->uid=$request->user()->id;
	    $add1->latitude=$request->input('latitude');
	    $add1->longitude=$request->input('longitude');
	    $add1->action=$request->input('action');
	   // $add1->time=$request->input('time');
	    $add1->date=$request->input('date');
        $add1->save();
            
        if($add1){
            
            return response( [ 'error'=>false, 'status'=> 200, 'msg'=> 'Add successful', 'data'=>$add1] , 200 );
            
        }
        
        return response( [ 'error'=>true, 'status'=> 400, 'msg'=>'Wrong !', 'data'=>[] ] , 200 );
		
	}
	
	public function getproject()
    {
		$data = Project::select("project_name as value")->where('status',1)->get()->toArray();
        	
		if( count( $data ) > 0 ){
		
			return response( [ 'error'=>false, 'status'=> 200, 'msg'=> 'Data Found', 'user'=>$data ] , 200 );
		
		}
		
		return response( [ 'error'=>true, 'status'=> 400, 'msg'=>'Data Not Found' ] , 200 );
		
	}
	
	public function savevisit(Request $request)
	{
	    $rules = [


            'name'         =>'required',
            
            'mobile_no'    =>'required',
            
            'address'      =>'required',
            
            'project_name' =>'required',

            'msg'          =>'required',
            
            'photo'        =>'required',
            
            'latitude'          =>'required',
            
            'longitude'          =>'required',
            
            

        ];

            

            // 'email'        =>'required',
           
        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'error'=>true, 'status'=> 400, 'msg'=>$validation->errors() ] , 200 );

        }
        $add1= new Visit;
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$request->input('latitude').','.$request->input('longitude').'&key=AIzaSyCQNHF1x6t170kqtU5yFaFpk2bFfvE8gdc';
        // Make the HTTP request
        // https://maps.googleapis.com/maps/api/geocode/json?latlng=19.017615,72.8561644&key=AIzaSyCQNHF1x6t170kqtU5yFaFpk2bFfvE8gdc
        $data = @file_get_contents($url);
        
        // print_r($data); exit;
        // Parse the json response
        $jsondata = json_decode($data);
        if($data)
        {
            $add1->location=$jsondata->results[0]->formatted_address; 
        }
        if($request->hasfile('photo'))
        {
            $file=$request->file('photo');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('admin_assets/upload',$filename);
            $add1->photo=url('')."/admin_assets/upload/".$filename;
        //   print_r($add1->photo); exit;
        }
        $add1->uid=$request->user()->id;
	    $add1->name=$request->input('name');
	    $add1->mobile_no=$request->input('mobile_no');
	    $add1->email=$request->input('email');
	    $add1->address=$request->input('address');
	    $add1->project_name=$request->input('project_name');
	    $add1->msg=$request->input('msg');
        $add1->save();
        $project = Project::select("*")->where("project_name",$request->input('project_name'))->first();
        $msg="Dear ".$request->input('name').",
        Thank you for visiting $project->project_name.
        $project->project_description

Thank you for coming to visit:

SHRI BALAJI CONSTRUCTION COMPANY
Mail us: sales@bccbuildtech.com
Call us: 1800 300 20 200
Lets Social:
Facebook: https://www.facebook.com/Shribalajiconstructioncompany
Instagram: https://www.instagram.com/shribalajiconstructionco/
Youtube: https://www.youtube.com/channel/UCGUeZL98WUTjPHnTbLlvorg";
        // print_r($msg); exit;
        // $msg=Http::get('http://scsy.in/balaji/');
        $response = Http::get('http://bulkwhatsapp.live/whatsapp/api/send?mobile='.$request->input('mobile_no').'&msg='.$msg.'&apikey=ed1cc8ca72fb4589988ee4a2b0b7b25d');
        if($add1){
            
            return response( [ 'error'=>false, 'status'=> 200, 'msg'=> 'Add successful', 'data'=>$add1] , 200 );
            
        }
        
        return response( [ 'error'=>true, 'status'=> 400, 'msg'=>'Wrong !', 'data'=>[] ] , 200 );
		
	}
	
	public function showattendance(Request $request)
    {
        $emp=$request->user()->id;
        $date=$request->date;
        
		$data = DB::select("select di.DayInTime,do.DayOutTime,di.location,TIMEDIFF(do.DayOutTime, di.DayInTime) as PeriodWorkedHours
        from
        (
            select uid, id,periodId, date as DayInTime,location
            from attendances
            where action = '1' AND date LIKE '%$date%' AND uid = '$emp'
        ) as di
        inner join (
            select uid, id,periodId, date as DayOutTime,location
            from attendances
            where action = '2'
        ) as do on di.uid = do.uid and di.periodId = do.periodId
        where do.DayOutTime LIKE '%$date%'");
        //  ORDER BY di.DayInTime DESC
		if( count( $data ) > 0 ){
		
			return response( [ 'error'=>false, 'status'=> 200, 'msg'=> 'Data Found', 'user'=>$data ] , 200 );
		
		}
		
		return response( [ 'error'=>true, 'status'=> 400, 'msg'=>'Data Not Found' ] , 200 );
		
	}
	
	public function visit(Request $request)
    {
        $id=$request->user()->id;
        if(isset($request->mobile_no))
        {
            
		    $data['visit'] = Visit::where(['uid'=>$id])->where(['mobile_no'=>$request->mobile_no])->orderBy('id', 'DESC')->get()->toArray();
            $visit_coun = Visit::where(['uid'=>$id])->where(['mobile_no'=>$request->mobile_no])->get()->count();
            $data['visit_count'] =$visit_coun+1;
        }else{
            $data['visit'] = Visit::where(['uid'=>$id])->orderBy('id', 'DESC')->get()->toArray();
            $data['visit_count'] = Visit::where(['uid'=>$id])->get()->count();
        }
		if( count( $data ) > 0 ){
		
			return response( [ 'error'=>false, 'status'=> 200, 'msg'=> 'Data Found', 'data'=>$data ] , 200 );
		
		}
		
		return response( [ 'error'=>true, 'status'=> 400, 'msg'=>'Data Not Found', 'data'=>[] ] , 200 );
		
	}
	
	public function punchout()
    {
        date_default_timezone_set("Asia/Calcutta");
        $add1=[];
        $punchin= Attendance::where('action','1')->get();
        foreach($punchin as $in)
        {
            $punchout= Attendance::where('uid',$in->uid)->where('action','2')->where('periodId',$in->periodId)->orderBy('id', 'DESC')->first();
            if($punchout)
            {
                response( [ 'error'=>true, 'status'=> 400, 'msg'=>'Wrong !', 'data'=>[] ] , 200 );
            }else{
                $add1= new Attendance;
                $add1->uid=$in->uid;
        	    $add1->latitude="19.017615";
        	    $add1->longitude="72.8561644";
        	    $add1->action=2;
        	    $add1->periodId=$in->periodId;
        	    $add1->date=date("Y-m-d H:m:s");
                $add1->save();
                // return response( [ 'error'=>false, 'status'=> 200, 'msg'=> 'Add successful', 'data'=>$add1] , 200 );
            }
        }
        // // where('date','LIKE','%'.date("Y-m-d").'%')->
        // $data = Attendance::where('action',$request->input('action'))->where('uid',$request->user()->id)->orderBy('id', 'DESC')->get();
        // if( count( $data ) > 0 )
        // {
        //     $add1->periodId=$data[0]->periodId+1;
        // }
        // $add1= new Attendance;
    //     $add1->uid=12;
	   // $add1->latitude="19.017615";
	   // $add1->longitude="72.8561644";
	   // $add1->action=3;
	   //// $add1->time=$request->input('time');
	   // $add1->date="2021-01-08";
    //     $add1->save();
            
        if($add1){
            
            return response( [ 'error'=>false, 'status'=> 200, 'msg'=> 'Add successful', 'data'=>$add1] , 200 );
            
        }
        
        return response( [ 'error'=>true, 'status'=> 400, 'msg'=>'Wrong !', 'data'=>[] ] , 200 );
		
	}
    
}