

1) composer require laravel/passport
2) php artisan migrate 
3)  app/model/user.php file change 

use Laravel\Passport\HasApiTokens; 
 
use HasApiTokens, HasFactory, Notifiable;



4) config/auth.php 

   'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],
    https://github.com/codeimprove0/laravel-8.git
1) model/user.php  

use Laravel\Passport\HasApiTokens; 
 
use HasApiTokens, HasFactory, Notifiable;



    2) APIs controller me 


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;


php artisan passport:install --force

/////////////// AUTH LOGIN & REGISTER /////////////////////

public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'c_password' => 'required|same:password',
    ]);

    if($validator->fails()){
        return response()->json($validator->errors(),200);       
    }

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $success['token'] =  $user->createToken('MyApp')->accessToken;
    $success['name'] =  $user->name;
    return response()->json($success,200); 
}

public function login(Request $request)
{
    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
        $user = Auth::user(); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
        return response()->json($success,200);  
    } 
    else{ 
        return response()->json(['error'=>'Unauthorised'],201);  
    } 
}

public function details(Request $request)
{
    $data = Task::all();  
    return response()->json($data,200);
}



---------------################################
#################-------------------------------





1) composer require laravel/passport
2) php artisan migrate 
3)  app/model/user.php file change 

use Laravel\Passport\HasApiTokens; 
 
use HasApiTokens, HasFactory, Notifiable;



4) config/auth.php 

   'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],

    5) controller 
    add line at top 
    
    use Illuminate\Support\Facades\Auth;




    php artisan passport:install --force
