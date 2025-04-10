<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $response = ["success"=>false];

        //Validaciones
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        //para retornar si hay errores. 
        if($validator->fails())
        {
            $response = ["error"=>$validator->errors()];
            return response()->json($response, 200);
        }


        //Recogemos los datos (del $request) y encriptamos la password
        $input = $request->all();
        $input["password"] = bcrypt($input['password']);

        //creamos el usuario
        $user = User::create($input);
        $user->assignRole('client');
        //Para crear un usuario con rol admin $user->assignRole('admin');

        $response["success"] = true;
        //Token personalizado para usuarios creados
        //$response["token"] = $user->createToken("Tutorial")->plainTextToken;

        return response()->json($response, 200);
    }


    public function login(Request $request)
    {
        $response = ["success"=>false];

        //Validaciones
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        //para retornar si hay errores. 
        if($validator->fails())
        {
            $response = ["error"=>$validator->errors()];
            return response()->json($response, 200);
        }



        if(auth()->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $user = auth()->user();
            $user->hasRole('client');//le añadimos el rol client en este caso 

            $response['token'] = $user->createToken("Tutorial.app")->plainTextToken;
            $response['user'] = $user;
            $response['success'] = true;
        }
        return response()->json($response, 200);



    }

    public function logout()
    {
        $response = ["success"=>false];
        auth()->user->tokens()->delete();
        $response = [
            "success" => true,
            "message" => "Sesión cerrada"
        ];
        return response()->json($response, 200);

    }

}
