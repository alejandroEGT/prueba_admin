<?php

namespace App\Events;

use App\User;
use App\messagePro;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageProyecto implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, messagePro $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $id_pro = \Session::get('id_proyecto');

        $list_user = \DB::table('colaborador-proyecto')
        ->join('colaboradores', 'colaboradores.id','=','colaborador-proyecto.id_colaborador')
        ->join('users','users.id','=','colaboradores.id_user')->where('colaborador-proyecto.id_proyecto', $id_pro)->get();

                
        $channels = [];
        $users;

        foreach ($list_user as $users) {
            array_push($channels, new PrivateChannel('chatProyecto.'.$users->id_user));
        }

        return $channels;
       // dd($channels);
        //return new PrivateChannel('chatProyecto');
    }
}
