<?php
namespace controller;

/**
 * Created by PhpStorm.
 * User: Ebert Joris
 * Date: 11/04/2017
 * Time: 12:23
 */
use \View\EventJsonView;
use \model\PDOEvent;

class EventController
{
    private $Event;
    private $JsonView;

    //wat als het fout gaat, het retourneerd geen bad request http code


    public function __construct($PDOEvent, $EventJsonView)
    {
        $this->Event = new PDOEvent($PDOEvent);
        $this->JsonView = new EventJsonView($EventJsonView);
    }

    public function handleUpdateOrCreateEvent($data) {
        if(!isset($data['id'])) {
            $this->Event->addEvent($data['naam'], $data['beginDatum'], $data['eindDatum'], $data['KlantNummer'], $data['Bezetting'], $data['Kost'], $data['Materialen']);
        } else {
            $this->Event->UpdateEvent($data['id'], $data['naam'], $data['beginDatum'], $data['eindDatum'], $data['KlantNummer'], $data['Bezetting'], $data['Kost'], $data['Materialen']);
        }
        http_response_code(201);
        header('Content-Type: application/json');
        echo json_encode($this->Event);
    }

    public function handleGetEventByEventId($data){
        $this->Event->getEventByEventId($data);
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($this->Event);
    }

    public function handleGetAllEvents(){
        $this->Event->getAllEvents();
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($this->Event);
    }

    public function handleGetEventByPersonId($data){
        $this->Event->getEventByPersonId($data);
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($this->Event);
    }


    public function handleGetEventByDate($data){
        $this->Event->getEventByDate($data['beginDate'], $data['endDate']);
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($this->Event);
    }

    //[235,35-41-45, 564,54,154]
    public function handleEventByPersonIdAndBeginAndEndDate($data){
        $this->Event->getEventByPersonIdAndBeginAndEndDate($data['id'], $data['beginDate'], $data['endDate']);
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($this->Event);
    }


}

