<?php

namespace Flatbel\FlatBundle\Controller;

use Flatbel\FlatBundle\Entity\Flat;
use Flatbel\FlatBundle\Form\FlatType;
use Flatbel\FlatBundle\Form\FilterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


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
            throw $this->createNotFoundException('Уупс... Квартиры не найдены');
        }

        return $this->render('FlatbelFlatBundle:Flat:show.html.twig', array('flat'=>$flat));
    }

    public function createAction(Request $request)
    {
       $flat = new Flat();

       $create_form = $this->createForm(FlatType::class, $flat);

            $create_form->handleRequest($request);

            if ($create_form->isValid()) {

                $em = $this->getDoctrine()
                    ->getManager();
                $em->persist($flat);
                $em->flush();

                // Redirect - This is important to prevent users re-posting
                // the create_form if they refresh the page
                return $this->redirect($this->generateUrl('FlatbelFlatBundle_flat_create'));
            }


        return $this->render('FlatbelFlatBundle:Flat:create.html.twig', array(
            'create_form' => $create_form->createView()
        ));
    }

    public function flatsAction(Request $request)
    {
        $flat = new Flat();

        $filter_form = $this->createForm(FilterType::class, $flat);

        $filter_form->handleRequest($request);

        $em = $this->getDoctrine()
            ->getManager();

        if ($filter_form->isValid()) {

            $flats = $em->getRepository('FlatbelFlatBundle:Flat')
                ->getFlats(
                    $flat->getFlattype(),
                    $flat->getNumberofbeds(),
                    $flat->getMetro(),
                    null);


            // Redirect - This is important to prevent users re-posting
            // the filter_form if they refresh the page
            // return $this->redirect($this->generateUrl('FlatbelFlatBundle_homepage'));
            return $this->render('FlatbelFlatBundle:Page:index.html.twig', array(
                'flats' => $flats,
                'filter_form' => $filter_form->createView()
            ));
        }

        $flats = $em->getRepository('FlatbelFlatBundle:Flat')->getFlats('Не важно', 'Не важно', 'Не важно', null);

        return $this->render('FlatbelFlatBundle:Page:index.html.twig', array(
            'flats' => $flats,
            'filter_form' => $filter_form->createView()
        ));
    }
}