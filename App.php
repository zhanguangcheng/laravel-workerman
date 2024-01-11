<?php

use Illuminate\Contracts\Http\Kernel;
use Workerman\Connection\TcpConnection;
use Workerman\Lib\Timer;
use Workerman\Protocols\Http\Request;

class App
{
    public static Kernel $kernel;

    public static function init(): void
    {
        $app = require_once __DIR__ . '/bootstrap/app.php';
        static::$kernel = $app->make(Kernel::class);
    }

    public static function send(TcpConnection $connection, Request $request): void
    {
        ob_start();

        $response = static::$kernel->handle(
            $request = Illuminate\Http\Request::capture()
        );
        $response->send();
        static::$kernel->terminate($request, $response);

        $response = (string)ob_get_clean();
        $connection->send($response);
    }

    public static function stop(): void
    {
        Timer::delAll();
    }
}
