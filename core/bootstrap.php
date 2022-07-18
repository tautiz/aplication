<?php

require_once __DIR__.'/../vendor/autoload.php';

use Core\ClassLoader;
use Monolog\Level;
use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\UserController;

$log = new Monolog\Logger('name');
$log->pushHandler(new Monolog\Handler\StreamHandler('../logs/app.log', Level::Warning));

try {
    SimpleRouter::setCustomClassLoader(new ClassLoader());

    SimpleRouter::get('/', [UserController::class, 'index']);
    SimpleRouter::get('/user/{id}', [UserController::class, 'showProfile']);
    SimpleRouter::post('/user', [UserController::class, 'store']);

    SimpleRouter::start();
} catch (Throwable $exception) {
    $log->error($exception->getMessage(), $exception->getTrace());
    echo "Ups.. looks like we had a problem ;)";
}
