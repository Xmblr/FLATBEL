<?php

namespace Flatbel\FlatBundle\Controller;

use Flatbel\FlatBundle\Entity\Flat;
use Flatbel\FlatBundle\Form\FlatType;
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
}