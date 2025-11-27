<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Events\PedidoCreado;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // 🔥 Ruta para crear pedido de prueba
    Route::get('/crear-pedido', function () {
        $pedido = [
            'id' => rand(1000, 9999),
            'producto' => 'Producto de prueba',
            'precio' => rand(100, 1000)
        ];

        // Obtener el usuario actual (CREADOR)
        $creador = Auth::user();
        
        Log::info('🔵 INICIANDO CREACIÓN DE PEDIDO', [
            'creador_id' => $creador->id,
            'creador_nombre' => $creador->name,
            'pedido_id' => $pedido['id']
        ]);
        
        // Obtener TODOS los usuarios (incluyendo el creador para debug)
        $todosLosUsuarios = User::all();
        
        Log::info('👥 USUARIOS EN LA BASE DE DATOS', [
            'total_usuarios' => $todosLosUsuarios->count(),
            'usuarios' => $todosLosUsuarios->pluck('name', 'id')->toArray()
        ]);
        
        // Obtener todos los usuarios EXCEPTO el creador (RECEPTORES)
        $receptores = User::where('id', '!=', $creador->id)->get();
        
        Log::info('📨 RECEPTORES IDENTIFICADOS', [
            'total_receptores' => $receptores->count(),
            'receptores' => $receptores->pluck('name', 'id')->toArray()
        ]);
        
        // Enviar notificación al CREADOR (confirmación)
        Log::info('✅ Enviando confirmación al CREADOR', [
            'receptor_id' => $creador->id,
            'receptor_nombre' => $creador->name
        ]);
        event(new PedidoCreado($pedido, $creador->id, $creador->id));
        
        // Enviar notificación a todos los RECEPTORES (alerta)
        foreach ($receptores as $receptor) {
            Log::info('🔔 Enviando alerta al RECEPTOR', [
                'receptor_id' => $receptor->id,
                'receptor_nombre' => $receptor->name,
                'creador_id' => $creador->id
            ]);
            event(new PedidoCreado($pedido, $creador->id, $receptor->id));
        }

        Log::info('✅ PEDIDO CREADO COMPLETAMENTE', [
            'pedido_id' => $pedido['id'],
            'notificaciones_enviadas' => $receptores->count() + 1 // receptores + creador
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pedido creado y notificaciones enviadas',
            'pedido' => $pedido,
            'creador' => $creador->name,
            'creador_id' => $creador->id,
            'receptores' => $receptores->pluck('name', 'id')->toArray(),
            'total_notificaciones' => $receptores->count() + 1
        ]);
    })->name('crear.pedido');
});

require __DIR__.'/auth.php';