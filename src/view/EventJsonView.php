<?php

namespace App\View;

/**
 * Created by PhpStorm.
 * User: Ebert Joris
 * Date: 11/04/2017
 * Time: 13:20
 */
class EventJsonView
{
    public function render(array $data)
    {
        $output = [];

        if(isset($data['event'])) {
            $event = $data['event'];
            $output = [
                'id' => $event->getId(),
                'naam' => $event->getNaam(),
                'beginDatum' => $event->getBeginDatum(),
                'eindDatum' => $event->getEindDatum(),
                'KlantNummer' => $event->getKlantNummer(),
                'Bezetting' => $event->getBezetting(),
                'Kost' => $event->getKost(),
                'Materialen' => $event->getMaterialen()
            ];
        }
        return $output;
    }

}