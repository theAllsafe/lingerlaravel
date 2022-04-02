<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IslamicHeroes;
use App\Models\IslamicHeroesType;
use Validator;
class AdminIslamicHeroesController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function index(){     
        $data = IslamicHeroes::get();
         
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
            'file'       =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 

            $add= new IslamicHeroes;
            $add->aid=$request->input('userid');
            $add->title=$request->input('title');
            if($request->hasfile('file'))
            {
                $file=$request->file('file');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $file->move('admin_assets/upload',$filename);
                $add->image=url('')."/admin_assets/upload/".$filename;
            }  
            $add->save();
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus); 
       
    }

    public function destroy($id)
    {
        $users=IslamicHeroes::findOrFail($id);
        $users->delete();
        return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Delete successfully'],$this->successStatus); 
    }

    public function type(){     
        $data = IslamicHeroesType::join('tbl_islamic_heroes','tbl_islamic_heroes.id','=','tbl_islamic_heroes_type.islamic_heroes_id')->select('tbl_islamic_heroes_type.*','tbl_islamic_heroes.title as name')->get();
         
        if($data){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'data found','data'=>$data],$this->successStatus);            
        }else{
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->successStatus);
        }
        
        return response( [ 'success'=>false,'code'=> $this->errorStatus, 'message'=>'internel problem' ] , $this->errorStatus );
        
    }

    public function islamicHeroes(){        
        $data = IslamicHeroes::select('title as label','id as value')->get();
        // $columns[0]= ['Header'=>"sh.NO","accessor"=>'hindi'];
        if($data){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'data found','data'=>$data],$this->successStatus);            
        }else{
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->successStatus);
        }
        
        return response( [ 'success'=>false,'code'=> $this->errorStatus, 'message'=>'internel problem' ] , $this->errorStatus );
        
    }

    public function store_type(Request $request)
    {
        $rules = [

            'uid'   =>'required',
            
            'bid' =>'required',

            'title'  =>'required',
            
            'description' =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){
            
            return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        } 
        $add= new IslamicHeroesType;
        $add->islamic_heroes_id=$request->input('bid');
        $add->title=strip_tags($request->input('title'));
        if($request->hasfile('description'))
            {
                $file=$request->file('description');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $file->move('admin_assets/upload',$filename);
                $add->description=url('')."/admin_assets/upload/".$filename;
            }
        $add->save();
        if($add){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'Add successfully','data'=>$add],$this->successStatus); 
        }
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'Some Error','data'=>[]],$this->errorStatus);
    }

    public function destroy_type($id)
    {
        $users=IslamicHeroesType::findOrFail($id);
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
