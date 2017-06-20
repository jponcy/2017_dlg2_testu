<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Barbecue
 *
 * @ORM\Table(name="barbecue")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BarbecueRepository")
 */
class Barbecue
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startAt", type="datetime")
     */
    private $startAt;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255, unique=true)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var int
     *
     * @ORM\Column(name="peopleLimit", type="integer", nullable=true)
     */
    private $peopleLimit;

    /**
     * @var float
     *
     * @ORM\Column(name="billPrice", type="float", nullable=true)
     */
    private $billPrice;

    /**
     * @ORM\ManyToMany(targetEntity="People")
     *
     * @var Collection|People[]
     */
    private $people;

    public function __construct() {
        $this->people = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set startAt
     *
     * @param \DateTime $startAt
     * @return Barbecue
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * Get startAt
     *
     * @return \DateTime
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return Barbecue
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Barbecue
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set peopleLimit
     *
     * @param integer $peopleLimit
     * @return Barbecue
     */
    public function setPeopleLimit($peopleLimit)
    {
        $this->peopleLimit = $peopleLimit;

        return $this;
    }

    /**
     * Get peopleLimit
     *
     * @return integer
     */
    public function getPeopleLimit()
    {
        return $this->peopleLimit;
    }

    /**
     * Set billPrice
     *
     * @param float $billPrice
     * @return Barbecue
     */
    public function setBillPrice($billPrice)
    {
        $this->billPrice = $billPrice;

        return $this;
    }

    /**
     * Get billPrice
     *
     * @return float
     */
    public function getBillPrice()
    {
        return $this->billPrice;
    }

    /**
    * Gets people.
    * @return people
    */
    public function getPeople()
    {
        return $this->people;
    }

    /**
     * Adds a people to the bbq event.
     */
    public function addPeople(People $people)
    {
        if (!$this->getPeople()->contains($people)) {
            $this->people->add($people);
        }

        return $this;
    }

    public function removePeople(People $people)
    {
        if ($this->getPeople()->contains($people)) {
            $this->people->removeElement($people);
        }

        return $this;
    }
}
