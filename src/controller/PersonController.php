<?php namespace controller;
use model\PDOPersonRepository;
use View\PersonJsonView;

/**
 * Created by PhpStorm.
 * User: Cédric
 * Date: 08/04/2017
 * Time: 21:16
 */

class PersonController
{
    public $PDOPersonRepository;
    public $PersonJsonView;
//hier komen de method met routes

public function __construct($personPDORepository, $personJsonView)
{
    $this->PDOPersonRepository = new PDOPersonRepository($personPDORepository);
    $this->PersonJsonView = new PersonJsonView($personJsonView);
}

    public function handleFindPersonById($id){



    }



}