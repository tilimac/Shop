<?php

namespace Shop\BackOfficeBundle\Manager;


use Doctrine\ORM\EntityManager;

/**
 * Description of ProductManager
 *
 * @author Tilimac
 */
class ProductManager {
    protected $em;
    protected $repo;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repo = $this->em->getRepository('ShopBackOfficeBundle:Product');
    }
    
    public function getProductById($id){
        return $this->repo->findOneById($id);
    }
}
