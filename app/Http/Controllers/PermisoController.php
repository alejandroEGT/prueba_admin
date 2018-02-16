<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permiso;

class PermisoController extends Controller
{
    public function index(){

    	return Permiso::all();


    }
}
