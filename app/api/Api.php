<?php

namespace App\Api;

/**
 * Created by PhpStorm.
 * User: Cédric_St
 * Date: 10/04/2017
 * Time: 17:52
 */

require "../autoload.php";
require "../../vendor/autoload.php";


use app\model\PDOEvent;
use app\controller\EventController;
use app\View\AllEventsJsonView;

$user = "root";
$password = "";
$database = "monkeybusiness";
$hostname = "localhost";
$pdo = null;

try {

    $pdo = new \PDO("mysql:host=$hostname; dbname=$database, $user, $password");
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    $eventController = new EventController($pdo);
    $router = new \AltoRouter();
    $router->setBasePath('/api');

    $router->map('GET', '/events/', function() use (&$eventController){
        $eventController->handleGetAllEvents();
    });
    $router->map('POST', '/event/create/', function() use (&$eventController) {
        $decodedEvent = json_decode($_POST);
        $data = $decodedEvent['event'];
        $eventController->handleUpdateOrCreateEvent($data);
    });


   $match = $router->match();

   if ( $match && is_callable( $match['target'])){
       call_user_func_array( $match['target'], $match['params']);
   }

} catch (\Exception $exception){
    var_dump($exception);
}