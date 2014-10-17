<?php

namespace Shop\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Shop\BackOfficeBundle\Entity\Product;

use Shop\BackOfficeBundle\Form\Type\ProductType;

/**
 * @Route("/product")
 */
class ProductController extends Controller {
    
    /**
     * @Route("/new", name="admin_product_new")
     * @Template()
     */
    public function newAction(){
        $product = new Product();
        
        $form = $this->createForm('product', $product);

        if ($this->getRequest()->isMethod('POST')) {
            $request = $this->getRequest();
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $dateCreate = new \DateTime();
                
                $product->setDateCreate($dateCreate);
                $product->setDateUpdate($dateCreate);
                $em->persist($product);
                $em->flush();
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route("/list", name="admin_product_list", options={"expose"=true})
     * @Template()
     */
    public function listAction(){
        $request = $this->getRequest();
        
        $nbByPage = $request->query->get('nb',10);
        
        if ($request->isMethod('POST')) {
            $id = $request->request->get('product_id');
            $productManager = $this->get('shop_product.manager');
            $product = $productManager->getProductById($id);

            $form = $this->createForm('product', $product);
        
            $request = $this->getRequest();
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $dateCreate = new \DateTime();
                
                $product->setDateCreate($dateCreate);
                $product->setDateUpdate($dateCreate);
                $em->persist($product);
                $em->flush();
            }
        }
        
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT p FROM ShopBackOfficeBundle:Product p";
        $query = $em->createQuery($dql);
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            $nbByPage/*limit per page*/
        );

        return array('pagination' => $pagination);
    }
    
    /**
     * @Route("/edit/{id}", name="admin_product_edit", options={"expose"=true})
     * @Template()
     */
    public function editAction($id){
        $productManager = $this->get('shop_product.manager');
        $product = $productManager->getProductById($id);

        $form = $this->createForm('product', $product);
        
        return array(
            'form' => $form->createView(),
            'product' => $product,
        );
    }
    
    /**
     * @Route("/remove/{id}", name="admin_product_remove", options={"expose"=true})
     * @Template()
     */
    public function removeAction($id){
        $productManager = $this->get('shop_product.manager');
        $product = $productManager->getProductById($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        
        return array();
    }
}
