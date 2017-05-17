<?php
/**
 * Created by PhpStorm.
 * User: 11502021
 * Date: 17/04/2017
 * Time: 11:14
 */

namespace test\model\PDOEventTest;

require "C:\\Users\\11502021\\Documents\\GitHub\\WebMonkeyBusiness\\vendor\\autoload.php";
require_once 'C:\\Users\\11502021\\Documents\\GitHub\\WebMonkeyBusiness\\app\model\\Event.php';
require_once 'C:\\Users\\11502021\\Documents\\GitHub\\WebMonkeyBusiness\\app\model\\PDOEvent.php';
require_once 'C:\\Users\\11502021\\Documents\\GitHub\\WebMonkeyBusiness\\app\model\\EventFactory.php';

use \App\Model\PDOEvent;
use \App\Model\Event;
use PDO;

class PDOMock extends PDO {
    public function __construct() {}
}

class PDOEventTest extends \PHPUnit_Framework_TestCase
{

    //private $mockPDO;
    //private $mockPDOStatement;

    /**
     *
     */
    public function setUp()
    {
        $this->mockPDO = $this->getMockBuilder('\PDO')
            ->disableOriginalConstructor()
            ->getMock();
        $this->mockPDOStatement =
            $this->getMockBuilder('\PDOStatement')
                ->disableOriginalConstructor()
                ->getMock();

        $this->event = new Event();

        $projectId = 10;
        $projectNaam = "JasperProject";
        $projectBeginDatum = new \DateTime(date_default_timezone_get());
        $projectEindDatum = new \DateTime(date_default_timezone_get());
        $klantNummer = 20;
        $projectBezetting = "groot";
        $projectKost = 10000;
        $projectMaterialen = "Laptops, Photoshop";
        $this->event->setProjectId($projectId);
        $this->event->setProjectNaam($projectNaam);
        $this->event->setProjectBeginDatum($projectBeginDatum);
        $this->event->setProjectEindDatum($projectEindDatum);
        $this->event->setProjectKlantNummer($klantNummer);
        $this->event->setProjectBezetting($projectBezetting);
        $this->event->setProjectKost($projectKost);
        $this->event->setProjectMaterialen($projectMaterialen);
    }

    public function tearDown()
    {
        $this->mockPDO = null;
        $this->mockPDOStatement = null;
    }

    public function testAddEventLast_IdEqualsGetEventByPersonId_SameID() {

        $this->mockPDOStatement->expects($this->Once())
            ->method('bindParam')
            ->with($this->equalTo(1), $this->equalTo($this->event->getProjectId()), $this->equalTo(PDO::PARAM_INT));
        $this->mockPDOStatement->expects($this->Once())
            ->method('execute');
        $this->mockPDOStatement->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo(PDO::FETCH_ASSOC))
            ->will($this->returnValue([['ProjectID' => $this->event->getProjectId()]]));
        $this->mockPDO->expects($this->Once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM projecten WHERE ProjectID=?'))
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoEvent = new PDOEvent($this->mockPDO);

        $lastInsertId = $pdoEvent->addEvent($this->event->getProjectNaam(), $this->event->getProjectBeginDatum(), $this->event->getProjectEindDatum(),
            $this->event->getKlantNummer(), $this->event->getProjectBezetting(), $this->event->getProjectKost(), $this->event->getProjectMaterialen(),
            $this->event.getGebruikerId());
        $result = $pdoEvent.getEventByPersonId($lastInsertId);
        $this->assertEquals($result[0], $lastInsertId);
    }

    public function testUpdateEvent_projectId_SameId() {

        $this->mockPDOStatement->expects($this->Once())
            ->method('bindParam')
            ->with($this->equalTo(1), $this->equalTo($this->event->getProjectId()), $this->equalTo(PDO::PARAM_INT));
        $this->mockPDOStatement->expects($this->Once())
            ->method('execute');
        $this->mockPDOStatement->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo(PDO::FETCH_ASSOC))
            ->will($this->returnValue([['ProjectID' => $this->event->getProjectId()]]));
        $this->mockPDO->expects($this->Once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM projecten WHERE ProjectID=?'))
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoEvent = new PDOEvent($this->mockPDO);

        $projectId = 20;
        $lastUpdatedId = $this->event->UpdateEvent($projectId, $this->event->getProjectNaam(), $this->event->getProjectBeginDatum(),
            $this->event->getProjectEindDatum(), $this->event->getProjectKlantNummer(),
            $this->event->getProjectBezetting(), $this->event->getProjectKost(), $this->event->getProjectMaterialen(),
            $this->event.getGebruikerId());

        $result = $pdoEvent.getEventByPersonId($lastUpdatedId);
        $this->assertEquals($result[0], $lastUpdatedId);
    }

    public function testGetEvent_ByEventId_EventFound() {
        $this->mockPDOStatement->expects($this->Once())
            ->method('bindParam')
            ->with($this->equalTo(1), $this->equalTo($this->event->getProjectId()), $this->equalTo(PDO::PARAM_INT));
        $this->mockPDOStatement->expects($this->Once())
            ->method('execute');
        $this->mockPDOStatement->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo(PDO::FETCH_ASSOC))
            ->will($this->returnValue([['ProjectID' => $this->event->getProjectId()]]));
        $this->mockPDO->expects($this->Once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM projecten WHERE ProjectID=?'))
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoEvent = new PDOEvent($this->mockPDO);
        $event = $pdoEvent->getEventByEventId($this->event->getProjectId());
        $this->assertEquals($event, $this->event);
    }

    public function testGetEvent_ByEventId_Null() {
        $wrongId = 222;
        $this->mockPDOStatement->expects($this->Once())
            ->method('bindParam')
            ->with($this->equalTo(1), $this->equalTo($wrongId), $this->equalTo(PDO::PARAM_INT));
        $this->mockPDOStatement->expects($this->Once())
            ->method('execute');
        $this->mockPDOStatement->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo(PDO::FETCH_ASSOC))
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->Once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM projecten WHERE ProjectID=?'))
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoEvent = new PDOEvent($this->mockPDO);
        $event = $pdoEvent->getEventByEventId($wrongId);
        $this->assertEquals($event, null);
    }

    public function testGetEvent_ByPersonId_EventFound() {
        $this->mockPDOStatement->expects($this->Once())
            ->method('bindParam')
            ->with($this->equalTo(1), $this->equalTo($this->event->getGebruikerId()), $this->equalTo(PDO::PARAM_INT));
        $this->mockPDOStatement->expects($this->Once())
            ->method('execute');
        $this->mockPDOStatement->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo(PDO::FETCH_ASSOC))
            ->will($this->returnValue([['GebruikerID' => $this->event->getGebruikerId()]]));
        $this->mockPDO->expects($this->Once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM projecten WHERE GebruikerID=?'))
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoEvent = new PDOEvent($this->mockPDO);
        $event = $pdoEvent->getEventByPersonId($this->event->getGebruikerId());
        $this->assertEquals($event, $this->event);
    }

    public function testGetEvent_ByPersonId_Null() {
        $wrongPersonId = 820;
        $this->mockPDOStatement->expects($this->Once())
            ->method('bindParam')
            ->with($this->equalTo(1), $this->equalTo($wrongPersonId), $this->equalTo(PDO::PARAM_INT));
        $this->mockPDOStatement->expects($this->Once())
            ->method('execute');
        $this->mockPDOStatement->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo(PDO::FETCH_ASSOC))
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->Once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM projecten WHERE GebruikerID=?'))
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoEvent = new PDOEvent($this->mockPDO);
        $event = $pdoEvent->getEventByPersonId($this->event->getGebruikerId());
        $this->assertEquals($event, null);
    }

    public function testGetEvent_ByDate_EventFound() {
        $this->mockPDOStatement->expects($this->Once())
            ->method('bindParam')
            ->with($this->equalTo(1), $this->equalTo($this->event->setProjectBeginDatum()), $this->equalTo(PDO::PARAM_INT));
        $this->mockPDOStatement->expects($this->Once())
            ->method('execute');
        $this->mockPDOStatement->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo(PDO::FETCH_ASSOC))
            ->will($this->returnValue([['ProjectBeginDatum' => $this->event->setProjectBeginDatum()]]));
        $this->mockPDO->expects($this->Once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM projecten WHERE ProjectBeginDatum = ? AND ProjectEindDatum = ?'))
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoEvent = new PDOEvent($this->mockPDO);
        $event = $pdoEvent->getEventByDate($this->event->setProjectBeginDatum(), $this->event->setProjectEindDatum());
        $this->assertEquals($event, $this->event);
    }

    public function testGetEvent_ByDate_Null() {
        $wrongDate = new \DateTime();
        $wrongDate->setDate(1997, 7, 29);
        $this->mockPDOStatement->expects($this->Once())
            ->method('bindParam')
            ->with($this->equalTo(1), $this->equalTo($wrongDate), $this->equalTo(PDO::PARAM_INT));
        $this->mockPDOStatement->expects($this->Once())
            ->method('execute');
        $this->mockPDOStatement->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo(PDO::FETCH_ASSOC))
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->Once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM projecten WHERE ProjectBeginDatum = ? AND ProjectEindDatum = ?'))
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoEvent = new PDOEvent($this->mockPDO);
        $event = $pdoEvent->getEventByDate($wrongDate, $this->event->setProjectEindDatum());
        $this->assertEquals($event, null);
    }

    public function testGetAllEvents_EventsFound() {
        $this->mockPDOStatement->expects($this->Once())
            ->method('bindParam');
        $this->mockPDOStatement->expects($this->Once())
            ->method('execute');
        $this->mockPDOStatement->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo(PDO::FETCH_ASSOC))
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->Once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM projecten'))
            ->will($this->returnValue($this->mockPDOStatement));

        $sql = "SELECT * FROM projecten";
        $result = [];

        $statement = $this->mockPDO->connection->prepare($sql);
        $statement->execute();

        foreach($statement->fetchAll() as $event) {
            array_push($result, EventFactory::create($event));
        }

        $this->assertNotNull($result[0]);
    }

    /*public function testGetEvent_ByPersonIdAndBeginAndEndDate_eventFound() {
        $this->mockPDOStatement->expects($this->Once())
            ->method('bindParam')
            ->with($this->equalTo(1), $this->equalTo($this->event->setProjectBeginDatum()), $this->equalTo(PDO::PARAM_INT));
        $this->mockPDOStatement->expects($this->Once())
            ->method('execute');
        $this->mockPDOStatement->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo(PDO::FETCH_ASSOC))
            ->will($this->returnValue([['ProjectBeginDatum' => $this->event->setProjectBeginDatum()]]));
        $this->mockPDO->expects($this->Once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM projecten WHERE ProjectBeginDatum = ? AND ProjectEindDatum = ?'))
            ->will($this->returnValue($this->mockPDOStatement));
    }*/

}
