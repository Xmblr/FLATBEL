<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Flatbel\FlatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Email;

class PageController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()
            ->getManager();

        $flats = $em->createQueryBuilder()
            ->select('f')
            ->from('FlatbelFlatBundle:Flat',  'f')
            ->addOrderBy('f.id', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->render('FlatbelFlatBundle:Page:index.html.twig', array(
            'flats' => $flats
        ));
    }



}
