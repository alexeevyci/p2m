<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Newsletter;
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

        // footer
        $footerForm = $this->createForm(NewsletterType::class, null);
        $footerForm->handleRequest($request);
        if ($footerForm->isSubmitted()) {
            if ($footerForm->isValid()) {
                $res = $request->request->get('newsletter');

                $requestData = new RequestData(
                    '6LcthyoUAAAAANi8NdNEC3cKepUWwEhm3IE0jcLY',         // secret
                    $_POST['g-recaptcha-response'], // user response
                    $_SERVER['REMOTE_ADDR']         // end user IP
                );
                $reCaptcha = new ReCaptcha(new Client(), new ResponseFactory());
                $responseReCaptcha = $reCaptcha->processRequest($requestData);
                if ($responseReCaptcha->isValid()) {
                }
                
                // $em->persist($formData);
                // $em->flush();
                // $this->addFlash('success', 'Note Saved');
            }
        }

        return $this->render('@AppBundle\Resources\views\Client\Home\index.html.twig', array(
            'products' => $products,
            'footerForm' => $footerForm->createView()
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

        
        // footer
        $footerForm = $this->createForm(NewsletterType::class, null);
        $footerForm->handleRequest($request);
        return $this->render('@AppBundle\Resources\views\Client\UsedMachines\index.html.twig', array(
            'footerForm' => $footerForm->createView(),
            'filters' => $filters,
            'pagination' => $pagination
        ));
    }

    public function sellYourMachinesAction(Request $request)
    {
        $footerForm = $this->createForm(NewsletterType::class, null);
        $footerForm->handleRequest($request);
        return $this->render('@AppBundle\Resources\views\Client\SellYourMachines\index.html.twig', array(
            'footerForm' => $footerForm->createView()
        ));
    }

    public function sparePartsAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');

        //$pagination
        $parts   = $em->getRepository('AppBundle:Parts')->findBy(array(), array('id'=>'asc'));
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $parts, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );
        
        // footer
        $footerForm = $this->createForm(NewsletterType::class, null);
        $footerForm->handleRequest($request);
        return $this->render('@AppBundle\Resources\views\Client\SpareParts\index.html.twig', array(
            'footerForm' => $footerForm->createView(),
            'pagination' => $pagination
        ));
    }

    public function newsletterAction(Request $request) {
        $em    = $this->get('doctrine.orm.entity_manager');
        //newsletter form
        $newsletterForm = $this->createForm(NewsletterType::class, null);
        $newsletterForm->handleRequest($request);
        if ($newsletterForm->isSubmitted()) {
            if ($newsletterForm->isValid()) {
                $postData = $request->request->get('newsletter');
                $newsletter = new Newsletter();
                $newsletter->setName($postData['name']);
                $newsletter->setEmail($postData['email']);
                $em->persist($newsletter);
                $em->flush();
            }
        }
        //footer form
        $footerForm = $this->createForm(NewsletterType::class, null);
        $footerForm->handleRequest($request);
        return $this->render('@AppBundle\Resources\views\Client\Newsletter\index.html.twig', array(
            'footerForm' => $footerForm->createView(),
            'newsletterForm' => $newsletterForm->createView()
        ));
    }

    public function contactAction(Request $request)
    {
        // contact
        $contactForm = $this->createForm(ContactType::class, null);
        $contactForm->handleRequest($request);
        if ($contactForm->isSubmitted()) {
            if ($contactForm->isValid()) {
                $res = $request->request->get('contact');
                // $message = (new \Swift_Message('Hello Email'))
                //     ->setFrom('send@example.com')
                //     ->setTo('recipient@example.com')
                //     ->setBody(
                //         $this->renderView(
                //             // app/Resources/views/Emails/registration.html.twig
                //             '@AppBundle\Resources\views\Client\Email\contact.html.twig',
                //             array('name' => "my_name")
                //         ),
                //         'text/html'
                //     );

                // dump($mailer->send($message));
                // die("---");

                $message = \Swift_Message::newInstance()
                    ->setSubject('Some Subject')
                    ->setFrom(['alexeevyci@gmail.com' => 'John Doe'])
                    ->setTo(['alexandruasaftei2@gmail.com' => 'alex2'])
                    ->setBody('Here is the message itself');
                $result = $this->get('mailer')->send($message);
                var_dump($result); die("[]");


            }
        }
        // footer
        $footerForm = $this->createForm(NewsletterType::class, null);
        $footerForm->handleRequest($request);
        return $this->render('@AppBundle\Resources\views\Client\Contact\index.html.twig', array(
            'footerForm' => $footerForm->createView(),
            'contactForm' => $contactForm->createView()
        ));
    }

    public function productAction(Products $product, Request $request)
    {
        $footerForm = $this->createForm(NewsletterType::class, null);
        $footerForm->handleRequest($request);
        return $this->render('@AppBundle\Resources\views\Client\Product\index.html.twig', array(
            'footerForm' => $footerForm->createView(),
            'product' => $product
        ));
    }
}


