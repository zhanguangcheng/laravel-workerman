<?php

use Illuminate\Contracts\Http\Kernel;
use Workerman\Connection\TcpConnection;
use Workerman\Lib\Timer;
use Workerman\Protocols\Http\Request;

class App
{
    public static Kernel $kernel;
    public static string $headerDate;
    public static int $requestTime;
    public static float $requestTimeFloat;

    public static function init(): void
    {
        self::timer();
        Timer::add(1, [self::class, 'timer']);
        $app = require_once __DIR__ . '/bootstrap/app.php';
        static::$kernel = $app->make(Kernel::class);
    }

    public static function timer(): void
    {
        self::$headerDate = 'Date: ' . gmdate('D, d M Y H:i:s') . ' GMT';
        self::$requestTime = time();
        self::$requestTimeFloat = microtime(true);
    }

    public static function send(TcpConnection $connection, Request $request): void
    {
        // $_SERVER['HTTPS'] = 'on';
        $_SERVER['REQUEST_TIME_FLOAT'] = self::$requestTimeFloat;
        $_SERVER['REQUEST_TIME'] = self::$requestTime;

        ob_start();

        $response = static::$kernel->handle(
            $request = Illuminate\Http\Request::capture()
        );
        $response->send();
        static::$kernel->terminate($request, $response);

        $response = (string)ob_get_clean();
        header(self::$headerDate);
        $connection->send($response);
    }

    public static function stop(): void
    {
        Timer::delAll();
    }
}
