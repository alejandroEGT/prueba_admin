<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chatProyecto extends Model
{
    protected $table = "chat_proyectos";



    protected $fillable = ['message'/*, 'user_id'*/];


	public function user()
	{
	  return $this->belongsTo(User::class);
	}

    protected function crear($id_proyecto)
    {
    	$chat = new chatProyecto;
    	$chat->id_proyecto = $id_proyecto;
    	if ($chat->save()) {
    		return true;
    	}
    	return false;
    }
}
