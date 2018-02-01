<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nickname',
        'email',
        'password',
        'sex',
        'age',
        'birth',
        'address',
        'avatar',
    ];

    protected $casts = [
        'sex' => 'integer'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function setBirthAttribute($birth)
    {
        $this->attributes['birth'] = date( 'Y-m-d', strtotime( $birth ) );
    }
    public function setAvatarAttribute(){
        $this->attributes['avatar'] = "https://4.bp.blogspot.com/-m0AZcAGQZoA/WSMkGL-ttAI/AAAAAAAAC1w/AtxdeoGb6RokrXrmyIgRGI91u2iAh9E5gCLcB/s1600/SSGB.jpg";
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function messages()
    {
      return $this->hasMany(Message::class);
    }
    

    /*protected function crear($user){

        $insert = new User;
        $insert->name = $user->name;
        $insert->nickname = $user->nickname;
        $insert->email = $user->email;
        $insert->password = $user->password);
        $insert->sex = $user->sex;
        $insert->age = $user->age;
        $insert->address = $user->address;
        $insert->birth = date( 'Y-m-d', strtotime( $user->birth ) );
        
        if ($insert->save()) {
            return "succsess";
        }
        return "error";

    }*/
}
