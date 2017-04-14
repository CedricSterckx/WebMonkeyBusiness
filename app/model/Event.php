<?php

namespace App\Model;

/**
 * Created by PhpStorm.
 * User: Cédric
 * Date: 13/04/2017
 * Time: 21:14
 */
class Event
{

    public $projectId;
    public $projectNaam;
    public $projectBeginDatum;
    public $projectEindDatum;
    public $projectKlantNummer;
    public $projectBezetting;
    public $projectKost;
    public $projectMaterialen;
    public $gebruikerId;

    /**
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @param mixed $projectId
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }

    /**
     * @return mixed
     */
    public function getProjectNaam()
    {
        return $this->projectNaam;
    }

    /**
     * @param mixed $projectNaam
     */
    public function setProjectNaam($projectNaam)
    {
        $this->projectNaam = $projectNaam;
    }

    /**
     * @return mixed
     */
    public function getProjectBeginDatum()
    {
        return $this->projectBeginDatum;
    }

    /**
     * @param mixed $projectBeginDatum
     */
    public function setProjectBeginDatum($projectBeginDatum)
    {
        $this->projectBeginDatum = $projectBeginDatum;
    }

    /**
     * @return mixed
     */
    public function getProjectEindDatum()
    {
        return $this->projectEindDatum;
    }

    /**
     * @param mixed $projectEindDatum
     */
    public function setProjectEindDatum($projectEindDatum)
    {
        $this->projectEindDatum = $projectEindDatum;
    }

    /**
     * @return mixed
     */
    public function getProjectKlantNummer()
    {
        return $this->projectKlantNummer;
    }

    /**
     * @param mixed $projectKlantNummer
     */
    public function setProjectKlantNummer($projectKlantNummer)
    {
        $this->projectKlantNummer = $projectKlantNummer;
    }

    /**
     * @return mixed
     */
    public function getProjectBezetting()
    {
        return $this->projectBezetting;
    }

    /**
     * @param mixed $projectBezetting
     */
    public function setProjectBezetting($projectBezetting)
    {
        $this->projectBezetting = $projectBezetting;
    }

    /**
     * @return mixed
     */
    public function getProjectKost()
    {
        return $this->projectKost;
    }

    /**
     * @param mixed $projectKost
     */
    public function setProjectKost($projectKost)
    {
        $this->projectKost = $projectKost;
    }

    /**
     * @return mixed
     */
    public function getProjectMaterialen()
    {
        return $this->projectMaterialen;
    }

    /**
     * @param mixed $projectMaterialen
     */
    public function setProjectMaterialen($projectMaterialen)
    {
        $this->projectMaterialen = $projectMaterialen;
    }

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


   }