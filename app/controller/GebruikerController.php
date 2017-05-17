<?php
/**
 * Created by PhpStorm.
 * User: Ebert Joris
 * Date: 26/04/2017
 * Time: 14:30
 */

namespace App\Controller;


use App\View\AllGebruikersJsonView;
use App\View\GebruikerJsonView;
use App\Model\PDOGebruiker;

class GebruikerController
{

    /**
     * GebruikerController constructor.
     * @param /PDO $pdo
     */

    private $gebruiker;

    //wat als het fout gaat, het retourneerd geen bad request http code


    public function __construct(\PDO $pdo)
    {
        $this->gebruiker = new PDOGebruiker($pdo);
    }

    public function handleUpdateOrCreateGebruiker($data)
    {
        if (!isset($data['id'])) {
            $createdGebruikerId = $this->gebruiker->addGebruiker($data['gebruikerNaam'], $data['gebruikerVoornaam'], $data['gebruikerPostCode'], $data['gebruikerGemeente'], $data['gebruikerStraat'], $data['gebruikerHuisnummer'], $data['gebruikerTelefoon'], $data['gebruikerGsm'], $data['gebruikerMail'], $data['gebruikerType'], $data['lat'], $data['lon']);
        } else {
            $createdGebruikerId = $this->gebruiker->updateGebruiker($data['id'], $data['gebruikerNaam'], $data['gebruikerVoornaam'], $data['gebruikerPostCode'], $data['gebruikerGemeente'], $data['gebruikerStraat'], $data['gebruikerHuisnummer'], $data['gebruikerTelefoon'], $data['gebruikerGsm'], $data['gebruikerMail'], $data['gebruikerType'], $data['lat'], $data['lon']);
        }
        $this->handleGetGebruikerByGebruikerId($createdGebruikerId);
        $view = new GebruikerJsonView();
        $view->draw(compact($data));
    }


    public function handleGetGebruikerByGebruikerId($data)
    {
        $gebruikers = $this->gebruiker->getGebruikerByGebruikerId($data);
        $view = new AllGebruikersJsonView();
        $view->draw(compact('gebruikers'));
    }

    public function handleGetAllGebruikers()
    {
        $gebruikers = $this->gebruiker->getAllGebruikers();

        $view = new AllGebruikersJsonView();
        $view->draw(compact('gebruikers'));
    }

    public function handleGetGebruikerByGebruikerName($name)
    {
        $gebruikers = $this->gebruiker->getGebruikerByGebruikerName($name);
        $view = new AllGebruikersJsonView();
        $view->draw(compact('gebruikers'));
    }

    public function handleGetGebruikerByGebruikerGemeente($country)
    {
        $gebruikers = $this->gebruiker->getGebruikerByGebruikerGemeente($country);
        $view = new AllGebruikersJsonView();
        $view->draw(compact('gebruikers'));
    }

    public function handleGetGebruikerByGebruikerType($type)
    {
        $gebruikers = $this->gebruiker->getGebruikerByGebruikerType($type);
        $view = new AllGebruikersJsonView();
        $view->draw(compact('gebruikers'));

    }

    public function handleGetGebruikerByGebruikerTelefoon($telephonenumber)
    {
        $gebruikers = $this->gebruiker->getGebruikerByGebruikerTelefoon($telephonenumber);
        $view = new AllGebruikersJsonView();
        $view->draw(compact('gebruikers'));
    }

    public function saveLocationToGebruiker($data)
    {
        $createdGebruikerId = $this->gebruiker->updateGebruikerGeoLocation($data['id'], $data['lat'], $data['lon']);
        $this->handleGetGebruikerByGebruikerId($createdGebruikerId);
        $view = new GebruikerJsonView();
        $view->draw(compact($data));
    }

    public function getGeoLocationOfUser($id)
    {
        $gebruiker = $this->gebruiker->getGebruikerByGebruikerId($id);
        $view = new AllGebruikersJsonView();
        $view->draw(compact('gebruiker'));
    }
}