<?php

namespace App\Http\Controllers\AppApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\TimeSlot;
use App\Models\QuizzInfo;
use App\Models\Question;
use App\Models\Season;
use App\Models\Answer;
use App\Models\User;
use Hash;
use Validator;
use DB;
use Mail;
use Illuminate\Support\Facades\Http;

class QuizzController extends Controller
{
	public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function home(Request $request){
		$rules = [

            'latitude'          =>'required',
            
            'longitude'          =>'required'

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'error'=>true, 'status'=> 400, 'msg'=>$validation->errors() ] , 200 );

        }
        date_default_timezone_set("Asia/Calcutta");
         $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$request->input('latitude').','.$request->input('longitude').'&key=AIzaSyCQNHF1x6t170kqtU5yFaFpk2bFfvE8gdc';
        // Make the HTTP request
        // https://maps.googleapis.com/maps/api/geocode/json?latlng=19.017615,72.8561644&key=AIzaSyCQNHF1x6t170kqtU5yFaFpk2bFfvE8gdc
        $dataLocatio = @file_get_contents($url);
        $location="lucknow";
        // print_r($data); exit;
        // Parse the json response
        $jsondata = json_decode($dataLocatio);
        if($dataLocatio)
        {
            $location=$jsondata->results[4]->address_components[3]->long_name;
        }
        $ch = curl_init( );
        curl_setopt($ch, CURLOPT_URL, "https://dailyprayer.abdulrcs.repl.co/api/'".$location."'");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch); 
        $response = json_decode(str_replace("'","_",$result));
        $n = banner::where('type','5')->limit(5)->get()->toArray();
        if(isset($response->today)){
            $fajr=['fajr'=>$response->today->Fajr];
            $Dhuhr=['Dhuhr'=>$response->today->Dhuhr];
            $Asr=['Asr'=>$response->today->Asr];
            $Maghrib=['Maghrib'=>$response->today->Maghrib];
            $Isha=['Isha_a'=>$response->today->Isha_a];
            // $Isha=['Isha`a'=>$response->today->"Isha'a"];
            $arr=array_push($n[0],$fajr);
            $arr=array_push($n[1],$Dhuhr);
            $arr=array_push($n[2],$Asr);
            $arr=array_push($n[3],$Maghrib);
            $arr=array_push($n[4],$Isha);
        }

        $data['slider'] = banner::where('type',1)->get()->toArray();
        $data['namaz_time'] = $n;
        $data['per_of_the_day'] = banner::where('type',2)->first();
        $data['verse_of_the_day'] = banner::where('type',3)->first();
        $data['timeslot'] = TimeSlot::limit(2)->get();
        // $status=Attendance::where('uid',$request->user()->id)->orderBy('id', 'DESC')->first();            
        if( count( $data ) > 0 ){
			return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Data Found','data'=>$data],$this->successStatus);
            
        }
        else{

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'Data Not Found' ] , $this->errorStatus );
        
        }
		
	}

    public function price($data = array())
    {

        if ($data) {
            $x = array_map(function ($index) {
                $ch = curl_init( );
                curl_setopt($ch, CURLOPT_URL, "https://dailyprayer.abdulrcs.repl.co/api/lucknow");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                            curl_close($ch); 
                $response = json_decode($result);
                $newdata = $response->today;
                
                $index['namaz_time'] = $newdata;
                return $index;
            }, $data);
        }
            return $x;
    }

    public function note(Request $request)
    {
        $rules = [

            'language'   =>'required'

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
        $data=[];
        $language=$request->language;
        if($language==1){
            $data = QuizzInfo::where(['type'=>1])->select('english as value')->get();
        }
        if($language==2){
            $data = QuizzInfo::where(['type'=>1])->select('hindi as value')->get();
        }
        if($language==3){
            $data = QuizzInfo::where(['type'=>1])->select('roman as value')->get();
        }
        if($language==4){
            $data = QuizzInfo::where(['type'=>1])->select('urdu as value')->get();
        }
                  
        if( count( $data ) > 0 ){
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Data Found','data'=>$data],$this->successStatus);
            
        }
        else{

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'Data Not Found' ] , $this->errorStatus );
        
        }
        
    }

    public function question(Request $request){
        $rules = [

            'language'   =>'required'

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
        $season=Season::where('status','1')->first();
        $week=(int)(($season->season_ques/$season->season_week));
        $day=(int)(($week/$season->season_day)); 
        $time=(int)(($day/$season->season_time)); 
        // print_r($time); exit;
        $data=[];
        $language=$request->language;
        $date=date("d-m-Y");
        $check_ques=Question::get();
        if( count( $check_ques ) > ($time+1) ){
        // print_r($date); exit();
            if($language==1){
                $data['Question'] = Question::inRandomOrder()->select('id','english as question','english_option_a as option_a','english_option_b as option_b','english_option_c as option_c','english_option_d as option_d','english_ans as answer')->where('date',$date)->get();
                if($data['Question']=="[]")
                {

                    $data['Question'] = Question::take($time+1)->select('id','english as question','english_option_a as option_a','english_option_b as option_b','english_option_c as option_c','english_option_d as option_d','english_ans as answer')->where('date',Null)->get()->random($time);
                    foreach($data['Question'] as $date_update)
                        {
                            $update_id=$date_update->id;
                            $add= Question::find($update_id);
                            $add->date=$date;
                            $add->time=1;
                            $add->update();
                        }
                }
            }
            if($language==2){
                $data['Question'] = Question::inRandomOrder()->select('id','hindi as question','hindi_option_a as option_a','hindi_option_b as option_b','hindi_option_c as option_c','hindi_option_d as option_d','hindi_ans as answer')->where('date',$date)->get();
                if($data['Question']=="[]")
                {
                    $data['Question'] = Question::take($time+1)->select('id','hindi as question','hindi_option_a as option_a','hindi_option_b as option_b','hindi_option_c as option_c','hindi_option_d as option_d','hindi_ans as answer')->where('date',Null)->get()->random($time);
                        foreach($data['Question'] as $date_update)
                        {
                            $update_id=$date_update->id;
                            $add= Question::find($update_id);
                            $add->date=$date;
                            $add->time=1;
                            $add->update();
                        }
                }
            }
            if($language==3){
                $data['Question'] = Question::inRandomOrder()->select('id','roman as question','roman_option_a as option_a','roman_option_b as option_b','roman_option_c as option_c','roman_option_d as option_d','roman_ans as answer')->where('date',$date)->get();
                if($data['Question']=="[]")
                {
                    $data['Question'] = Question::take($time+1)->select('id','roman as question','roman_option_a as option_a','roman_option_b as option_b','roman_option_c as option_c','roman_option_d as option_d','roman_ans as answer')->where('date',Null)->get()->random($time);
                        foreach($data['Question'] as $date_update)
                        {
                            $update_id=$date_update->id;
                            $add= Question::find($update_id);
                            $add->date=$date;
                            $add->time=1;
                            $add->update();
                        }
                }

            }
            if($language==4){
                $data['Question'] = Question::take($time+1)->select('id','urdu as question','urdu_option_a as option_a','urdu_option_b as option_b','urdu_option_c as option_c','urdu_option_d as option_d','urdu_ans as answer')->where('date',$date)->get()->random($time);
                if($data['Question']=="[]")
                {
                    $data['Question'] = Question::take($time+1)->select('id','urdu as question','urdu_option_a as option_a','urdu_option_b as option_b','urdu_option_c as option_c','urdu_option_d as option_d','urdu_ans as answer')->where('date',Null)->get()->random($time);
                        foreach($data['Question'] as $date_update)
                        {
                            $update_id=$date_update->id;
                            $add= Question::find($update_id);
                            $add->date=$date;
                            $add->time=1;
                            $add->update();
                        }
                }
            }
        }else{

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'Question table Empty' ] , $this->errorStatus );
        
        }
        $text = preg_replace("/^<p.*?>/", "",$data);
        $text = preg_replace("|</p>$|", "",$data);
        $data['number_of_question'] = $time;
        // $status=Attendance::where('uid',$request->user()->id)->orderBy('id', 'DESC')->first();            
        if( count( $data ) > 0 ){
            
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Data Found','data'=>$data],$this->successStatus);
            
        }
        else{

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'Data Not Found' ] , $this->errorStatus );
        
        }
        
    }

    public function answer(Request $request){
        $rules = [

            'question_id'   =>'required',

            'answer'        =>'required',

            'time'          =>'required',

            'timeslot'      =>'required'
        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
        $add= new Answer;
        $add->user_id=25;
        $add->question_id=$request->input('question_id');
        $add->answer=$request->input('answer'); 
        $add->time=$request->input('time');
        $add->timeslot=$request->input('timeslot');    
        $add->language=$request->input('language');    
        $add->save();
        if($add){
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus);
            
        }
        else{

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'Some Error' ] , $this->errorStatus );
        
        }
        
    }

    public function result(Request $request){
        $rules = [

            'type'   =>'required'

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
        $type=$request->type;
        $data=[];
        $result_q=Answer::join('tbl_questios','tbl_answer.question_id','=','tbl_questios.id')
                        ->join('users','tbl_answer.user_id','=','users.id')
                        ->selectRaw('count(user_id) as total,users.id,sum(tbl_answer.time) as total_time,name')
                        ->groupBy('tbl_answer.user_id','users.name','users.id')
                        ->orderBy('total_time','desc')
                        ->where('date',$date=date("d-m-Y"))
                        ->get();
        $User=[];
            $data['tot_Question']=$result_q;
        $data['User']=$User;
        // print_r($result_q[2]->total); exit;
        if($type==1){
            $data['first_topper']  = Answer::get()->toArray();
            $data['second_topper'] = Answer::first();
            $data['thired_topper'] = Answer::first();
            $data['all'] = Answer::first();    
        }
        if($type==2){
            $data['first_topper']  = Answer::get()->toArray();
            $data['second_topper'] = Answer::first();
            $data['thired_topper'] = Answer::first();
            $data['all'] = Answer::first();
        }
        if($type==3){
            $data['first_topper']  = Answer::get()->toArray();
            $data['second_topper'] = Answer::first();
            $data['thired_topper'] = Answer::first();
            $data['all'] = Answer::first();
        }
               
        if( count( $data ) > 0 ){
            return response(['success'=>true,'code'=>$this->successStatus,'message'=>'Data Found','data'=>$data],$this->successStatus);
            
        }
        else{

            return response( [ 'success'=>false,'code'=>$this->errorStatus, 'message'=>'Data Not Found' ] , $this->errorStatus );
        
        }
        
    }
	
}
