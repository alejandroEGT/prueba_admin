<?php

namespace App\Http\Controllers;

use App\Filters\UserFilter;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index(UserFilter $filter)
    {
        return User::filter($filter)->paginate();
    }

    public function store()
    {

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'confirma' => 'required|min:4|same:password',
            'sex' => 'required',
            'age' => 'required|integer|min:1',
            'birth' => 'required|date',
            'address' => 'required',
        ]);

        $insert = User::create(request()->all());
        //$insert = User::crear(request());

        return $insert;

    }

    public function update(User $user)
    {
        $this->validate(request(), [
            'name' => 'sometimes|required',
            'email' => ['sometimes', 'required', 'email', Rule::unique('users')->ignore($user->id)],
            'sex' => 'sometimes|required',
            'age' => 'sometimes|required|integer|min:1',
            'birth' => 'sometimes|required|date',
            'address' => 'sometimes|required',
        ]);

        $user->fill(request()->all())->save();

        return response()->json([
            'message' => 'Successful edited'
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'The user has been successfully deleted'
        ], Response::HTTP_ACCEPTED);
    }
    public function getUserAuth(){

        return Auth::user();
    }
    public function select_user(){

       /* $array= [];
        $users = User::all();

        for ($i=0; $i < count($users); $i++) { 
            $array[$i] = "'value': ".$users[$i]->name;
        }
        */
       /* foreach ($users as $u) {
            $array = $u->name;
        }*/
        return User::all();
    }
}
