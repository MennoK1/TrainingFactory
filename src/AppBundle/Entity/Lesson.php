<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lesson
 *
 * @ORM\Table(name="lesson")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LessonRepository")
 */
class Lesson
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="time", type="time")
     */
    private $time;

    /**
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(name="max_persons", type="integer")
     */
    private $maxPersons;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="lesson")
     */
    private $instructor;

    /**
     * @ORM\ManyToOne(targetEntity="Training", inversedBy="lessons")
     */
    private $training;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Lesson
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Lesson
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Lesson
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set maxPersons
     *
     * @param integer $maxPersons
     *
     * @return Lesson
     */
    public function setMaxPersons($maxPersons)
    {
        $this->maxPersons = $maxPersons;

        return $this;
    }

    /**
     * Get maxPersons
     *
     * @return int
     */
    public function getMaxPersons()
    {
        return $this->maxPersons;
    }

    /**
     * Set instructor
     *
     * @param \stdClass $instructor
     *
     * @return Lesson
     */
    public function setInstructor($instructor)
    {
        $this->instructor = $instructor;

        return $this;
    }

    /**
     * Get instructor
     *
     * @return \stdClass
     */
    public function getInstructor()
    {
        return $this->instructor;
    }
}

