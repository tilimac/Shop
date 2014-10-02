<?php

namespace Shop\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Caddy")
 * @ORM\Entity(repositoryClass="Shop\FrontOfficeBundle\Repository\CaddyRepository")
 */
class Caddy{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    protected $user;
    
    /**
     * @ORM\ManyToMany(targetEntity="Product", cascade={"persist"})
     */
    protected $product;
    
    public function __construct(){
      $this->product = new ArrayCollection();
    }
    
    function setUser($user) {
        $this->user = $user;
    }
    
    function getUser() {
        return $this->user;
    }

    public function addProduct(Product $product){
      $this->product[] = $product;
      return $this;
    }
    public function removeProduct(Product $product) {
      $this->product->removeElement($product);
    }
    
    function getProduct() {
        return $this->product;
    }
}