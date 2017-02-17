<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class profileController extends Controller
{
    public function show(Request $request, Response $response){

        $email = $request->session()->get("email");
        $phone = $request->session()->get("phone");

        if(!empty($email)){
            $user = Auth::user();
            return view("user.profile", [
                'user'=> $user,
            ]);
        }
        elseif(!empty($phone)){
            $user = Auth::user();
            return view("user.profile", [
                'user'=> $user,
            ]);
        }

        return response("unauthorised", 401);
    }
}
