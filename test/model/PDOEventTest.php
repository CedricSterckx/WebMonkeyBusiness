<?php
/**
 * Created by PhpStorm.
 * User: 11502021
 * Date: 17/04/2017
 * Time: 11:14
 */

namespace test\model\PDOEventTest;

use App\Model\PDOEvent;
use App\Model\Event;
use PDO;

class PDOMock extends PDO {
    public function __construct() {}
}

class PDOEventTest extends \PHPUnit_Framework_TestCase
{

    private $mockPDO;
    private $mockPDOStatement;

    public function setUp()
    {
        $this->mockPDO = $this->getMockBuilder('PDOMock')
            ->getMock();
        $this->mockPDOStatement =
            $this->getMockBuilder('PDOStatement')
                ->getMock();
    }

    public function tearDown()
    {
        $this->mockPDO = null;
        $this->mockPDOStatement = null;
    }

    public function testAddEventLastIdEqualsGetEventByPersonId() {
        $event = new Event();

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue(
                [
                    [ 'id' => $event->getId() ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoEvent = new PDOEvent($this->mockPDO);
        $projectNaam = "JasperProject";
        $projectBeginDatum = new \DateTime(date_default_timezone_get());
        $projectEindDatum = new \DateTime(date_default_timezone_get());
        $klantNummer = 20;
        $projectBezetting = "groot";
        $projectKost = 10000;
        $projectMaterialen = "Laptops, Photoshop";
        $event->setProjectNaam($projectNaam);
        $event->setProjectBeginDatum($projectBeginDatum);
        $event->setProjectEindDatum($projectEindDatum);
        $event->setProjectKlantNummer($klantNummer);
        $event->setProjectBezetting($projectBezetting);
        $event->setProjectKost($projectKost);
        $event->setProjectMaterialen($projectMaterialen);


        $lastInsertId = $pdoEvent->addEvent($event->getProjectNaam(), $event->getProjectBeginDatum(), $event->getProjectEindDatum(),
            $event->getKlantNummer(), $event->getProjectBezetting(), $event->getProjectKost(), $event->getProjectMaterialen(),
            event.getGebruikerId());
        $result = $pdoEvent.getEventByPersonId($lastInsertId);
        $this->assertEquals($result[0], $lastInsertId);
    }

}
