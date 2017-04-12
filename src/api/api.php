<?php namespace api;

/**
 * Created by PhpStorm.
 * User: Cédric_St
 * Date: 10/04/2017
 * Time: 17:52
 */

require "../autoload.php";
require "../../vendor/autoload.php";

use \model\PDOPersonRepository;
use \controller\PersonController;
use \view\PersonJsonView;

$user = "root";
$password = "";
$database = "monkeybusiness";
$hostname = "localhost";
$pdo = null;

try {

    $pdo = new \PDO("mysql:host=$hostname; dbname=$database, $user, $password");
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $personPDORepository = new PDOPersonRepository($pdo);
    $personJsonView = new PersonJsonView();
    $personController = new PersonController($personPDORepository, $personJsonView);
    $router = new \AltoRouter();
    $router->setBasePath('/api');
    $router->map('GET', '/persons/[i:id]', function($id) use (&$personController){
        $personController->handleFindPersonById($id);
    });

   $match = $router->match();

   if ( $match && is_callable( $match['target'])){
       call_user_func_array( $match['target'], $match['params']);
   }

} catch (\Exception $exception){
    var_dump($exception);
}