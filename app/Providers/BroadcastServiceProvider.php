<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Broadcasting\PrivateChannel;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();


        Broadcast::channel('App.User.{id}', function ($user, $id) {
           
            return true;

        });

        Broadcast::channel('chat', function ($user) {
      
            return true;
        });
        //require base_path('routes/channels.php');
    }
}
