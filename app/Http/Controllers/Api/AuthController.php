<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Cart;
use App\Traits\imageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    use Api_Response, imageTrait;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }



    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null,422,$validator->errors());
        }
        if (!auth()->attempt($validator->validated())) {
            return $this->apiResponse(null,401,'Unauthorized');
        }
        $user = User::where('email',$request->email)->first();
        $token = $user->createToken('AuthToken')->accessToken;
        return $this->createNewToken($token);
    }



    public function register (Request $request) {
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'nick_name'=>'string|max:255',
            'date_of_birth'=>'string|max:255',
            'password' => 'required|string|min:6|max:30',
            'phone'=>'required|min:6|max:15',
            'image'=>'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
        $messages = [
            'name.required'=>'The name of user is required',
            'name.string'=>'The name of user should be string',
            'name.max'=>'The name of user is too big',
            'email.required'=>'The email user is required',
            'email.unique'=>'This email was already taken',
            'password.required'=>'The password is required',
            'password.min'=>'The password should be at lest 6 character',
            'password.max'=>'The password should be maxim 30 character ',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails())
        {
            return $this->apiResponse(null,422,$validator->errors());
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        if($request->filled('nick_name'))
            $user->nick_name = $request->nick_name;
        if($request->filled('date_of_birth'))
            $user->date_of_birth = $request->date_of_birth;
        if($image = $request->file('image')){
            $imageName = $this->save_image($image,"img/users/profile");
            $user->image = $imageName;
        }
        if($user->save()){
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->save();
            return $this->apiResponse(new UserResource($user),201,'user created successfully');
        }
    }



    public function logout() {
        auth()->logout();
        return $this->apiResponse(null,200,'User successfully signed out');
    }



    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    public function userProfile() {
         return $this->apiResponse(auth()->user(),200,'This is the user');;
    }




    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //'expires_in' => auth()->factory()->getTTL() * 60
//            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
//    protected function createToken(array $data)
//    {
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//            'api_token' => Str::random(60),
//        ]);
//    }
//
//    public function loginTest(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'password' => 'required|string',
//            'email' => 'required|string|email',
//        ]);
//        if ($validator->fails()) {
//            return response(['errors' => $validator->errors()->all()], 422);
//        }
//        else {
//            $credentials = $request->only(['email', 'password']);
//            if(!Auth::attempt($credentials)) {
//                return response()->json(['success' => false, 'message' => 'invalid Email or Password!']);
//            } else {
//                $user = Auth::user();
//                $accessToken = $user->createToken('AuthToken')->accessToken;
//                $user['token'] = $accessToken;
//                $response =  array('success' => true, 'data' => $user,'token' => $accessToken,'messgae' => "Login success");
//                return response()->json($response);
//            }
//        }
//    }
}
