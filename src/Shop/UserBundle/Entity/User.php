<?php

namespace Shop\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Shop\BackOfficeBundle\Entity\Caddy;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
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
     * @ORM\OneToOne(targetEntity="Shop\BackOfficeBundle\Entity\Caddy", cascade={"persist"})
     */
    protected $caddy;

    function setCaddy(Caddy $caddy = null) {
        $this->caddy = $caddy;
    }
    
    function getCaddy() {
        return $this->caddy;
    }
}