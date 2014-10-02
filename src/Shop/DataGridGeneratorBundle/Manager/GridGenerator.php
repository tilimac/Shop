<?php
namespace Shop\DataGridGeneratorBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of GridGenerator
 *
 * @author Tilimac
 */
class GridGenerator {
    
    protected $manager;
    protected $entityName;
    protected $container;
    
    public function __construct(EntityManager $manager,ContainerInterface $container = null) {
        $this->manager = $manager;
        $this->container = $container;
    }
    
    public function setEntity($entityName) {
        $this->entityName = $entityName;
    }
    
    public function generateTable() {
        $repo = $this->manager->getRepository($this->entityName);
        $twig = $this->container->get('twig');
        
        $table = new Table();
        $table->definedHeader(array('Nom','Référence','Prix','Description'));
        $body = $table->initBody();
        
        
        return $twig->render('ShopDataGridGeneratorBundle::layout.html.twig',array('grid'=>'test'));
    }
}
