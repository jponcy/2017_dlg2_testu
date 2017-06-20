<?php
namespace AppBundle\Tests\Entity;

use AppBundle\Entity\People;
use AppBundle\Entity\Barbecue;
use PHPUnit\Framework\TestCase;

class BarbecueTest extends TestCase {
    public function testStartAt() {
        $object = new Barbecue();

        $this->assertEquals(
                new \DateTime('2015-06-23'),
                $object->setStartAt(new \DateTime('2015-06-23'))->getStartAt());
        $this->assertEquals(
                new \DateTime('1989-06-23'),
                $object->setStartAt(new \DateTime('1989-06-23'))->getStartAt());
    }

    public function testLabel() {
        $object = new Barbecue();

        $this->assertEquals('BBQ', $object->setLabel('BBQ')->getLabel());
        $this->assertEquals('Super BBQ', $object->setLabel('Super BBQ')->getLabel());
        $this->assertEquals('Hyper BBQ', $object->setLabel('Hyper BBQ')->getLabel());
        $this->assertEquals(
                'Hyper Super Mega Ultra BBQ',
                $object->setLabel('Hyper Super Mega Ultra BBQ')->getLabel());
    }

    public function testAddress() {
        $object = new Barbecue();

        $this->assertEquals('12 rue BBQ', $object->setAddress('12 rue BBQ')->getAddress());
        $this->assertEquals('123', $object->setAddress('123')->getAddress());
    }

    public function testPeopleLimit() {
        $object = new Barbecue();

        $this->assertEquals(0, $object->setPeopleLimit(0)->getPeopleLimit());
        $this->assertEquals(10, $object->setPeopleLimit(10)->getPeopleLimit());
        $this->assertNull($object->setPeopleLimit(null)->getPeopleLimit());
        $this->assertEquals(-5, $object->setPeopleLimit(-5)->getPeopleLimit());
    }

    public function testBillPrice() {
        $object = new Barbecue();

        $this->assertEquals(0, $object->setBillPrice(0)->getBillPrice());
        $this->assertEquals(10, $object->setBillPrice(10)->getBillPrice());
        $this->assertNull($object->setBillPrice(null)->getBillPrice());
        $this->assertEquals(-5, $object->setBillPrice(-5)->getBillPrice());
    }

    public function testPeople() {
        $object = new Barbecue();

        $this->assertCountPeople(0, $object);
        $this->assertCountPeople(1, $object->addPeople(new People()));

        // Add 10 people.
        for ($i = 0; $i < 10; ++ $i) {
            $object->addPeople(new People());
        }

        $this->assertCountPeople(11, $object);

        $this->assertCountPeople(10, $object->removePeople($object->getPeople()[0]));
    }

    private function assertCountPeople(int $count, Barbecue $bbq) {
        $this->assertEquals($count, $bbq->getPeople()->count(), 'Custom');
    }

}
