<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\MessageProyecto;

class messagePro extends Model
{
    protected $table = "message-proyecto";


	protected $fillable = ['message'];

    public function user()
	{
	  return $this->belongsTo(User::class);
	}
}
