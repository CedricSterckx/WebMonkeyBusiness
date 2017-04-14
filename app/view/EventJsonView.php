<?php
/**
 * Created by PhpStorm.
 * User: Ebert Joris
 * Date: 11/04/2017
 * Time: 13:20
 */

namespace App\View;

use App\View\JsonResponse;

class EventJsonView extends JsonResponse
{
    public function render(array $data)
    {
        $output = [];

        if(isset($data['event'])) {
            $event = $data['event'];
            $output = [
                'id' => $event->getProjectId(),
                'naam' => $event->getProjectNaam(),
                'beginDatum' => $event->getProjectBeginDatum(),
                'eindDatum' => $event->getProjectEindDatum(),
                'KlantNummer' => $event->getProjectKlantNummer(),
                'Bezetting' => $event->getProjectBezetting(),
                'Kost' => $event->getProjectKost(),
                'Materialen' => $event->getProjectMaterialen(),
                'GebruikerId' => $event->getGebruikerId()
            ];
        }

        return $output;
    }

}