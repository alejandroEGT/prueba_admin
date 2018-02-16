<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\MessageProyecto;
use App\Message;
use App\messagePro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class chatController extends Controller
{

    public function fetchMessages($id_proyecto)
	{
	  //return Message::with('user')->get();
	  $user = \DB::table('users')
	  ->join('colaboradores','colaboradores.id_user','=','users.id')
	  ->join('colaborador-proyecto','colaborador-proyecto.id_colaborador','=','colaboradores.id')->where('users.id', Auth::user()->id)->get();

	  //return $id_proyecto;
	  $verificar = \DB::table('colaboradores')
	  ->join('colaborador-proyecto','colaborador-proyecto.id_colaborador','=','colaboradores.id')
	  ->where('colaboradores.id_user', Auth::user()->id)
	  ->where('colaborador-proyecto.id_proyecto', $id_proyecto)->first();

	  if ($verificar) {
	  	
	  	return \DB::table('message-proyecto')
		  ->join('users','users.id','=','message-proyecto.id_user')
		  ->where('message-proyecto.id_proyecto', $id_proyecto )
		  ->orderBy('message-proyecto.created_at','asc')
		  ->get();

	  }
	  return "false";




	  




	  return messagePro::all();
	}

	public function sendMessage(Request $request)
	{
	
	  $user = Auth::user();
	  /*$message = $user->messages()->create([
	    'message' => $request->message['message']
	  ]);*/
	  $message = new messagePro;	
	  $message->id_user = Auth::user()->id;
	  $message->id_proyecto = $request->id_proyecto;
	  $message->message = $request->message['message'];
	  $message->save();

	  \Session::put('id_proyecto', $request->id_proyecto);

	  broadcast(new MessageProyecto($user, $message))->toOthers();

	  return ['status' => 'Message Sent!'];
	}
}
