<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PedidoCreado implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pedido;
    public $creadorId; // ID del usuario que CREÓ el pedido
    public $receptorId; // ID del usuario que RECIBE la notificación

    public function __construct($pedido, $creadorId, $receptorId)
    {
        $this->pedido = $pedido;
        $this->creadorId = $creadorId;
        $this->receptorId = $receptorId;
        
        Log::info('🔥 Evento PedidoCreado construido', [
            'pedido' => $pedido,
            'creadorId' => $creadorId,
            'receptorId' => $receptorId
        ]);
    }

    public function broadcastOn()
    {
        Log::info('📡 Broadcasting en canal: user.' . $this->receptorId, [
            'canal' => 'user.' . $this->receptorId,
            'creador' => $this->creadorId,
            'receptor' => $this->receptorId
        ]);
        return new PrivateChannel('user.' . $this->receptorId);
    }
}