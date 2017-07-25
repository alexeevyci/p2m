<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ProductsFiltersType;
use AppBundle\Form\NewsletterType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Products')->getProducts();
        $newsletterForm = $this->createForm(NewsletterType::class, null);
        $newsletterForm->handleRequest($request);
        // if ($filtersForm->isValid()) {
        //     $formData = $filtersForm->getData();
        //     // $em->persist($formData);
        //     // $em->flush();
        //     // $this->addFlash('success', 'Note Saved');
        // }
        return $this->render('@AppBundle\Resources\views\Client\Home\index.html.twig', array(
            'products' => $products,
            'newsletterForm' => $newsletterForm->createView()
        ));
    }

    public function usedMachinesAction(Request $request)
    {
        return $this->render('@AppBundle\Resources\views\Client\UsedMachines\index.html.twig');
    }

    public function sellYourMachinesAction(Request $request)
    {
        return $this->render('@AppBundle\Resources\views\Client\SellYourMachines\index.html.twig');
    }

    public function sparePartsAction(Request $request)
    {
        return $this->render('@AppBundle\Resources\views\Client\SpareParts\index.html.twig');
    }

    public function newsletterAction(Request $request)
    {
        return $this->render('@AppBundle\Resources\views\Client\Newsletter\index.html.twig');
    }

    public function contactAction(Request $request)
    {
        return $this->render('@AppBundle\Resources\views\Client\Contact\index.html.twig');
    }
}


