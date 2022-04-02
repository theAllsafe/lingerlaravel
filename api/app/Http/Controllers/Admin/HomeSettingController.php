<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\BabyNames;
use App\Models\Islam;
use App\Models\khwabkiTabeer;
use Validator;
class HomeSettingController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function index($id){       
        if ($id==1) {
            $data = Banner::where('type',$id)->get();
         }
         if($id==6){
            $cover=Banner::where('type',$id)->get();
            $slot_array=[];
            $pp=[];
            foreach($cover as $key => $val)
            {
                $slot_array['id'] = ++$key;
                if($val->status==1){
                    $slot_array['status'] = "Premium";
                }else{
                    $slot_array['status'] = "Standard";
                }
                $slot_array['image'] = $val->image;
                $pp[]=$slot_array;
            }
            if($pp){
            $data=$pp;
            }else{
            $data=[]; 
            }
         }
         if ($id==2) {
            $data = Banner::where('type',$id)->first();
         }
         if ($id==3) {
            $data = Banner::where('type',$id)->first();
         } 
        if($data){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'data found','data'=>$data],$this->successStatus);            
        }else{
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->successStatus);
        }
        
        return response( [ 'success'=>false,'code'=> $this->errorStatus, 'message'=>'internel problem' ] , $this->errorStatus );
        
    }

    public function store(Request $request)
    {
        $rules = [

            
            'file'       =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 

            if ($request->input('type')==2) {
                $res=Banner::where('type',2)->delete();
            }
            if ($request->input('type')==3) {
                $res=Banner::where('type',3)->delete();
            }
            $add= new Banner;
            $add->type=$request->input('type');
            if($request->hasfile('file'))
            {
                $file=$request->file('file');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $file->move('admin_assets/upload',$filename);
                $add->image=url('')."/admin_assets/upload/".$filename;
            }          
            if($request->input('type')==3){
                $add->title=$request->input('title');
            }
            if($request->input('type')==6){
                $add->status=$request->input('bid');
            }
            $add->save();
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus); 
       
    }

    public function khwabkiTabeer(){        
        $data = KhwabkiTabeer::join('users','tbl_khwab_ki_tabeer.aid','=','users.id')->get();
        if($data){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'data found','data'=>$data],$this->successStatus);            
        }else{
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->successStatus);
        }
        
        return response( [ 'success'=>false,'code'=> $this->errorStatus, 'message'=>'internel problem' ] , $this->errorStatus );
        
    }

    public function babyNames(){        
        $data = BabyNames::join('users','tbl_baby_names.user_id','=','users.id')->get();
        if($data){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'data found','data'=>$data],$this->successStatus);            
        }else{
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->successStatus);
        }
        
        return response( [ 'success'=>false,'code'=> $this->errorStatus, 'message'=>'internel problem' ] , $this->errorStatus );
        
    }

    public function destroy($id)
    {
        $users=Banner::findOrFail($id);
        $users->delete();
        return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Delete successfully'],$this->successStatus); 
    }

    public function islam_update(Request $request)
    {
        $rules = [
            'description'       =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 

            $add= Islam::find(1);
            if($request->hasfile('description'))
            {
                $file=$request->file('description');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $file->move('admin_assets/upload',$filename);
                $add->description=url('')."/admin_assets/upload/".$filename;
            }   
            $add->update();
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Update successfully','data'=>$add],$this->successStatus); 
       
    }
}
