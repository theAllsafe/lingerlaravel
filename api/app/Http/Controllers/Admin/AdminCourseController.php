<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\CourseSetting;
use App\Models\Course;
use Validator;
class AdminCourseController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function index(){        
        $data = Course::all()->toArray();
        // $columns[0]= ['Header'=>"sh.NO","accessor"=>'hindi'];
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
            'price'       =>'required',
            'file'       =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 

            $add= new Course;
            if($request->hasfile('file'))
            {
                $file=$request->file('file');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $file->move('admin_assets/upload',$filename);
                $add->image=url('')."/admin_assets/upload/".$filename;
            } 
            if($request->hasfile('vedio'))
            {
                $file=$request->file('vedio');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $file->move('admin_assets/upload',$filename);
                $add->image=url('')."/admin_assets/upload/".$filename;
            }          
            $add->title=$request->input('title');
            $add->description=$request->input('description');
            $add->aid=$request->input('uid');
            $add->price=$request->input('price');
            $add->save();
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus); 
       
    }

    

    public function destroy($id)
    {
        $users=Course::findOrFail($id);
        $users->delete();
        return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Delete successfully'],$this->successStatus); 
    }

    public function setting(){        
        $data = CourseSetting::first();
        // $columns[0]= ['Header'=>"sh.NO","accessor"=>'hindi'];
        if($data){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'data found','data'=>$data],$this->successStatus);            
        }else{
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->successStatus);
        }
        
        return response( [ 'success'=>false,'code'=> $this->errorStatus, 'message'=>'internel problem' ] , $this->errorStatus );
        
    }

    public function setting_update(Request $request)
    {
        $rules = [

            'uid'   =>'required',
            
            'value'     =>'required|max:200',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
            $data['value']  = $request->value;
            $add=CourseSetting::where( ['id'=>1] )->update( $data );
        if($add){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Update successfully','data'=>$add],$this->successStatus); 
        }
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'Some Error','data'=>[]],$this->errorStatus);
    }
}
