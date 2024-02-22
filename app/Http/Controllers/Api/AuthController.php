<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserRegisterChecker;
use App\Http\Requests\UserLoginChecker;

class AuthController extends ResponseController
{
    public function register(UserRegisterChecker $request){
        $request->validated();
        $input = $request->all();
        $input["password"]=bcrypt($input["password"]);
        $user=User::create($input);
        $success["name"] =$user->name;
        return $this->sendResponse($success,"Sikeres regiszrtáció");
    }

    public function login(UserLoginChecker $request){
        $request->validated();
        if(Auth::attempt(["email"=>$request->email,"password"=>$request->password])){
            $user = Auth::user();
            $success["token"] = $user->createToken($user->name."token")->plainTextToken;
            $succes["name"]=$user->name;
            return $this->sendResponse($succes,"Sikeres bejelentkezés");
        }
        else{
            return $this->sendError("Adatbeviteli hiba",["Hibás email vagy jelszó"],401);
        }
    }

    public function logout(){

    }
}
