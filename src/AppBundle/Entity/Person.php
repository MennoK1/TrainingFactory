<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonRepository")
 */
class Person
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="loginname", type="string")
     */
    private $loginname;

    private $password;

    /**
     * @ORM\Column(name="firstname", type="string")
     */
    private $firstname;

    /**
     * @ORM\Column(name="preprovision", type="string")
     */
    private $preprovision;

    /**
     * @ORM\Column(name="lastname", type="string")
     */
    private $lastname;

    /**
     * @ORM\Column(name="dateofbirth", type="date")
     */
    private $dateofbirth;

    /**
     * @ORM\Column(name="gender", type="string")
     */
    private $gender;

    /**
     * @ORM\Column(name="emailaddress", type="string")
     */
    private $emailaddress;

    /**
     * @ORM\Column(name="is_instructor", type="boolean")
     */
    private $is_instructor;

    /**
     * @ORM\Column(name="hiring_date", type="date")
     */
    private $hiring_date;

    /**
     * @ORM\Column(name="salary", type="decimal", precision=10, scale=2)
     */
    private $salary;

    /**
     * @ORM\Column(name="is_member", type="boolean")
     */
    private $is_member;

    /**
     * @ORM\Column(name="street", type="string")
     */
    private $street;

    /**
     * @ORM\Column(name="postal_code", type="string")
     */
    private $postal_code;

    /**
     * @ORM\Column(name="place", type="string")
     */
    private $place;

    public function getLoginname()
    {
        return $this->loginname;
    }

    /**
     * @param mixed $loginname
     */
    public function setLoginname($loginname)
    {
        $this->loginname = $loginname;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getPreprovision()
    {
        return $this->preprovision;
    }

    /**
     * @param mixed $preprovision
     */
    public function setPreprovision($preprovision)
    {
        $this->preprovision = $preprovision;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getDateofbirth()
    {
        return $this->dateofbirth;
    }

    /**
     * @param mixed $dateofbirth
     */
    public function setDateofbirth($dateofbirth)
    {
        $this->dateofbirth = $dateofbirth;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getEmailaddress()
    {
        return $this->emailaddress;
    }

    /**
     * @param mixed $emailaddress
     */
    public function setEmailaddress($emailaddress)
    {
        $this->emailaddress = $emailaddress;
    }

    /**
     * @return mixed
     */
    public function getisInstructor()
    {
        return $this->is_instructor;
    }

    /**
     * @param mixed $is_instructor
     */
    public function setIsInstructor($is_instructor)
    {
        $this->is_instructor = $is_instructor;
    }

    /**
     * @return mixed
     */
    public function getHiringDate()
    {
        return $this->hiring_date;
    }

    /**
     * @param mixed $hiring_date
     */
    public function setHiringDate($hiring_date)
    {
        $this->hiring_date = $hiring_date;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * @return mixed
     */
    public function getisMember()
    {
        return $this->is_member;
    }

    /**
     * @param mixed $is_member
     */
    public function setIsMember($is_member)
    {
        $this->is_member = $is_member;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getPostal()
    {
        return $this->postal;
    }

    /**
     * @param mixed $postal
     */
    public function setPostal($postal)
    {
        $this->postal = $postal;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function setPlace($place)
    {
        $this->place = $place;
    }
}

