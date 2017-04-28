<?php

namespace App\Model;

/**
 * Created by PhpStorm.
 * User: Cédric
 * Date: 13/04/2017
 * Time: 21:14
 */
class Gebruiker
{

    private $gebruikerId;
    private $gebruikerNaam;
    private $gebruikerVoornaam;
    private $gebruikerPostCode;
    private $gebruikerGemeente;
    private $gebruikerStraat;
    private $gebruikerHuisnummer;
    private $gebruikerTelefoon;
    private $gebruikerGsm;
    private $gebruikerMail;
    private $gebruikerType;

    /**
     * @return mixed
     */
    public function getGebruikerId()
    {
        return $this->gebruikerId;
    }

    /**
     * @param mixed $gebruikerId
     */
    public function setGebruikerId($gebruikerId)
    {
        $this->gebruikerId = $gebruikerId;
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
    public function getGebruikerVoornaam()
    {
        return $this->gebruikerVoornaam;
    }

    /**
     * @param mixed $gebruikerVoornaam
     */
    public function setGebruikerVoornaam($gebruikerVoornaam)
    {
        $this->gebruikerVoornaam = $gebruikerVoornaam;
    }

    /**
     * @return mixed
     */
    public function getGebruikerPostCode()
    {
        return $this->gebruikerPostCode;
    }

    /**
     * @param mixed $gebruikerPostCode
     */
    public function setGebruikerPostCode($gebruikerPostCode)
    {
        $this->gebruikerPostCode = $gebruikerPostCode;
    }

    /**
     * @return mixed
     */
    public function getGebruikerGemeente()
    {
        return $this->gebruikerGemeente;
    }

    /**
     * @param mixed $gebruikerGemeente
     */
    public function setGebruikerGemeente($gebruikerGemeente)
    {
        $this->gebruikerGemeente = $gebruikerGemeente;
    }

    /**
     * @return mixed
     */
    public function getGebruikerStraat()
    {
        return $this->gebruikerStraat;
    }

    /**
     * @param mixed $gebruikerStraat
     */
    public function setGebruikerStraat($gebruikerStraat)
    {
        $this->gebruikerStraat = $gebruikerStraat;
    }

    /**
     * @return mixed
     */
    public function getGebruikerHuisnummer()
    {
        return $this->gebruikerHuisnummer;
    }

    /**
     * @param mixed $gebruikerHuisnummer
     */
    public function setGebruikerHuisnummer($gebruikerHuisnummer)
    {
        $this->gebruikerHuisnummer = $gebruikerHuisnummer;
    }

    /**
     * @return mixed
     */
    public function getGebruikerTelefoon()
    {
        return $this->gebruikerTelefoon;
    }

    /**
     * @param mixed $gebruikerTelefoon
     */
    public function setGebruikerTelefoon($gebruikerTelefoon)
    {
        $this->gebruikerTelefoon = $gebruikerTelefoon;
    }

    /**
     * @return mixed
     */
    public function getGebruikerGsm()
    {
        return $this->gebruikerGsm;
    }

    /**
     * @param mixed $gebruikerGsm
     */
    public function setGebruikerGsm($gebruikerGsm)
    {
        $this->gebruikerGsm = $gebruikerGsm;
    }

    /**
     * @return mixed
     */
    public function getGebruikerMail()
    {
        return $this->gebruikerMail;
    }

    /**
     * @param mixed $gebruikerMail
     */
    public function setGebruikerMail($gebruikerMail)
    {
        $this->gebruikerMail = $gebruikerMail;
    }

    /**
     * @return mixed
     */
    public function getGebruikerType()
    {
        return $this->gebruikerType;
    }

    /**
     * @param mixed $gebruikerType
     */
    public function setGebruikerType($gebruikerType)
    {
        $this->gebruikerType = $gebruikerType;
    }


   }