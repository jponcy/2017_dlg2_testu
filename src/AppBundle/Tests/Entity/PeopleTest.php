<?php
namespace AppBundle\Tests\Entity;

use AppBundle\Entity\People;
use AppBundle\Enum\Diet;
use PHPUnit\Framework\TestCase;

class PeopleTest extends TestCase {
    public function testFirstname() {
        $object = new People();

        $this->assertEquals('jean', $object->setFirstname('jean')->getFirstname());
        $this->assertEquals('ydezdez', $object->setFirstname('Ydezdez')->getFirstname());
        $this->assertEquals('o', $object->setFirstname('O')->getFirstname());
    }

    public function testLastname() {
        $object = new People();

        $this->assertEquals('JEAN', $object->setLastname('jean')->getLastname());
        $this->assertEquals('YDEZDEZ', $object->setLastname('Ydezdez')->getLastname());
        $this->assertEquals('O', $object->setLastname('O')->getLastname());
    }

    public function testDiet() {
        $object = new People();

        $this->assertEquals(Diet::CARNIVOR, $object->setDiet(Diet::CARNIVOR)->getDiet());
        $this->assertEquals(Diet::OTHERS, $object->setDiet(Diet::OTHERS)->getDiet());
    }
    public function testDietStringException() {
        $object = new People();

        $this->expectException(\InvalidArgumentException::class);
        $object->setDiet('toto');
    }
    public function testDietIntException() {
        $object = new People();

        $this->expectException(\InvalidArgumentException::class);
        $object->setDiet(4);
    }
    public function testDiet0Exception() {
        $object = new People();

        $this->expectException(\InvalidArgumentException::class);
        $object->setDiet(0);
    }

    public function testBirthdate() {
        $object = new People();

        $this->assertEquals(
                new \DateTime('2015-06-23'),
                $object->setBirthdate(new \DateTime('2015-06-23'))->getBirthdate());
        $this->assertEquals(
                new \DateTime('1989-06-23'),
                $object->setBirthdate(new \DateTime('1989-06-23'))->getBirthdate());
    }
}
