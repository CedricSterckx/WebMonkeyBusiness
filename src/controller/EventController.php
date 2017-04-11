<?php
/**
 * Created by PhpStorm.
 * User: Ebert Joris
 * Date: 11/04/2017
 * Time: 12:23
 */
class EventController
{
    private $Event;

    public function __construct($Event)
    {
        $this->Event = new PDOEvent($Event);
    }

    public function handleUpdateOrCreateEvent($Event) {
        if(!isset($data['event']['id'])) {
            $this->Event->addEvent($data['naam'], $data['beginDatum'], $data['eindDatum'], $data['KlantNummer'], $data['Bezetting'], $data['Kost'], $data['Materialen']);
        } else {
            $this->Event->UpdateEvent($data['id'], $data['naam'], $data['beginDatum'], $data['eindDatum'], $data['KlantNummer'], $data['Bezetting'], $data['Kost'], $data['Materialen']);
        }
        http_response_code(201);
        header('Content-Type: application/json');
        echo json_encode($this->Event);
    }
}

