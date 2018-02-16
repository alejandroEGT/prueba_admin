<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $table="colaboradores";

    protected function insertar($datos)
    {

    	$id_permiso;

    	switch ($datos->value3) {
    		case 'Admin':
    			$id_permiso = 1;
    			break;
    		case 'Lectura':
    			$id_permiso = 2;
    			break;
    		case 'Escritura':
    			$id_permiso = 3;
    			break;	
    		default:

    			break;
    	}

    	$col = new Colaborador;
    	$col->id_user = $datos->value8;
    	$col->id_permiso = $id_permiso;

    	if ($col->save()) {
    		return $col->id;
    	}
    	return 0;
    }

    protected function listar($id_proyecto)
    {
    	return \DB::table('users')
    			->join('colaboradores', 'colaboradores.id_user','=','users.id')
    			->join('colaborador-proyecto','colaborador-proyecto.id_colaborador','=','colaboradores.id')
    			->join('permisos','permisos.id','=','colaboradores.id_permiso')->where('colaborador-proyecto.id_proyecto', $id_proyecto)->get();
    }
}
