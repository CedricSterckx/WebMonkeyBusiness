<?php
/**
 * Created by PhpStorm.
 * User: Cédric_St
 * Date: 29/03/2017
 * Time: 11:03
 */

include '../vendor/autoload.php';

$database = require_once '../app/config/database.php';

$pdo = new PDO("mysql:host=" . $database['host'] . ";dbname=" . $database['database'], $database['username'], $database['password']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$view = new \App\View\EventJsonView();

$controller = new \App\Controller\EventController($pdo, $view);

$controller->handleGetAllEvents();
