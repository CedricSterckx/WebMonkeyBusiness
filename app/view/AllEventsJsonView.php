<?php
/**
 * Created by PhpStorm.
 * User: Ebert Joris
 * Date: 11/04/2017
 * Time: 13:20
 */

namespace App\View;

use App\Model\Event;
use App\View\JsonResponse;

class AllEventsJsonView extends JsonResponse
{
    public function render(array $data)
    {
        $output = [];

        if (isset($data['events'])) {
            foreach($data['events'] as $event) {
                array_push($output, [
                    'id' => $event->getProjectId(),
                    'naam' => $event->getProjectNaam(),
                    'beginDatum' => $event->getProjectBeginDatum(),
                    'eindDatum' => $event->getProjectEindDatum(),
                    'KlantNummer' => $event->getProjectKlantNummer(),
                    'Bezetting' => $event->getProjectBezetting(),
                    'Kost' => $event->getProjectKost(),
                    'Materialen' => $event->getProjectMaterialen(),
                    'GebruikerId' => $event->getGebruikerId()
                ]);
            }
        }

        return $output;
    }

}
