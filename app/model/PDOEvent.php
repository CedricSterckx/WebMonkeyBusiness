<?php

namespace App\Model;

use \PDOException;

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

    public function addEvent($projectNaam, $projectBeginDatum, $projectEindDatum, $projectKlantNummer, $projectBezetting, $projectKost, $projectMaterialen, $gebruikerID)
    {
        try {
            $statement = $this->connection->prepare('INSERT INTO projecten ' .
                '(ProjectNaam, ProjectBeginDatum, ProjectEindDatum, ProjectKlantNummer, ProjectBezetting, ProjectKost, ProjectMaterialen, GebruikerID)' .
                ' VALUES (?, ?, ?, ?, ?, ?, ?, ?);');
            $statement->bindParam(1, $projectNaam);
            $statement->bindParam(2, $projectBeginDatum);
            $statement->bindParam(3, $projectEindDatum);
            $statement->bindParam(4, $projectKlantNummer);
            $statement->bindParam(5, $projectBezetting);
            $statement->bindParam(6, $projectKost);
            $statement->bindParam(7, $projectMaterialen);
            $statement->bindParam(8, $gebruikerID);
            $statement->execute();

            $last_id = $this->connection->lastInsertId();
            return $last_id;
            //

        } catch (PDOException $e) {
            print 'Excpetion while trying to add an event: ' . $e->getMessage();
        }
    }

    public function UpdateEvent($projectId, $projectNaam, $projectBeginDatum, $projectEindDatum, $projectKlantNummer, $projectBezetting, $projectKost, $projectMaterialen, $gebruikerID)
    {
        $sql = "UPDATE projecten SET
            ProjectNaam = :naam, ProjectBeginDatum = :beginDatum , ProjectEindDatum = :eindDatum, ProjectKlantNummer = :klantNummer, ProjectBezetting = :bezetting, ProjectKost = :kost, ProjectMaterialen = :materialen, GebruikerID = :gebruikerId
             WHERE ProjectID=:id";

        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':id', $projectId);
            $statement->bindValue(':naam', $projectNaam);
            $statement->bindValue(':beginDatum', $projectBeginDatum);
            $statement->bindValue(':eindDatum', $projectEindDatum);
            $statement->bindValue(':klantNummer', $projectKlantNummer);
            $statement->bindValue(':bezetting', $projectBezetting);
            $statement->bindValue(':kost', $projectKost);
            $statement->bindValue(':materialen', $projectMaterialen);
            $statement->bindValue('gebruikerId', $gebruikerID);
            $statement->execute();

            return $projectId;
        } catch (PDOException $e) {
            print 'Exception while trying update an event: ' . $e->getMessage();
        }
    }


    public function getEventByPersonId($id)
    {
        $result = [];
        $sql = "SELECT * FROM projecten WHERE GebruikerID =  :id";

        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            foreach($statement->fetchAll() as $event) {
                array_push($result, EventFactory::create($event));
            }

        } catch (\PDOException $exception) {
            print ('Exception occured while trying to get an event by id
            ' . $exception->getMessage());
        }

        return $result;
    }

    public function getAllEvents()
    {
        $result = [];
        $sql = "SELECT * FROM projecten";
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            foreach($statement->fetchAll() as $event) {
                array_push($result, EventFactory::create($event));
            }

        } catch (\PDOException $exception) {
            print('Exception occured while trying to get all events ' . $exception->getMessage());
        }

        return $result;
    }

    public function getEventByEventId($id)
    {
        $result = [];
        $sql= "SELECT * FROM projecten WHERE ProjectID = :id";
        try {

            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();

            foreach($statement->fetchAll() as $event) {
                array_push($result, EventFactory::create($event));
            }

        } catch (\PDOException $exception) {
            print ('Exception occured while trying to get an event by an id
            ' . $exception->getMessage());
        }

        return $result;
    }

    public function getEventByDate($beginDate, $endDate)
    {
        $result = [];
        $sql = "SELECT * FROM projecten WHERE ProjectBeginDatum = :beginDate AND ProjectEindDatum= :endDate";
        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':beginDate', $beginDate);
            $statement->bindValue(':endDate', $endDate);
            $statement->execute();
            foreach($statement->fetchAll() as $event) {
                array_push($result, EventFactory::create($event));
            }

        } catch (\PDOException $exception) {
            print ('Exception occured while trying to get an event by an id
            ' . $exception->getMessage());
        }
        return $result;
    }

    public function getEventByPersonIdAndBeginAndEndDate($id, $beginDate, $endDate)
    {
        $result = [];
        $sql = "SELECT * FROM projecten WHERE GebruikerID = :id AND ProjectBeginDatum = :beginDate AND 	ProjectEindDatum= :endDate";
        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':beginDate', $beginDate);
            $statement->bindValue(':endDate', $endDate);
            $statement->bindValue(':id', $id);
            $statement->execute();
            foreach($statement->fetchAll() as $event) {
                array_push($result, EventFactory::create($event));
            }
        } catch (\PDOException $exception) {
            print ('Exception occured while trying to get an event by an id
            ' . $exception->getMessage());
        }
        return $result;
    }

}