<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class authuserController extends Controller
{
    public function autentificar(Request $datos)
    {
    	
    	//return $datos->email.' y '.$datos->password;

    	if (\Auth::attempt(['email' => $datos->email, 'password' => $datos->password])) {
            
            return redirect('/loged');
        }
        return "no loged";
    }

    public function logout(){

    	return "logouth";
    }
}
