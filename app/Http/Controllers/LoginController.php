<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(LoginRequest $request, Response $response){

        $data = $request->all();

        if($this->is_email($data["username"]))
            $user = $this->login_via_email($data);
        elseif($this->is_phone($data["username"]))
            $user = $this->login_via_phone($data);
        else
            return response("forbidden error", 401);


        if(!empty($user)){
            $request->session()->put("email", $user);
            $request->session()->put("email", $user["phone"]);
            return redirect("/user/profile");
        }
        return view("auth.login", [
            "errormsg" => "Incorrect combination of username and password.",
        ]);
    }

    protected function login_via_email($ctx){
        if (Auth::attempt(['email' => $ctx["username"], 'password' => $ctx["password"]])) {
            return Auth::user();
        }
        return 0;
    }

    protected function  login_via_phone($ctx){
        if (Auth::attempt(['phone' => $ctx["username"], 'password' => $ctx["password"]])) {
            return Auth::user();
        }
        return 0;
    }

    private function is_email($var){
        return preg_match("/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/", $var);
    }

    private function is_phone($var){
        return preg_match("/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?([789]\d{9}|(\d[ -]?){10}\d)$/", $var);
    }
}
