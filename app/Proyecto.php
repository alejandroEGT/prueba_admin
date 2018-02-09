<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table="proyectos";


    protected function crear($datos)
    {
    	$proyecto = new Proyecto;

    	$proyecto->id_user = $datos->id_user;
    	$proyecto->nombre = $datos->nombre;

    	if ($proyecto->save()) {
    		return true;
    	}
    	return false;
    }
}
