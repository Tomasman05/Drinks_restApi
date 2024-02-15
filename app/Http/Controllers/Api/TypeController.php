<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Http\Resources\Type as TypeResource;
use App\Http\Controllers\Api\ResponseController;

class TypeController extends ResponseController
{
    public function getTypes(){
        $types = Type::all();
        return $this->sendResponse(TypeResource::collection($types),"Fajták betöltve");
    }
}
