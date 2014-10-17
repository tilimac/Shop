<?php

namespace Shop\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WidgetController extends Controller {
    /**
     * @Route("/construct", name="widget_construct")
     * @Template()
     */
    public function constructAction(){
        return array();
    }
    
    /**
     * @Route("/formProduct", name="widget_formProduct")
     * @Template()
     */
    public function formProductAction(){
        return array();
    }
}
