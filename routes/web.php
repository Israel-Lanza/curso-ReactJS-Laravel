<?php

use Illuminate\Support\Facades\Route;
//use Spatie\Permission\Models\Role;


//rutas para roles y roles. Esta es la forma de crearlos (es una de muchas formas)
//$role = Role::create(['name' => 'admin']);
//$role = Role::create(['name' => 'client']);


Route::get('/', function () {
    return view('welcome');
});




