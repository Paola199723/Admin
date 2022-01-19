<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // verificamos que vemgan todos los datos
        if($validator->fails()){
            $response = response()->json($validator->errors()->toJson(), 400);
        }else{
            // verificamos si el id esta autorizado
            if (Auth::id() !== $id) {
               return response()->json(['message' => 'You don\'t have permissions'], 403);
            }
            //buscamos a los datos de la persona a editar
            if($user=DataUser::where('user_id', '=', $id)->first()){
                $user->name = $request->name;
                $user->surname =$request->surname;
                $user ->cedula = $request->cedula;
                $user->save();
            } else{
                // si es la primera vez que edita
                $user = new DataUser();
                $user->user_id = $id;
                $user->name = $request->name;
                $user->surname =$request->surname;
                $user ->cedula = $request->cedula;
                $user->save();
            }
            $response = response()->json('Successful registration', 200);
        }
        return $response;
    }
    
        		
}

