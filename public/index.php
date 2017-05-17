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
use App\View\EventJsonView;
use \PDO;
use \AltoRouter;
use App\Controller\GebruikerController;

$pdo = null;

try {

    $database = require_once '../app/config/database.php';

    $pdo = new PDO("mysql:host=" . $database['host'] . ";dbname=" . $database['database'], $database['username'], $database['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $eventController = new EventController($pdo);
    $router = new AltoRouter();

    $router->setBasePath('/public/index.php');


    /* EXAMPLE
    /*
    /* http://127.0.0.1/public/index.php/events/
     */
    $router->map('GET', '/events/', function () use (&$eventController) {
        $eventController->handleGetAllEvents();
    });

    /* EXAMPLE
    /*
    /* http://127.0.0.1/public/index.php/event/1
     */
    $router->map('GET', '/event/[i:id]', function($id) use (&$eventController) {
       $eventController->handleGetEventByEventId($id);
    });

    /* EXAMPLE
    /*
    /* http://127.0.0.1/public/index.php/event/person/1
     */
    $router->map('GET', '/event/person/[i:id]', function($id) use (&$eventController) {
        $eventController->handleGetEventByPersonId($id);
    });

    /* EXAMPLE
    /*
    /* http://127.0.0.1/public/index.php/events/?from=2017-04-14&until=2017-04-15
     */
    $router->map('GET', '/events/?from=[a:action]&?until=[a:action]', function($from, $until) use (&$eventController) {
        $eventController->handleGetEventByDate($from, $until);
    });

    /* EXAMPLE
    /*
    /* http://127.0.0.1/public/index.php/person/1/events/?from=2017-04-14&until=2017-04-15
    this doesn't work.
     */
    $router->map('GET', '/person/[i:id]/events/?from=[a:action]?until=[a:action]', function($id, $from, $until) use (&$eventController) {
        $eventController->handleEventByPersonIdAndBeginAndEndDate($id, $from, $until);
    });

    $router->map('POST|PUT', '/event/create/', function () use (&$eventController) {
        $data = json_decode(file_get_contents("php://input"), true);
        $eventController->handleUpdateOrCreateEvent($data);
    });

    /*
     *  START GEBRUIKER MAPPINGS
     *
     */

    $gebruikerController = new GebruikerController($pdo);


    $router->map('GET', '/gebruikers/', function () use (&$gebruikerController) {
        $gebruikerController->handleGetAllGebruikers();
    });

    $router->map('GET', '/gebruiker/[i:id]', function ($id) use (&$gebruikerController) {
        $gebruikerController->handleGetGebruikerByGebruikerId($id);
    });

    $router->map('GET', '/gebruikers/name/[a:action]', function ($name) use (&$gebruikerController) {
        $gebruikerController->handleGetGebruikerByGebruikerName($name);
    });

    $router->map('GET', '/gebruikers/country/[a:action]', function ($country) use (&$gebruikerController) {
        $gebruikerController->handleGetGebruikerByGebruikerGemeente($country);
    });

    $router->map('GET', '/gebruikers/type/[a:action]', function ($type) use (&$gebruikerController) {
        $gebruikerController->handleGetGebruikerByGebruikerType($type);
    });

    $router->map('GET', '/gebruikers/telephonenumber/[a:action]', function ($telephonenumber) use (&$gebruikerController) {
        $gebruikerController->handleGetGebruikerByGebruikerTelefoon($telephonenumber);
    });

    $router->map('POST', '/gebruiker/geolocationSave/', function () use (&$gebruikerController) {
        $data = json_decode(file_get_contents("php://input"), true);
        $gebruikerController->saveLocationToGebruiker($data);
    });

    $router->map('POST|PUT', '/gebruiker/create', function () use (&$gebruikerController) {
        $data = json_decode(file_get_contents("php://input"), true);
        $gebruikerController->saveLocationToGebruiker($data);
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