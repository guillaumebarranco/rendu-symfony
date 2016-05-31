<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class User implements UserInterface, \Serializable {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin;

    /*
    *   GETTERS
    */

        public function getId() {
            return $this->id;
        }
        public function getUsername() {
            return $this->username;
        }
        public function getPassword() {
            return $this->password;
        }
        public function getIsAdmin() {
            return $this->isAdmin;
        }
        public function getRoles() {
            return array('ROLE_ADMIN');
        }
        public function getSalt() {
            // you *may* need a real salt depending on your encoder
            // see section on salt below
            return null;
        }

        public function eraseCredentials()
        {
        }

    /*
    *   SETTERS
    */

        public function setId($id) {
            $this->id = $id;
        }
        public function setUsername($username) {
            $this->username = $username;
        }
        public function setPassword($password) {
            $this->password = $password;
        }
        public function setIsAdmin($isAdmin) {
            $this->isAdmin = $isAdmin;
        }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
}
