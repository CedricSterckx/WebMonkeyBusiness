<?php
/**
 * Created by PhpStorm.
 * User: Cédric
 * Date: 13/04/2017
 * Time: 21:14
 */

namespace model;


class Event
{

    public $ProjectId;
    public $ProjectNaam;
    public $ProjectBeginDatum;
    public $ProjectEindDatum;
    public $KlantNummer;
    public $ProjectBezetting;
    public $ProjectKost;
    public $ProjectMateriaal;
    public $GebruikerId;

    /**
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->ProjectId;
    }

    /**
     * @param mixed $ProjectId
     */
    public function setProjectId($ProjectId)
    {
        $this->ProjectId = $ProjectId;
    }

    /**
     * @return mixed
     */
    public function getProjectNaam()
    {
        return $this->ProjectNaam;
    }

    /**
     * @param mixed $ProjectNaam
     */
    public function setProjectNaam($ProjectNaam)
    {
        $this->ProjectNaam = $ProjectNaam;
    }

    /**
     * @return mixed
     */
    public function getProjectBeginDatum()
    {
        return $this->ProjectBeginDatum;
    }

    /**
     * @param mixed $ProjectBeginDatum
     */
    public function setProjectBeginDatum($ProjectBeginDatum)
    {
        $this->ProjectBeginDatum = $ProjectBeginDatum;
    }

    /**
     * @return mixed
     */
    public function getProjectEindDatum()
    {
        return $this->ProjectEindDatum;
    }

    /**
     * @param mixed $ProjectEindDatum
     */
    public function setProjectEindDatum($ProjectEindDatum)
    {
        $this->ProjectEindDatum = $ProjectEindDatum;
    }

    /**
     * @return mixed
     */
    public function getKlantNummer()
    {
        return $this->KlantNummer;
    }

    /**
     * @param mixed $KlantNummer
     */
    public function setKlantNummer($KlantNummer)
    {
        $this->KlantNummer = $KlantNummer;
    }

    /**
     * @return mixed
     */
    public function getProjectBezetting()
    {
        return $this->ProjectBezetting;
    }

    /**
     * @param mixed $ProjectBezetting
     */
    public function setProjectBezetting($ProjectBezetting)
    {
        $this->ProjectBezetting = $ProjectBezetting;
    }

    /**
     * @return mixed
     */
    public function getProjectKost()
    {
        return $this->ProjectKost;
    }

    /**
     * @param mixed $ProjectKost
     */
    public function setProjectKost($ProjectKost)
    {
        $this->ProjectKost = $ProjectKost;
    }

    /**
     * @return mixed
     */
    public function getProjectMateriaal()
    {
        return $this->ProjectMateriaal;
    }

    /**
     * @param mixed $ProjectMateriaal
     */
    public function setProjectMateriaal($ProjectMateriaal)
    {
        $this->ProjectMateriaal = $ProjectMateriaal;
    }

    /**
     * @return mixed
     */
    public function getGebruikerId()
    {
        return $this->GebruikerId;
    }

    /**
     * @param mixed $GebruikerId
     */
    public function setGebruikerId($GebruikerId)
    {
        $this->GebruikerId = $GebruikerId;
    }




}