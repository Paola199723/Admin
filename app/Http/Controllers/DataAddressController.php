<?php

namespace App\Http\Controllers;

use App\Models\DataAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $response = response()->json($validator->errors()->toJson(), 400);
        }else{
            // verificamos si el id esta autorizado
            if (Auth::id() !== $id) {
                return response()->json(['message' => 'You don\'t have permissions'], 403);
            }
            //buscamos a los datos de la persona a editar
            if($address=DataAddress::where('user_id', '=', $id)->first()){
                $address->nii_bussines = $request->nii_bussines;
                $address->name_bussines = $request->name_bussines;
                $address ->address = $request->address;
               
            } else{
                // si es la primera vez que edita
                $address = new DataAddress();
                $address->user_id = $id;
                $address->nii_bussines = $request->nii_bussines;
                $address->name_bussines = $request->name_bussines;
                $address ->address = $request->address;
                
            }
            $address->save();
            $response = response()->json('Successful registration', 200);
        }
        return $response;
        		
    }

}
