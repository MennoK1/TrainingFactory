<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonRepository")
 */
class Person implements UserInterface, \Serializable
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

    /**
     * @ORM\Column(name="password", type="string")
     */
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
     * @ORM\Column(name="hiring_date", type="date", nullable=true)
     */
    private $hiring_date;

    /**
     * @ORM\Column(name="salary", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $salary;

    /**
     * @ORM\OneToMany(targetEntity="Lesson", mappedBy="person")
     */
    private $lessons;

    /**
     * @ORM\Column(name="is_member", type="boolean")
     */
    private $is_member;

    /**
     * @ORM\Column(name="street", type="string", nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(name="postal_code", type="string", nullable=true)
     */
    private $postal_code;

    /**
     * @ORM\Column(name="place", type="string", nullable=true)
     */
    private $place;

    /**
     * @ORM\OneToMany(targetEntity="Registration", mappedBy="person")
     */
    private $registrations;

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
    public function getIsMember()
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
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * @param mixed $postal
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function setPlace($place)
    {
        $this->place = $place;
    }

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->loginname,
            $this->password,
        ));
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->loginname,
            $this->password,
            ) = unserialize($serialized);
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        $roles = ["bezoeker"];
        if($this->is_member)
        {
            $roles[] = "member";
        }
        if($this->is_instructor)
        {
            $roles[] = "instructor";
        }

        return $roles;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->loginname;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }
}

