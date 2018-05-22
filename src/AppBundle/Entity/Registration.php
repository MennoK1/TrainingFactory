<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="registration")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RegistrationRepository")
 */
class Registration
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="payment", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $payment;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="registrations")
     */
    private $person;
}