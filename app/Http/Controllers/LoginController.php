<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Login extends Controller
{
    public function index(LoginRequest $request, Response $response){

        $data = $request->all();

        $isEmail = preg_match("/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/", $data["email"]);

        $isPhone = preg_match("/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?([789]\d{9}|(\d[ -]?){10}\d)$/", $data["phone"]);

        if($isEmail)
            $this->login_via_email($data);
        elseif($isPhone)
            $this->login_via_phone($data);
        else
            return response()->status(401);

    }

    protected function login_via_email($ctx){

        $user = User::where([
            ["email" => $ctx["username"]],
            ["password" => bcrypt($ctx["password"])],
        ]);
        if(!empty($user))
            return redirect("/dashboard");

        return response("/login")->with("error", "Incorrect combination of username and password.");
    }

    protected function  login_via_phone($ctx){
        $user = User::where([
            ["phone" => $ctx["username"]],
            ["password" => bcrypt($ctx["password"])],
        ]);
        if(!empty($user))
            return redirect("/dashboard");

        return response("/login")->with("error", "Incorrect combination of username and password.");
    }
}



