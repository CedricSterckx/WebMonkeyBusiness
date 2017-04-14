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

    public function addEvent($projectNaam, $projectBeginDatum, $projectEindDatum, $projectKlantNummer, $projectBezetting, $projectKost, $projectMaterialen)
    {
        try {
            $statement = $this->connection->prepare('INSERT INTO projecten' .
                '(ProjectNaam, ProjectBeginDatum, ProjectEindDatum, ProjectKlantNummer, ProjectBezetting, ProjectKost, ProjectMaterialen)' .
                ' VALUES (?, ?, ?, ?, ?, ?, ?);');
            $statement->bindParam(1, $projectNaam);
            $statement->bindParam(2, $projectBeginDatum);
            $statement->bindParam(3, $projectEindDatum);
            $statement->bindParam(4, $projectKlantNummer);
            $statement->bindParam(5, $projectBezetting);
            $statement->bindParam(6, $projectKost);
            $statement->bindParam(7, $projectMaterialen);
            $statement->execute();

            //

        } catch (PDOException $e) {
            print 'Excpetion while trying to add an event: ' . $e->getMessage();
        }
    }

    public function UpdateEvent($ProjectId, $ProjectNaam, $ProjectBeginDatum, $ProjectEindDatum, $ProjectKlantNummer, $ProjectBezetting, $ProjectKost, $ProjectMaterialen)
    {

        try {
            $statement = $this->connection->prepare('UPDATE projecten WHERE ProjectID=?' .
                '(ProjectNaam, ProjectBeginDatum, ProjectEindDatum, ProjectKlantNummer, ProjectBezetting, ProjectKost, ProjectMaterialen)' .
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
            print 'Exception while trying update an event: ' . $e->getMessage();
        }
    }


    public function getEventByPersonId($id)
    {
        $result = [];
        $sql = "SELECT * FROM gebruikers WHERE GebruikerID =  :id";

        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            foreach($statement->fetchAll(PDO::FETCH_ASSOC) as $event) {
                array_push($result, EventFactory::create($event));
            }

        } catch (\PDOException $exception) {
            print ('Exception occured while trying to get an event by id
            ' . $exception->getMessage());
        }


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
        $sql= "SELECT * FROM projecten WHERE EvenementID = :id";
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
    }

}