<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Category {

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
    private $type;

    /*
    *   GETTERS
    */

        public function getId() {
            return $this->id;
        }
        public function getType() {
            return $this->type;
        }

    /*
    *   SETTERS
    */

        public function setId($id) {
            $this->id = $id;
        }
        public function setType($type) {
            $this->type = $type;
        }
}
