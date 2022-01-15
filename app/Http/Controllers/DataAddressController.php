<?php

namespace App\Http\Controllers;

use App\Models\DataAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataAddressController extends Controller
{
    //

    public function EditDataAddress(Request $request,$id){

         
        $validator = Validator::make($request->all(), [
            'nii_bussines' => 'required|string',
            'name_bussines' => 'required|string',
            'address' => 'required|string',
        ]);

        if($validator->fails()){
            $response=  response()->json($validator->errors()->toJson(), 400);
        }else{
            $user = DataAddress::where($id ,'=', 'user_id')->first();
            $user->nii_bussines = $request->nii_bussines;
            $user->name_bussines = $request->name_bussines;
            $user ->address = $request->address;
            $user->update();
            $response = response()->json('Successful registration', 200);
        }

        return $response;
        		
    }

}
