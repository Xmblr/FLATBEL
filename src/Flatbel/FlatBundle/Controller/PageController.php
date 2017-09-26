<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Flatbel\FlatBundle\Controller;

use APY\DataGridBundle\Grid\Source\Entity;
use Flatbel\FlatBundle\Entity\Contact;
use Flatbel\FlatBundle\Entity\Flat;
use Flatbel\FlatBundle\Form\ContactType;
use Flatbel\FlatBundle\Form\FilterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function indexAction(Request $request)
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
                    null,
                    $flat->getPayornot(),
                    $flat->getPricehour(),
                    $flat->getPriceday());


            // Redirect - This is important to prevent users re-posting
            // the filter_form if they refresh the page
            // return $this->redirect($this->generateUrl('FlatbelFlatBundle_homepage'));
            return $this->render('FlatbelFlatBundle:Page:index.html.twig', array(
                'flats' => $flats,
                'filter_form' => $filter_form->createView()
            ));
        }

        $flats = $em->getRepository('FlatbelFlatBundle:Flat')->getFlats('Не важно', 'Не важно', 'Не важно', null,1,0,1000);

        return $this->render('FlatbelFlatBundle:Page:index.html.twig', array(
            'flats' => $flats,
            'filter_form' => $filter_form->createView()
        ));
    }

    public function contactAction(Request $request)
    {
        $contact = new Contact();

        $contact_form = $this->createForm(ContactType::class, $contact);

        if ($request->isMethod($request::METHOD_POST)) {
            $contact_form->handleRequest($request);

            if ($contact_form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject('Contact enquiry from symblog')
                    ->setFrom('enquiries@symblog.co.uk')
                    ->setTo($this->container->getParameter('flatbel_flat.emails.contact_email'))
                    ->setBody($this->renderView('FlatbelFlatBundle:Page:contactEmail.txt.twig', array('contact' => $contact)));


                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add('contact-notice', 'Ваше сообщение успешно отправлено. Спасибо!');


                // Redirect - This is important to prevent users re-posting
                // the contact_form if they refresh the page
                return $this->redirect($this->generateUrl('FlatbelFlatBundle_contact'));
            }
        }

        return $this->render('FlatbelFlatBundle:Page:contact.html.twig', array(
            'contact_form' => $contact_form->createView()
        ));
    }

    public function gridAction()
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        $userId = $this->get('security.token_storage')->getToken()->getUser()->getId();

        $source = new Entity('FlatbelFlatBundle:Flat');
//        $em = $this->getDoctrine()
//            ->getManager();
//        $source = $em->getRepository('FlatbelFlatBundle:Flat')
//            ->getFlats('Не важно','Не важно','Не важно',null,1,1,100);
//        $em = $this->getDoctrine()->getManager();
//        $source = $em->getRepository('FlatbelFlatBundle:Flat')->findOneBy(array('userid'=>$userId));
        $grid = $this->get('grid');
        $grid->setSource($source);
        return $grid->getGridResponse('FlatbelFlatBundle:Page:grid.html.twig');
    }
}
