<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Flatbel\FlatBundle\Controller;

use Flatbel\FlatBundle\Entity\Register;
use Flatbel\FlatBundle\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('FlatbelFlatBundle:Page:index.html.twig');
    }

    public function registerAction(Request $request)
    {
        $enquiry = new Register();

        $form = $this->createForm(RegisterType::class, $enquiry);

        if ($request->isMethod($request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // Perform some action, such as sending an email

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('FlatbelFlatBundle_register'));
            }
        }

        return $this->render('FlatbelFlatBundle:Page:register.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
