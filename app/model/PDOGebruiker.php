<?php


namespace App\Model;

use \PDOException;

/**
 * Created by PhpStorm.
 * User: Ebert Joris
 * Date: 26/04/2017
 * Time: 14:36
 */
class PDOGebruiker
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }


    public function addGebruiker($gebruikerNaam, $gebruikerVoornaam, $gebruikerPostCode, $gebruikerGemeente, $gebruikerStraat, $gebruikerHuisnummer, $gebruikerTelefoon, $gebruikerGsm, $gebruikerMail, $gebruikerType)
    {
        try {
            $statement = $this->connection->prepare('INSERT INTO projecten (GebruikerNaam,GebruikerVoornaam,GebruikerPostcode,GebruikerGemeente,GebruikerStraat,GebruikerHuisnummer,GebruikerTelefoon,GebruikerGSM,GebruikerMail,GebruikerType)' .
                ' VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
            $statement->bindParam(1, $gebruikerNaam);
            $statement->bindParam(2, $gebruikerVoornaam);
            $statement->bindParam(3, $gebruikerPostCode);
            $statement->bindParam(4, $gebruikerGemeente);
            $statement->bindParam(5, $gebruikerStraat);
            $statement->bindParam(6, $gebruikerHuisnummer);
            $statement->bindParam(7, $gebruikerTelefoon);
            $statement->bindParam(8, $gebruikerGsm);
            $statement->bindParam(9, $gebruikerMail);
            $statement->bindParam(10, $gebruikerType);
            $statement->execute();

            $last_id = $this->connection->lastInsertId();
            return $last_id;
            //

        } catch (PDOException $e) {
            print 'Excpetion while trying to add an event: ' . $e->getMessage();
        }
    }

    public function updateGebruiker($gebruikerId, $gebruikerNaam, $gebruikerVoornaam, $gebruikerPostCode, $gebruikerGemeente, $gebruikerStraat, $gebruikerHuisnummer, $gebruikerTelefoon, $gebruikerGsm, $gebruikerMail, $gebruikerType)
    {
        $sql = "UPDATE projecten SET
        GebruikerNaam = :naam, GebruikerVoornaam = :voornaam , GebruikerPostCode = :postcode,
         GebruikerGemeente = :gemeente, GebruikerStraat = :straat, GebruikerHuisnummer = :huisnummer,
          GebruikerTelefoon = :telefoon, GebruikerGSM = :gsm, GebruikerMail = :mail, GebruikerType = :gebruikertype
             WHERE GebruikerID=:id";

        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':id', $gebruikerId);
            $statement->bindValue(':naam', $gebruikerNaam);
            $statement->bindValue(':voornaam', $gebruikerVoornaam);
            $statement->bindValue(':postcode', $gebruikerPostCode);
            $statement->bindValue(':gemeente', $gebruikerGemeente);
            $statement->bindValue(':straat', $gebruikerStraat);
            $statement->bindValue(':huisnummer', $gebruikerHuisnummer);
            $statement->bindValue(':telefoon', $gebruikerTelefoon);
            $statement->bindValue(':gsm', $gebruikerGsm);
            $statement->bindValue(':mail', $gebruikerMail);
            $statement->bindValue(':gebruikertype', $gebruikerType);
            $statement->execute();

            return $gebruikerId;
        } catch (PDOException $e) {
            print 'Exception while trying update an event: ' . $e->getMessage();
        }
    }

    public function getGebruikerByGebruikerId($id)
    {
        $result = [];
        $sql = "SELECT * FROM gebruikers WHERE GebruikerID = :id";

        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            foreach($statement->fetchAll() as $gebruiker) {
                array_push($result, GebruikerFactory::create($gebruiker));
            }

        } catch (\PDOException $exception) {
            print ('Exception occured while trying to get an event by id
            ' . $exception->getMessage());
        }

        return $result;
    }

    public function getAllGebruikers()
    {
        $result = [];
        $sql = "SELECT * FROM gebruikers";
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            foreach($statement->fetchAll() as $gebruiker) {
                array_push($result, GebruikerFactory::create($gebruiker));
            }

        } catch (\PDOException $exception) {
            print('Exception occured while trying to get all events ' . $exception->getMessage());
        }

        return $result;
    }

    public function getGebruikerByGebruikerName($name)
    {
        $result = [];
        $sql = "SELECT * FROM gebruikers WHERE GebruikerNaam = :gebruikername";

        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':gebruikername', $name);
            $statement->execute();
            foreach($statement->fetchAll() as $gebruiker) {
                array_push($result, GebruikerFactory::create($gebruiker));
            }

        } catch (\PDOException $exception) {
            print ('Exception occured while trying to get an event by name
            ' . $exception->getMessage());
        }

        return $result;
    }

    public function getGebruikerByGebruikerGemeente($country)
    {
        $result = [];
        $sql = "SELECT * FROM gebruikers WHERE GebruikerGemeente = :country";

        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':country', $country);
            $statement->execute();
            foreach($statement->fetchAll() as $gebruiker) {
                array_push($result, GebruikerFactory::create($gebruiker));
            }

        } catch (\PDOException $exception) {
            print ('Exception occured while trying to get an event by country
            ' . $exception->getMessage());
        }

        return $result;
    }

    public function getGebruikerByGebruikerType($type)
    {
        $result = [];
        $sql = "SELECT * FROM gebruikers WHERE GebruikerType = :type";

        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':type', $type);
            $statement->execute();
            foreach($statement->fetchAll() as $gebruiker) {
                array_push($result, GebruikerFactory::create($gebruiker));
            }

        } catch (\PDOException $exception) {
            print ('Exception occured while trying to get an event by country
            ' . $exception->getMessage());
        }

        return $result;
    }

    public function getGebruikerByGebruikerTelefoon($telephonenumber)
    {
        $result = [];
        $sql = "SELECT * FROM gebruikers WHERE GebruikerTelefoon = :telephonenumber";

        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':telephonenumber', $telephonenumber);
            $statement->execute();
            foreach($statement->fetchAll() as $gebruiker) {
                array_push($result, GebruikerFactory::create($gebruiker));
            }

        } catch (\PDOException $exception) {
            print ('Exception occured while trying to get an event by country
            ' . $exception->getMessage());
        }

        return $result;
    }
}