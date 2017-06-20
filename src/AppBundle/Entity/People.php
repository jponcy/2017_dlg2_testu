<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Enum\Diet;
use SymfonyComponentValidatorConstraints as Assert;

/**
 * People
 *
 * @ORM\Table(name="people")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PeopleRepository")
 */
class People
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
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var int
     *
     * @ORM\Column(name="diet", type="integer", nullable=true)
     */
    //  * @Assert\Choice(callback={"\AppBundle\Enum\Diet", "getPossibilities"})
    private $diet = Diet::CARNIVOR;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime", nullable=true)
     */
    private $birthdate;

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
     * Set lastname
     *
     * @param string $lastname
     * @return People
     */
    public function setLastname($lastname)
    {
        $this->lastname = strtoupper($lastname);

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return People
     */
    public function setFirstname($firstname)
    {
        $this->firstname = strtolower($firstname);

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set diet
     *
     * @param integer $diet
     * @return People
     */
    public function setDiet($diet)
    {
        // Should only used the assert callback.
        if (in_array($diet, Diet::getPossibilities())) {
            $this->diet = $diet;
        } else {
            throw new \InvalidArgumentException();
        }

        return $this;
    }

    /**
     * Get diet
     *
     * @return integer
     */
    public function getDiet()
    {
        return $this->diet;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return People
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }
}
