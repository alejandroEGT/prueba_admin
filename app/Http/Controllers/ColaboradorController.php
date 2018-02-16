<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Colaborador;
class ColaboradorController extends Controller
{
	public function index(){

		return Colaborador::listar($id_proyecto);
	}
	public function show($id_proyecto){

		return Colaborador::listar($id_proyecto);

	}
    public function store(request $datos)
    {
    	//return $datos;

    	$col = Colaborador::insertar($datos);
    	if($col){
    		$insert = \DB::table('colaborador-proyecto')->insert([
    			'id_colaborador' =>$col,
    			'id_proyecto' => $datos->id_proyecto,

    		]);

    		if ($insert) {
    			return "success";
    		}
    		return "denied";
    	}
    }
}
