<?php
/**
 * Created by PhpStorm.
 * User: 11502021
 * Date: 23/05/2017
 * Time: 20:52
 */

namespace test\model\PDOEventTest;

require "../../vendor/autoload.php";
require_once '../../app/model/EventFactory.php';
require_once '../../app/model/PDOGebruiker.php';
require_once '../../app/model/Gebruiker.php';

use \App\Model\PDOGebruiker;
use \App\Model\Gebruiker;
use PDO;

class PDOMock extends PDO {
    public function __construct() {}
}

class PDOGebruikerTest extends \PHPUnit_Framework_TestCase
{

    private $mockPDO;
    private $mockPDOStatement;
    private $gebruiker;

    public function setUp()
    {
        $this->mockPDO = $this->getMockBuilder('\PDO')
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockPDOStatement =
            $this->getMockBuilder('\PDOStatement')
                ->disableOriginalConstructor()
                ->getMock();

        $this->gebruiker = new Gebruiker();

        $gebruikerId = 10;
        $gebruikerNaam = "Heeren";
        $gebruikerVoornaam = "Jasper";
        $gebruikerPostCode = 3920;
        $gebruikerGemeente = "Lommel";
        $gebruikerStraat = "Reigerstraat";
        $gebruikerHuisnummer = 5;
        $gebruikerTelefoon = "01553120";
        $gebruikerGsm = "0479757301";
        $gebruikerMail = "jasper_heeren@hotmail.com";
        $gebruikerType = "TEST";

        $this->gebruiker->setGebruikerId($gebruikerId);
        $this->gebruiker->setGebruikerNaam($gebruikerNaam);
        $this->gebruiker->setGebruikerVoornaam($gebruikerVoornaam);
        $this->gebruiker->setGebruikerPostCode($gebruikerPostCode);
        $this->gebruiker->setGebruikerGemeente($gebruikerGemeente);
        $this->gebruiker->setGebruikerStraat($gebruikerStraat);
        $this->gebruiker->setGebruikerHuisnummer($gebruikerHuisnummer);
        $this->gebruiker->setGebruikerTelefoon($gebruikerTelefoon);
        $this->gebruiker->setGebruikerGsm($gebruikerGsm);
        $this->gebruiker->setGebruikerMail($gebruikerMail);
        $this->gebruiker->setGebruikerType($gebruikerType);
    }

    public function tearDown()
    {
        $this->mockPDO = null;
        $this->mockPDOStatement = null;
    }

    public function testGetAllGebruikers_NotNull() {
        $this->mockPDOStatement->expects($this->Once())
            ->method('bindParam')
            ->with($this->equalTo(1), $this->equalTo($this->gebruiker->getGebruikerId()), $this->equalTo(PDO::PARAM_INT));
        $this->mockPDOStatement->expects($this->Once())
            ->method('execute');
        $this->mockPDOStatement->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo(PDO::FETCH_ASSOC))
            ->will($this->returnValue([['GebruikerIdf' => $this->gebruiker->getGebruikerId()]]));
        $this->mockPDO->expects($this->Once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM gebruikers'))
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoGebruker = new PDOGebruiker($this->mockPDO);
        $gebruikers = $pdoGebruker->getAllGebruikers();
        $this->assertNotNull($gebruikers);

    }

    public function testGetGebruiker_ByGebruikersnaam() {
        $this->mockPDOStatement->expects($this->Once())
            ->method('bindParam')
            ->with($this->equalTo(1), $this->equalTo($this->gebruiker->getGebruikerNaam()), $this->equalTo(PDO::PARAM_INT));
        $this->mockPDOStatement->expects($this->Once())
            ->method('execute');
        $this->mockPDOStatement->expects($this->once())
            ->method('fetchAll')
            ->with($this->equalTo(PDO::FETCH_ASSOC))
            ->will($this->returnValue([['GebruikerId' => $this->gebruiker->getGebruikerId()]]));
        $this->mockPDO->expects($this->Once())
            ->method('prepare')
            ->with($this->equalTo('SELECT * FROM gebruikers WHERE GebruikerNaam = '))
            ->will($this->returnValue($this->mockPDOStatement));

        $pdoGebruker = new PDOGebruiker($this->mockPDO);

        $gebruikerOpvragen = $pdoGebruker->getGebruikerByGebruikerName($this->gebruiker->getGebruikerNaam());
        $this->assertEquals($this->gebruiker, $gebruikerOpvragen);

    }

}