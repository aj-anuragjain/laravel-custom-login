<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function index(RegisterRequest $request, Response $response){

        $data = $request->all();

        $user = new User();

        $user->name = $data["name"];
        $user->phone = $data["phone"];
        $user->email = $data["email"];
        $user->password = bcrypt($data["password"]);
        $user->save();

        $request->session()->put("email", $data["email"]);
        $request->session()->put("phone", $data["phone"]);

        return redirect("/user/profile");
    }
}
