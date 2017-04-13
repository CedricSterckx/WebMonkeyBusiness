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
            print 'Excpetion while trying to add an event: ' . $e->getMessage();
        }
    }

    public function UpdateEvent($ProjectId, $ProjectNaam, $ProjectBeginDatum, $ProjectEindDatum, $ProjectKlantNummer, $ProjectBezetting, $ProjectKost, $ProjectMaterialen)
    {
        //???
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


    public function getEventByPersonId($id){

        try{
            $statement = $this->connection->prepare('SELECT * 
            FROM gebruikers WHERE GebruikerID =  :id');
            $statement->bindValue(':id', $id);
            $statement->execute();
        } catch (\PDOException $exception){
            print ('Exception occured while trying to get an event by id
            ' .$exception->getMessage());
        }


    }

    public function getAllEvents(){
        try{
            $statement = $this->connection->prepare('SELECT * 
            FROM projecten;');
            $statement->execute();
        } catch (\PDOException $exception){
            print ('Exception occured while trying to get all events
            ' .$exception->getMessage());
        }
    }

    public function getEventByEventId($id){
        try{
            $statement = $this->connection->prepare('SELECT * 
            FROM projecten WHERE EvenementID = :id');
            $statement->bindValue(':id', $id);
            $statement->execute();
        } catch (\PDOException $exception){
            print ('Exception occured while trying to get an event by an id
            ' .$exception->getMessage());
        }
    }

    public function getEventByDate($beginDate, $endDate){
        try{
            $statement = $this->connection->prepare('SELECT * 
            FROM projecten WHERE ProjectBeginDatum = :beginDate AND 	ProjectEindDatum= :endDate');
            $statement->bindValue(':beginDate', $beginDate);
            $statement->bindValue(':endDate' , $endDate);
            $statement->execute();
        } catch (\PDOException $exception){
            print ('Exception occured while trying to get an event by an id
            ' .$exception->getMessage());
        }
    }


    public function getEventByPersonIdAndBeginAndEndDate($id, $beginDate, $endDate){
        try{
            $statement = $this->connection->prepare('SELECT * 
            FROM projecten WHERE GebruikerID = :id AND ProjectBeginDatum = :beginDate AND 	ProjectEindDatum= :endDate');
            $statement->bindValue(':beginDate', $beginDate);
            $statement->bindValue(':endDate' , $endDate);
            $statement->bindValue(':id' , $id);
            $statement->execute();
        } catch (\PDOException $exception){
            print ('Exception occured while trying to get an event by an id
            ' .$exception->getMessage());
        }
    }

}