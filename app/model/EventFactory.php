<?php
/**
 * Created by PhpStorm.
 * User: Cédric
 * Date: 14/04/2017
 * Time: 16:29
 */

namespace App\Model;

class EventFactory
{
    public static function create(array $data)
    {
        $event = new Event();

        $event->setProjectId($data['ProjectID']);
        $event->setProjectNaam($data['ProjectNaam']);
        $event->setProjectBeginDatum(($data['ProjectBeginDatum']));
        $event->setProjectEindDatum($data['ProjectEindDatum']);
        $event->setProjectKlantNummer($data['ProjectKlantNummer']);
        $event->setProjectBezetting($data['ProjectBezetting']);
        $event->setProjectKost($data['ProjectKost']);
        $event->setProjectMaterialen($data['ProjectMaterialen']);
        $event->setGebruikerId($data['GebruikerID']);

        return $event;

    }

}
