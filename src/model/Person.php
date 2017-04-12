<?php
/**
 * Created by PhpStorm.
 * User: Cédric
 * Date: 11/04/2017
 * Time: 15:12
 */

namespace model;


class Person
{

    public $id;
    public $gebruikerNaam;
    public $gebruikerVoorNaam;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getGebruikerNaam()
    {
        return $this->gebruikerNaam;
    }

    /**
     * @param mixed $gebruikerNaam
     */
    public function setGebruikerNaam($gebruikerNaam)
    {
        $this->gebruikerNaam = $gebruikerNaam;
    }

    /**
     * @return mixed
     */
    public function getGebruikerVoorNaam()
    {
        return $this->gebruikerVoorNaam;
    }

    /**
     * @param mixed $gebruikerVoorNaam
     */
    public function setGebruikerVoorNaam($gebruikerVoorNaam)
    {
        $this->gebruikerVoorNaam = $gebruikerVoorNaam;
    }




}