<?php

namespace App\Api;

/**
 * Created by PhpStorm.
 * User: Cédric_St
 * Date: 10/04/2017
 * Time: 17:52
 */

require "../vendor/autoload.php";


use App\Model\PDOEvent;
use App\Controller\EventController;
use App\View\AllEventsJsonView;
use \PDO;
use \AltoRouter;

$pdo = null;

try {

    $database = require_once '../app/config/database.php';

    $pdo = new PDO("mysql:host=" . $database['host'] . ";dbname=" . $database['database'], $database['username'], $database['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $eventController = new EventController($pdo);
    $router = new AltoRouter();

    $router->setBasePath('/mb/public'); // Remove this if you do not have the sub map

    $router->map('GET', '/events/', function () use (&$eventController) {
        $eventController->handleGetAllEvents();
    });

    $router->map('POST', '/event/create/', function () use (&$eventController) {
        $decodedEvent = json_decode($_POST);
        $data = $decodedEvent['event'];
        $eventController->handleUpdateOrCreateEvent($data);
    });

    $match = $router->match();

    if ($match && is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    }else{
        http_response_code(404);
    }

} catch (\Exception $exception) {
    var_dump($exception);
}