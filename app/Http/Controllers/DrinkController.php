<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;
Use App\Http\Resources\Drink as DrinkResource;
Use App\Http\Controllers\Api\ResponseController;

class DrinkController extends ResponseController
{
    public function getDrinks(){

        $drinks= Drink::with("type","package")->get();
        return $this->sendResponse(DrinkResource::collection($drinks),"Italok betöltve");
    }
}
