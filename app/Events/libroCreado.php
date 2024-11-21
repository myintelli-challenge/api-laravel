<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Libros;

/**
 * Este evento se ejecuta cuando se crea un nuevo libro
 */
class libroCreado
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $libro;

    /**
     * Crea una instancia del evento
     *
     * @param \App\Libros $libros
     * @return void
     */
    public function __construct(Libros $libro)
    {
        $this->libro = $libro;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
