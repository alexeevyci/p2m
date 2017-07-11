<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UtillController extends Controller
{
    public function generateMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AppBundle:Categories')->findAll();
        return $this->render('@AppBundle\Resources\views\Client\Common\menu.html.twig', compact('categories'));
    }
}
