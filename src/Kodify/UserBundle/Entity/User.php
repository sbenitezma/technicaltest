<?php
// src /Kodify/UserBundle/Entity/User.php

namespace Kodify\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;

use Kodify\BlogBundle\Entity\Author;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="Kodify\BlogBundle\Entity\Author")
     * @ORM\JoinColumn(name="authorUser", referencedColumnName="id", onDelete="CASCADE")
     *
     */
    protected $authorUser;

    public function __construct()
    {
        parent::__construct();
        // your own logic
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

    public function __toString() {
        parent::__toString();
    }


    /**
     * Set authorUser
     *
     * @param string $authorUser
     * @return User
     */
    public function setAuthorUser($authorUser)
    {
        $this->authorUser = $authorUser;

        return $this;
    }

    /**
     * Get authorUser
     *
     * @return string
     */
    public function getAuthorUser()
    {
        return $this->authorUser;
    }
}
