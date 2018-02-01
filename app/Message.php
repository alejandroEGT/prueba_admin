<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\MessageSent;

class Message extends Model
{

	protected $dispatchesEvent= [
		'created' => MessageSent::class,
	];

    protected $fillable = ['message', 'user_id'];


	public function user()
	{
	  return $this->belongsTo(User::class);
	}
}