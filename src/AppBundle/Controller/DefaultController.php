<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ProductsFiltersType;
use AppBundle\Form\NewsletterType;
use AppBundle\Form\ContactType;
use GuzzleHttp\Client;
use Nietonfir\Google\ReCaptcha\ReCaptcha;
use Nietonfir\Google\ReCaptcha\Api\RequestData;
use Nietonfir\Google\ReCaptcha\Api\ResponseFactory;
use AppBundle\Entity\Products;
use Symfony\Component\Debug\Debug;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Products')->getNewestProducts();
        // newsletter
        $newsletterForm = $this->createForm(NewsletterType::class, null);
        $newsletterForm->handleRequest($request);
        if ($newsletterForm->isSubmitted()) {
            if ($newsletterForm->isValid()) {
                $res = $request->request->get('newsletter');

                $requestData = new RequestData(
                    '6LcthyoUAAAAANi8NdNEC3cKepUWwEhm3IE0jcLY',         // secret
                    $_POST['g-recaptcha-response'], // user response
                    $_SERVER['REMOTE_ADDR']         // end user IP
                );
                $reCaptcha = new ReCaptcha(new Client(), new ResponseFactory());
                $responseReCaptcha = $reCaptcha->processRequest($requestData);
                if ($responseReCaptcha->isValid()) {
                    dump($res);
                    die("===");
                }
                
                // $em->persist($formData);
                // $em->flush();
                // $this->addFlash('success', 'Note Saved');
            }
        }

        return $this->render('@AppBundle\Resources\views\Client\Home\index.html.twig', array(
            'products' => $products,
            'newsletterForm' => $newsletterForm->createView()
        ));
    }

    public function usedMachinesAction(Request $request) {
        $em    = $this->get('doctrine.orm.entity_manager');
        $filters = $this->get('used_machines_create_filters')->getFilters();

        //$pagination
        $category = null;
        $subcategory = null;
        $search=null;
        if($request->query->has('category')) {
            $category = $request->query->getInt('category');
        }
        if($request->query->has('subcategory')) {
            $subcategory = $request->query->getInt('subcategory');
        }
        if($request->query->has('search')) {
            $search = $request->query->get('search');
        }
        // $products   = $em->getRepository('AppBundle:Products')->findBy(array(), array('id'=>'asc'));
        $products   = $em->getRepository('AppBundle:Products')->getProducts($category, $subcategory, $search);
        // dump($products); die();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            9/*limit per page*/
        );

        
        // newsletter
        $newsletterForm = $this->createForm(NewsletterType::class, null);
        $newsletterForm->handleRequest($request);
        return $this->render('@AppBundle\Resources\views\Client\UsedMachines\index.html.twig', array(
            'newsletterForm' => $newsletterForm->createView(),
            'filters' => $filters,
            'pagination' => $pagination
        ));
    }

    public function sellYourMachinesAction(Request $request)
    {
        $newsletterForm = $this->createForm(NewsletterType::class, null);
        $newsletterForm->handleRequest($request);
        return $this->render('@AppBundle\Resources\views\Client\SellYourMachines\index.html.twig', array(
            'newsletterForm' => $newsletterForm->createView()
        ));
    }

    public function sparePartsAction(Request $request)
    {
        $newsletterForm = $this->createForm(NewsletterType::class, null);
        $newsletterForm->handleRequest($request);
        return $this->render('@AppBundle\Resources\views\Client\SpareParts\index.html.twig', array(
            'newsletterForm' => $newsletterForm->createView()
        ));
    }

    public function newsletterAction(Request $request)
    {
        $newsletterForm = $this->createForm(NewsletterType::class, null);
        $newsletterForm->handleRequest($request);
        return $this->render('@AppBundle\Resources\views\Client\Newsletter\index.html.twig', array(
            'newsletterForm' => $newsletterForm->createView()
        ));
    }

    public function contactAction(Request $request)
    {
        // contact
        $contactForm = $this->createForm(ContactType::class, null);
        // newsletter
        $newsletterForm = $this->createForm(NewsletterType::class, null);
        $newsletterForm->handleRequest($request);
        return $this->render('@AppBundle\Resources\views\Client\Contact\index.html.twig', array(
            'newsletterForm' => $newsletterForm->createView(),
            'contactForm' => $contactForm->createView()
        ));
    }

    public function productAction(Products $product, Request $request)
    {
        $newsletterForm = $this->createForm(NewsletterType::class, null);
        $newsletterForm->handleRequest($request);
        return $this->render('@AppBundle\Resources\views\Client\Product\index.html.twig', array(
            'newsletterForm' => $newsletterForm->createView(),
            'product' => $product
        ));
    }
}


