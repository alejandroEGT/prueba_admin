<?php

namespace App\Http\Controllers;

use App\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    public function index()
    {

    	$listar = Proyecto::where('id_user', Auth::user()->id)->get();
    	return $listar;

    } 
	public function store(Request $datos)
	{

			//return $datos->nombre;
			$crear = Proyecto::crear($datos);
			if ($crear) {
				return response()->json(['succsess' => 'Proyecto creado con exito']);
			}
			return response()->json(['error' => 'error']);

	}
	public function show($id){

			return Proyecto::find($id);
	}

}
