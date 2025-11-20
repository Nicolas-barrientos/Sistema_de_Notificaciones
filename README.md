# Sistema de Notificaciones en Tiempo Real - Laravel 12 + Reverb + Echo

## Descripción

Este proyecto implementa un **sistema de notificaciones en tiempo real** utilizando Laravel 12 y Reverb como servidor de broadcast.  
Permite que usuarios autenticados reciban alertas instantáneas cuando ocurre un evento importante, como **crear nuevos pedidos**.  
Las notificaciones se muestran en tiempo real en el dashboard de cada usuario usando **Laravel Echo y JavaScript**.

---

## Clonar el repositorio

```bash
# Clonar el repositorio
git clone https://github.com/Nicolas-barrientos/Sistema_de_Notificaciones-.git

# Entrar a la carpeta del proyecto
cd ejemplo-notificaciones

#Dependencias
Backend (Laravel 12)
° PHP >= 8.2
° Laravel 12
° Laravel Reverb (broadcast server)
° MySQL (base de datos)
° Composer (para instalar dependencias PHP)

Dependencias:
composer install                  # Instalar dependencias PHP
composer require laravel/framework
composer require laravel/reverb    # Para WebSockets en tiempo real
composer require pusher/pusher-php-server
composer require laravel/breeze --dev   # Breeze para autenticación
php artisan key:generate
php artisan breeze:install blade   # Instalar frontend de Breeze


Frontend
° Node.js >= 18
° NPM
° Laravel Echo
° Vite (para compilar assets)

npm install                       # Instalar dependencias JS
npm install laravel-echo
npm install pusher-js
npm install alpinejs
npm install vite
npm install laravel-vite-plugin
npm install tailwindcss postcss autoprefixer
npm run dev                        # Compilar assets para desarrollo

Instalar Reverb
php artisan reverb:install         # Instalar Laravel Reverb


Configuración

1. Copiar el archivo .env.example a .env:

cp .env.example .env

2. Configurar la base de datos:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=notificaciones_db
DB_USERNAME=root
DB_PASSWORD=

3. Configurar Reverb:
BROADCAST_CONNECTION=reverb
REVERB_APP_KEY=tu_app_key
REVERB_HOST=127.0.0.1
REVERB_PORT=8080
REVERB_SCHEME=http
VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"

4. Migrar la base de datos:

php artisan migrate

Levantar el sistema

php artisan reverb:start     # Iniciar Laravel Reverb
php artisan serve            # Iniciar el servidor de Laravel
npm run dev                  # Compilar assets 
 
 ## Abrir en el navegador: http://localhost:8000/dashboard
 ## Abrir otra ventana con otro usuario para probar notificaciones en tiempo real.

Flujo del sistema

1- Un usuario autenticado aprieta el botón “Crear pedido” en el dashboard.
2- El backend crea un pedido y dispara el evento PedidoCreado.
3- Laravel Reverb envía la notificación a los canales privados de los usuarios suscritos.
4- Las ventanas de los usuarios que están escuchando el canal con Laravel Echo reciben la notificación al instante y actualizan el contador y la lista en el dashboard.

Stack de Tecnologías:
| Capa           | Tecnología                        |
| -------------- | --------------------------------- |
| Backend        | Laravel 12                        |
| Broadcast      | Laravel Reverb                    |
| Frontend       | Laravel Echo + JavaScript + Blade |
| Base de Datos  | MySQL                             |
| Compilación JS | Node.js + Vite                    |
| Estilos        | Tailwind CSS                      |

