<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home", options={"expose"=true})
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        //return $this->redirectToRoute('nelmio_api_doc_index', array(), 301);

        return $this->render(':default:index.html.twig');
    }

    /**
     * @Route("/main", name="main", options={"expose"=true})
     */
    public function tablesAction(){

        $em = $this->getDoctrine()->getManager();

        $customers = $em->getRepository('AppBundle:Customer')->count();

        $appointments = $em->getRepository('AppBundle:Appointment')->count();

        return $this->render(':default:_main.html.twig', array(
            'customers' => $customers,
            'appointment' => $appointments
        ));

    }

    /**
     * @Route("/dashboard", name="dashboard", options={"expose"=true})
     */
    public function dashboardAction(){

        return $this->render(':default:dashboard.html.twig');

    }
}
