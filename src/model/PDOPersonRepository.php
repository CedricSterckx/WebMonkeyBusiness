<?php namespace model;

/**
 * Created by PhpStorm.
 * User: Cédric
 * Date: 08/04/2017
 * Time: 21:06
 */
class PDOPersonRepository
{


    private $connection  = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }




}



