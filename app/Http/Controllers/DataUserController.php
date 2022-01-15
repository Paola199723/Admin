<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataUserController extends Controller
{
    //editar datos personales del usuario

    public function EditDataUser(Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string',
            'cedula' => 'required|string',
        ]);

        if($validator->fails()){
            $response=  response()->json($validator->errors()->toJson(), 400);
        }else{
            $user = User::where('id' ,'=',$id)->first()->get();
            $user2 = new DataUser();
            $user2->user_id = $id;
            $user2->name = $request->name;
            $user2->surname = $request->surname;
            $user2 ->cedula = $request->cedula;
            $user2->save();
            $response = response()->json('Successful registration', 200);
        }
        return $response;
        		
    }
    


}
