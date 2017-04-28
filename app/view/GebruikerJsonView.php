<?php
/**
 * Created by PhpStorm.
 * User: Ebert Joris
 * Date: 26/04/2017
 * Time: 15:01
 */

namespace App\View;


use App\View\JsonResponse;

class GebruikerJsonView extends JsonResponse
{
    public function render(array $data)
    {
        $output = [];
        if(isset($data['gebruiker'])) {
            $gebruiker = $data['gebruiker'];
            $output = [
                'id' => $gebruiker->getGebruikerId(),
                'gebruikerNaam' => $gebruiker->getGebruikerNaam(),
                'gebruikerVoornaam' => $gebruiker->getGebruikerVoornaam(),
                'gebruikerPostCode' => $gebruiker->getGebruikerPostCode(),
                'gebruikerGemeente' => $gebruiker->getGebruikerGemeente(),
                'gebruikerStraat' => $gebruiker->getGebruikerStraat(),
                'gebruikerHuisnummer' => $gebruiker->getGebruikerHuisnummer(),
                'gebruikerTelefoon' => $gebruiker->getGebruikerTelefoon(),
                'gebruikerGsm' => $gebruiker->getGebruikerGSM(),
                'gebruikerMail' => $gebruiker->getGebruikerMail(),
                'gebruikerType' => $gebruiker->getGebruikerType()
            ];
        }

        return $output;
    }

}