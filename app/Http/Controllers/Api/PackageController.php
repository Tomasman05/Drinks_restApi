<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ResponseController;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Http\Resources\Package as PackageResource;
use App\Http\Requests\PackageChecker;

class PackageController extends ResponseController
{
    public function getPackages(){
        $packages = Package::all();
        return $this->sendResponse(PackageResource::collection($packages),"Csomagok betöltve");

    }
    public function getPackageId($packageName){
        $package = Package::where("package",$packageName)->first();
        $id = $package->id;
        return $id; 
    }
    public function addPackage(PackageChecker $request){
        $request->validated();
        $input = $request->all();

        $package = new Package;
        $package->package=$input["package"];
        $package->save();
        return $this->sendResponse($package,"Csomag sikeresen felvéve.");
    }
    public function modifyPackage(PackageChecker $request){
        $input = $request->all();
        $id = $input["id"];

        $package= Package::find($id);
        $package->package = $input["package"];
        $package->save();
        return $this->sendResponse($package,"Csomag sikeresen módosítva.");
    }
    public function deletePackage(Request $request){
        $id=$request["id"];
        $package = Package::find($id);
        $package->delete();
        return $this->sendResponse($package,"Csomag sikeresen törölve.");
    }
}
