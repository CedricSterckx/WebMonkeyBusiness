<?php

namespace App\Controller;

use App\View\EventJsonView;
use App\Model\PDOEvent;
use App\View\AllEventsJsonView;

/**
 * Created by PhpStorm.
 * User: Ebert Joris
 * Date: 11/04/2017
 * Time: 12:23
 */
class EventController
{
    private $event;

    //wat als het fout gaat, het retourneerd geen bad request http code


    public function __construct(\PDO $pdo)
    {
        $this->event = new PDOEvent($pdo);
    }

    public function handleUpdateOrCreateEvent($data)
    {
        if (!isset($data['id'])) {
            $createdEventId = $this->event->addEvent($data['naam'], $data['beginDatum'], $data['eindDatum'], $data['KlantNummer'], $data['Bezetting'], $data['Kost'], $data['Materialen'], $data['GebruikerId']);
        } else {
            $createdEventId = $this->event->UpdateEvent($data['id'], $data['naam'], $data['beginDatum'], $data['eindDatum'], $data['KlantNummer'], $data['Bezetting'], $data['Kost'], $data['Materialen'], $data['GebruikerId']);
        }
        $this->handleGetEventByEventId($createdEventId);
        $view = new EventJsonView();
        $view->draw(compact($data));
    }

    public function handleGetEventByEventId($data)
    {
        $events = $this->event->getEventByEventId($data);
        $view = new AllEventsJsonView();
        $view->draw(compact('events'));
    }

    public function handleGetAllEvents()
    {
        $events = $this->event->getAllEvents();

        $view = new AllEventsJsonView();
        $view->draw(compact('events'));
    }

    public function handleGetEventByPersonId($data)
    {
        $events = $this->event->getEventByPersonId($data);
        $view = new AllEventsJsonView();
        $view->draw(compact('events'));
    }


    public function handleGetEventByDate($from, $until)
    {
        $events = $this->event->getEventByDate($from, $until);
        $view = new AllEventsJsonView();
        $view->draw(compact('events'));
    }

    //[235,35-41-45, 564,54,154]
    public function handleEventByPersonIdAndBeginAndEndDate($id, $from, $until)
    {
        $events = $this->event->getEventByPersonIdAndBeginAndEndDate($id, $from, $until);
        $view = new AllEventsJsonView();
        $view->draw(compact('events'));
    }


}

