<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

 //
    public function CreateProduct(){

        $user = new Product();
        $user->user_id = $id;
        $user->name = $request->name;
        $user->surname =$request->surname;
        $user ->cedula = $request->cedula;
        $user->save();

    }

}
