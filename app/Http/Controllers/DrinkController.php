<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;
Use App\Http\Resources\Drink as DrinkResource;
Use App\Http\Controllers\Api\ResponseController;
use App\Http\Requests\DrinkAddChecker;

class DrinkController extends ResponseController
{
    public function getDrinks(){

        $drinks= Drink::with("type","package")->get();
        return $this->sendResponse(DrinkResource::collection($drinks),"Italok betöltve");
    }
    public function getDrink(Request $request){
        $name= $request["drink"];
        $drink = Drink::where("drink",$name)->first();

        if(is_null($drink)){
            return $this->sendError("Null","Nincs ilyen ital");
        }
        return $this->sendResponse(DrinkResource::make($drink),"$name megtalálva");
    }
    public function newDrink(DrinkAddChecker $request){
        $request->validated();
    }
    public function modifyDrink(Request $request){

    }
}