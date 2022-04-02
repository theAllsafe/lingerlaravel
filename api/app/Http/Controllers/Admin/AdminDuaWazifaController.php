<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DuaWazifa;
use Validator;
class AdminDuaWazifaController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function index(){     
        $data = DuaWazifa::get();
         
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

            
            'title'       =>'required',
            'description'       =>'required',
            'file'       =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 

            $add= new DuaWazifa;
            if($request->hasfile('file'))
            {
                $file=$request->file('file');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $file->move('admin_assets/upload',$filename);
                $add->image=url('')."/admin_assets/upload/".$filename;
            }          
            $add->title=$request->input('title');
            if($request->hasfile('description'))
            {
                $file=$request->file('description');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $file->move('admin_assets/upload',$filename);
                $add->description=url('')."/admin_assets/upload/".$filename;
            } 
            $add->save();
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus); 
       
    }

    public function destroy($id)
    {
        $users=DuaWazifa::findOrFail($id);
        $users->delete();
        return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Delete successfully'],$this->successStatus); 
    }

    public function islam_update(Request $request)
    {
        $rules = [

            
            'title'       =>'required',
            'description'       =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 

            $add= Islam::find(1);
            $add->title=$request->input('title');
            $add->description=$request->input('description');    
            $add->update();
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Update successfully','data'=>$add],$this->successStatus); 
       
    }
}
