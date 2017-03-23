<?php

namespace Flatbel\FlatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Flat controller.
 */
class FlatController extends Controller
{
    /**
     * Show a flat entry
     */
    public function showAction($description)
    {
        $em = $this->getDoctrine()->getManager();

        $flat = $em->getRepository('FlatbelFlatBundle:Flat')->findOneBy(array('description' => $description));

        if(!$flat)
        {
            throw $this->createNotFoundException('Oops... Unable to find Flats');
        }

        return $this->render('FlatbelFlatBundle:Flat:show.html.twig', array('flat'=>$flat));
    }
}