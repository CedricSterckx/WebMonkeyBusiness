<?php
namespace model;

use PDOException;

/**
 * Created by PhpStorm.
 * User: Ebert Joris
 * Date: 11/04/2017
 * Time: 12:38
 */
class PDOEvent
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function addEvent($ProjectNaam, $ProjectBeginDatum, $ProjectEindDatum, $ProjectKlantNummer, $ProjectBezetting, $ProjectKost, $ProjectMaterialen)
    {
        try {
            $statement = $this->connection->prepare('INSERT INTO projecten'.
                '(ProjectNaam, ProjectBeginDatum, ProjectEindDatum, ProjectKlantNummer, ProjectBezetting, ProjectKost, ProjectMaterialen)'.
                ' VALUES (?, ?, ?, ?, ?, ?, ?);');
            $statement->bindParam(1, $ProjectNaam);
            $statement->bindParam(2, $ProjectBeginDatum);
            $statement->bindParam(3, $ProjectEindDatum);
            $statement->bindParam(4, $ProjectKlantNummer);
            $statement->bindParam(5, $ProjectBezetting);
            $statement->bindParam(6, $ProjectKost);
            $statement->bindParam(7, $ProjectMaterialen);
            $statement->execute();
        } catch (PDOException $e) {
            print 'Excpetion!: ' . $e->getMessage();
        }
    }

    public function UpdateEvent($ProjectId, $ProjectNaam, $ProjectBeginDatum, $ProjectEindDatum, $ProjectKlantNummer, $ProjectBezetting, $ProjectKost, $ProjectMaterialen)
    {
        try {
            $statement = $this->connection->prepare('UPDATE projecten WHERE ProjectID=?'.
                '(ProjectNaam, ProjectBeginDatum, ProjectEindDatum, ProjectKlantNummer, ProjectBezetting, ProjectKost, ProjectMaterialen)'.
                ' VALUES (?, ?, ?, ?, ?, ?, ?);');
            $statement->bindParam(1, $ProjectId);
            $statement->bindParam(2, $ProjectNaam);
            $statement->bindParam(3, $ProjectBeginDatum);
            $statement->bindParam(4, $ProjectEindDatum);
            $statement->bindParam(5, $ProjectKlantNummer);
            $statement->bindParam(6, $ProjectBezetting);
            $statement->bindParam(7, $ProjectKost);
            $statement->bindParam(8, $ProjectMaterialen);
            $statement->execute();
        } catch (PDOException $e) {
            print 'Excpetion!: ' . $e->getMessage();
        }
    }

}