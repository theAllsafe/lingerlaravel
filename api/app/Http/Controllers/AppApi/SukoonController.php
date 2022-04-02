<?php 

namespace App\Http\Controllers\AppApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like_Sukoon;
use App\Models\Sukoon;
use Validator;
use Auth;
class SukoonController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function index(Request $request){        
        
        $data = Sukoon::join('users','users.id','=','tbl_sukoon.user_id')->select('tbl_sukoon.*','users.name')->get()->toArray();
        if($data){
            $data=$this->user_like($data,$request->user()->id);
        }
        if($data){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'data found','data'=>$data],$this->successStatus);            
        }else{
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->successStatus);
        }
        
        return response( [ 'success'=>false,'code'=> $this->errorStatus, 'message'=>'internel problem' ] , $this->errorStatus );
        
    }

    public function details($id){        
        $data = Sukoon::join('users','users.id','=','tbl_sukoon.user_id')->select('tbl_sukoon.*','users.name')->where('tbl_sukoon.id',$id)->get()->toArray();
        if($data){
            $data=$this->user_like($data,Auth::user()->id);
        }
        if($data){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'data found','data'=>$data],$this->successStatus);            
        }else{
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->successStatus);
        }
        
        return response( [ 'success'=>false,'code'=> $this->errorStatus, 'message'=>'internel problem' ] , $this->errorStatus );
        
    }
    
    public function user_like($data,$user_id)
    {
        if ($data) {
            $x = array_map(function ($index) use ($user_id) {
                $newdata = Like_Sukoon::where(['is_sukoon' => $index['id'],'this_user' => $user_id])->select('status')->get();
                if(count($newdata) > 0){
                    $index['Like'] = $newdata;
                }else{
                    $index['Like'] = array(['status'=>0]);
                }
                return $index;
            }, $data);
        }
            return $x;
    }
    
    public function like(Request $request)
    {
        $rules = [

            'is_sukoon'     =>'required',
            
            'status'        =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
        $data = Like_Sukoon::where(["this_user"=>$request->user()->id,"is_sukoon"=>$request->input('is_sukoon')])->first();
        if($data)
        {
            $update['status']  = $request->status;
            $add=Like_Sukoon::where( ["this_user"=>$request->user()->id,"is_sukoon"=>$request->input('is_sukoon')] )->update( $update );
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'update successfully','data'=>$add],$this->successStatus); 
        }
        else
        {
            $add= new Like_Sukoon;
            $add->this_user=$request->user()->id;
            $add->is_sukoon=$request->input('is_sukoon'); 
            $add->status=$request->input('status');    
            $add->save();
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus); 
        }
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->errorStatus);
    }
}
