<?php

namespace App\Http\Controllers;

use App\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    public function index()
    {

    	$listar = Proyecto::all();
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

	public function updateFoto(Request $datos){


		$datos->validate([
	        'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
	    ]);

		$project = Proyecto::find($datos->id_projecto);

		$image = $datos->file('foto');
		$name = time().'.'.$image->getClientOriginalExtension();
		if($datos->file('foto')->move(public_path('avatar'), $name)){
			$project->foto = 'avatar/'.$name;
			if ($project->save()) {
				return "Foto actualizada";
			}
		}
		return "error";
	}

	public function updateName(request $dato){

		$dato->validate([
	        'nombre' => 'required',
	    ]);

	    $project = Proyecto::find($dato->id_projecto);
	    $project->nombre = $dato->nombre;
	    if ($project->save()) {
	    	return "Nombre actualizado";
	    }
	    return "error";


	}

}
