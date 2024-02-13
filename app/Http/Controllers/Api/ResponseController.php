<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function sendResponse($data, $message){
        $response=[
            "success"=> true,
            "data"=>$data,
            "message"=>$message
        ];
        return $response()->json($response,200);
    }
}
