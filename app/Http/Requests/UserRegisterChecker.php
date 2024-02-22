<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterChecker extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name"=>"required|max:20",
            "email"=>"required|email",
            "password"=>"required|min:6",
            "confirm_password"=>"required|same:password"
        ];
    }
    public function messages(){
        return[
            "name.required"=>"Név kötelező",
            "name.max"=>"Név túl hosszú",
            "email.required"=>"Email kötelező",
            "email.email"=>"Valid email kötelező",
            "password.required"=>"Jelszó kötelező",
            "password.min"=>"Jelszó túl rövid",
            "confirm_password.required"=>"Kötelező a jelszó megerősítés",
            "confirm_password.same"=>"Jelszók nem egyeznek"

        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "success"=>false,
            "message"=>"Adatbeviteli hiba",
            "data"=>$validator->errors()
        ]));
    }
}
