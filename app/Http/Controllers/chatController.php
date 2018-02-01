<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;


class chatController extends Controller
{

    public function fetchMessages()
	{
	  return Message::with('user')->get();
	  //return Message::get();
	}

	public function sendMessage(Request $request)
	{
	  $user = Auth::user();

	  $message = $user->messages()->create([
	    'message' => $request->input('message')
	  ]);

	  broadcast(new MessageSent($user, $message))->toOthers();

	  return ['status' => 'Message Sent!'];
	}
}
