<?php
/**
 * Created by PhpStorm.
 * User: Ebert Joris
 * Date: 26/04/2017
 * Time: 15:20
 */

namespace App\Model;


class GebruikerFactory
{
    public static function create(array $data)
    {
        $gebruiker = new Gebruiker();

        $gebruiker->setGebruikerId($data['GebruikerID']);
        $gebruiker->setGebruikerNaam($data['GebruikerNaam']);
        $gebruiker->setGebruikerVoornaam(($data['GebruikerVoornaam']));
        $gebruiker->setGebruikerPostCode($data['GebruikerPostcode']);
        $gebruiker->setGebruikerGemeente($data['GebruikerGemeente']);
        $gebruiker->setGebruikerStraat($data['GebruikerStraat']);
        $gebruiker->setGebruikerHuisnummer($data['GebruikerHuisnummer']);
        $gebruiker->setGebruikerGsm($data['GebruikerGSM']);
        $gebruiker->setGebruikerMail($data['GebruikerMail']);
        $gebruiker->setGebruikerType($data['GebruikerType']);

        return $gebruiker;
    }
}