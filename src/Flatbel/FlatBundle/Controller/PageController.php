<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Flatbel\FlatBundle\Controller;

use Flatbel\FlatBundle\Entity\Flat;
use Flatbel\FlatBundle\Form\FilterType;
use Flatbel\FlatBundle\Form\FlatType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Email;

class PageController extends Controller
{
    public function indexAction(Request $request)
    {
        $flat = new Flat();

        $form = $this->createForm(FilterType::class, $flat);

        $form->handleRequest($request);

        $em = $this->getDoctrine()
            ->getManager();

        if ($form->isValid()) {

            $flats = $em->getRepository('FlatbelFlatBundle:Flat')
                ->getFlats(
                    $flat->getFlattype(),
                    $flat->getNumberofbeds(),
                    $flat->getMetro(),
                    null);


            // Redirect - This is important to prevent users re-posting
            // the form if they refresh the page
            // return $this->redirect($this->generateUrl('FlatbelFlatBundle_homepage'));
            return $this->render('FlatbelFlatBundle:Page:index.html.twig', array(
                'flats' => $flats,
                'form' => $form->createView()
            ));
        }

        $flats = $em->getRepository('FlatbelFlatBundle:Flat')->getFlats('Не важно', 'Не важно', 'Не важно', null);

        return $this->render('FlatbelFlatBundle:Page:index.html.twig', array(
            'flats' => $flats,
            'form' => $form->createView()
        ));
    }


}
