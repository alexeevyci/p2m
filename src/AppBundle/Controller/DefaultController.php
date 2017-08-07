<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ProductsFiltersType;
use AppBundle\Form\NewsletterType;
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

    public function usedMachinesAction(Request $request)
    {


// Debug::enable();
        $filters = $this->get('used_machines_create_filters')->getFilters();
        
        // newsletter
        $newsletterForm = $this->createForm(NewsletterType::class, null);
        $newsletterForm->handleRequest($request);
        return $this->render('@AppBundle\Resources\views\Client\UsedMachines\index.html.twig', array(
            'newsletterForm' => $newsletterForm->createView(),
            'filters' => $filters
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
        $newsletterForm = $this->createForm(NewsletterType::class, null);
        $newsletterForm->handleRequest($request);
        return $this->render('@AppBundle\Resources\views\Client\Contact\index.html.twig', array(
            'newsletterForm' => $newsletterForm->createView()
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


