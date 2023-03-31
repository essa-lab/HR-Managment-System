<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Validator;
class RegisterController extends BaseController{
    /**
    * Regestir API
    * @return \Illuminate\HTTP\Response
    *
    */
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'unique:users|required|email',
            'password'=>'required',
            'c_password'=>'required|same:password',
        ]);
        if($validator->fails()){
            Log::channel('db')->error('User Validation Error',['User'=>'visitor',$validator->errors()]);
            Log::channel('custom')->error('User Validation Error',['User'=>'visitor',$validator->errors()]);
            return $this->sendError('Validation Error',$validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyHRSystem')->plainTextToken;
        $success['name']=$user->name;

        Log::channel('db')->info('New User Regestriation',['User_name'=>$request->get('name')]);
        Log::channel('custom')->info('New User Regestriation',['User_name'=>$request->get('name')]);
        return $this->sendResponse($success,"User Register Successfully.");


    }

    /**
     * Login api
     * @return \Illuminate\Http\Response
     *
     */
    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyHRSystem')->plainTextToken;
            $success['name'] =  $user->name;


            Log::channel('db')->info('User login successfully',['User_name'=>$user->name]);
            Log::channel('custom')->info('User login successfully',['User_name'=>$user->name]);
            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError("Unauthorised",['error'=>'Unauthorised']);
        }
    }
}
 ?>
