<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-box text-gray-800 dark:text-gray-200 text-xl mr-3"></i>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Panel de Pedidos') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-purple-900 dark:to-indigo-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card principal -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-2xl p-6 mb-8" style="box-shadow: 0 0 15px rgba(79, 172, 254, 0.5);">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <div>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-2">
                            <i class="fas fa-bell text-purple-500 mr-2"></i>
                            Sistema de Notificaciones en Tiempo Real
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Usuario autenticado: 
                            <span class="font-semibold text-blue-600 dark:text-blue-400">{{ auth()->user()->name }}</span>
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Como <strong>creador</strong> verás confirmaciones • Como <strong>receptor</strong> verás alertas detalladas
                        </p>
                    </div>
                    
                    <button id="btnCrearPedido" 
                            class="mt-4 md:mt-0 px-6 py-3 bg-gradient-to-r from-blue-400 to-cyan-400 text-white rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-300 font-bold flex items-center">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Crear pedido de prueba
                    </button>
                </div>
                    
                    <div class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-3 py-2 rounded-lg">
                        <i class="fas fa-info-circle mr-1"></i>
                        Las notificaciones se actualizan automáticamente
                    </div>
                </div>

                <div id="notificaciones" class="mt-8 space-y-4"></div>
                
                <!-- Estado vacío -->
                <div id="emptyState" class="text-center py-12">
                    <i class="fas fa-inbox text-gray-300 dark:text-gray-600 text-6xl mb-4"></i>
                    <h4 class="text-xl font-semibold text-gray-500 dark:text-gray-400">No hay notificaciones</h4>
                    <p class="text-gray-400 dark:text-gray-500 mt-2">Los pedidos nuevos aparecerán aquí</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>