<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Validator;
class HomeSettingController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function index(){        
        $data = QuizzInfo::first();
        if($data){
            return response(['success'=>true,'code'=> $this->successStatus,'message'=>'data found','data'=>$data],$this->successStatus);            
        }else{
            return response(['success'=>true,'code'=> $this->errorStatus,'message'=>'not data found','data'=>[]],$this->successStatus);
        }
        
        return response( [ 'success'=>false,'code'=> $this->errorStatus, 'message'=>'internel problem' ] , $this->errorStatus );
        
    }

    public function store(Request $request)
    {
        // $rules = [

            
        //     'file'       =>'required',

        // ];

        // $validation = Validator::make( $request->all(), $rules );

        // if( $validation->fails() ){
            
        //     return response( [ 'success'=> false,'code'=> $this->valerrorStatus, 'message'=>$validation->messages()->first() ] , 200 );

        // } 

   $file = $request->file('file');
    if ($file) {
    $filename = $file->getClientOriginalName();
    $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
    $tempPath = $file->getRealPath();
    $fileSize = $file->getSize(); //Get size of uploaded file in bytes
    //Check for file extension and size
    $this->checkUploadedFileProperties($extension, $fileSize);
    //Where uploaded file will be stored on the server 
    $location = 'admin_assets/upload'; //Created an "uploads" folder for that
    // Upload file
    $file->move($location, $filename);
    // In case the uploaded file path is to be stored in the database 
    $filepath = public_path($location . "/" . $filename);
    // Reading file
    $file = fopen($filepath, "r");
    $importData_arr = array(); // Read through the file and store the contents as an array
    $i = 0;
    //Read the contents of the uploaded file 
    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
    $num = count($filedata);
    // Skip first row (Remove below comment if you want to skip the first row)
    if ($i == 0) {
    $i++;
    continue;
    }
    for ($c = 0; $c < $num; $c++) {
    $importData_arr[$i][] = $filedata[$c];
    }
    $i++;
    }
    fclose($file); //Close after reading
    $j = 0;
    foreach ($importData_arr as $key => $importData) {
    // $name = $importData[0]; //Get user names
    // $email = $importData[1]; //Get the user emails
    
    $add= new Banner;
    $add->image=$importData[0];
    $add->save();
    $j++;
    }
        if($add){
        return response(['success'=>true,'code'=> $this->successStatus,'message'=>'$j records successfully add','data'=>$add],$this->successStatus); 
        }
    } else {
    //no file was uploaded
        return back()->with('status',"No file was uploaded");
    }
            
       
    }

    public function checkUploadedFileProperties($extension, $fileSize)
    {
    $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
    $maxFileSize = 2097152; // Uploaded file size limit is 2mb
    if (in_array(strtolower($extension), $valid_extension)) {
    if ($fileSize <= $maxFileSize) {
    } else {
    throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
    }
    } else {
    throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
    }
    }
}
