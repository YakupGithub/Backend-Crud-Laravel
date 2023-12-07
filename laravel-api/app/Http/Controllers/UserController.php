<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 401);
        }
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('MyLaravelApp')->accessToken;
    
            session(['token' => $token]);
    
            if (Auth::check()) {
                return response()->json(['status' => 1, 'token' => $token, 'message' => 'Giriş işlemi başarıyla gerçekleşti!'], $this->successStatus);
            } else {
                return response()->json(['status' => 0, 'message' => 'Giriş başarısız.'], 401);
            }
        } else {
            return response()->json(['status' => 0, 'message' => 'Bilgiler eksik veya hatalı!'], 401);
        }
    }
    
    
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->first()], 401);
        }
    
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $token = $user->createToken('MyLaravelApp')->accessToken;
    
        return response()->json(['status' => 1, 'token' => $token, 'name' => $user->name, 'message' => 'Kullanıcı kaydı başarıyla gerçekleştirildi.'], $this->successStatus);
    }
    
    
    public function logout() {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
    
        return response()->json(['status' => 'success', 'message' => 'Çıkış işlemi yapıldı!'], 200);
    }
    
}
