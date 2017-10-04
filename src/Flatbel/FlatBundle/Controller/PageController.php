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
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;
use APY\DataGridBundle\Grid\Column\BlankColumn;
use APY\DataGridBundle\Grid\Column\DateColumn;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Column\ActionsColumn;

use Symfony\Component\Routing\Annotation\Route;



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

    /**
     * @Route("/profile/flats", name="my_grid_route")
     */
    public function gridAction()
    {
        $source = new Entity('FlatbelFlatBundle:Flat');



        // Get a grid instance
        $grid = $this->get('grid');

        // Set the source
        $grid->setSource($source);

        // Set the selector of the number of items per page
        $grid->setLimits(array(5, 10, 15));

        // Set the default page
        $grid->setDefaultPage(1);

        // Add a delete mass action
        $grid->addMassAction(new DeleteMassAction());

        // Add row actions in the default row actions column
        $myRowAction = new RowAction('Edit', 'route_to_edit');
        $grid->addRowAction($myRowAction);

        $myRowAction = new RowAction('Delete', 'route_to_delete', true, '_self');
        $grid->addRowAction($myRowAction);

        // Custom actions column in the wanted position
        $myActionsColumn = new ActionsColumn('info_column','Info');
        $grid->addColumn($myActionsColumn, 1);

        $myRowAction = new RowAction('Show', 'route_to_show');
        $myRowAction->setColumn('info_column');
        $grid->addRowAction($myRowAction);

        return $grid->getGridResponse('FlatbelFlatBundle:Page:grid.html.twig');
//        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');
//
//        $userId = $this->get('security.token_storage')->getToken()->getUser()->getId();
//
//        $source = new Entity('FlatbelFlatBundle:Flat');
//        $grid = $this->get('grid');
//        $grid->setSource($source)
//            ->hideColumns('userid')
//            ->setDefaultFilters(array('userid'=>$userId));
//        return $grid->getGridResponse('FlatbelFlatBundle:Page:grid.html.twig');
    }
}
