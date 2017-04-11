<?php namespace controller;

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
}

}