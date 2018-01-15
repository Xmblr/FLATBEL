<?php

namespace Flatbel\FlatBundle\Controller;

use Flatbel\FlatBundle\Entity\City;
use Flatbel\FlatBundle\Entity\Contact;
use Flatbel\FlatBundle\Entity\Flat;
use Flatbel\FlatBundle\Form\ContactType;
use Flatbel\FlatBundle\Form\FilterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;



class PageController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $city = $em->getRepository('FlatbelFlatBundle:City')->getCity("Не важно");

        $seoPage = $this->container->get('sonata.seo.page');
        $seoPage
            ->setTitle('Flatbel - Flatbel')
            ->addMeta('name', 'description', 'Главная страница. Выберите город');

        return $this->render('FlatbelFlatBundle:Page:index.html.twig', array(
            'city'=>$city
        ));
    }

    public function cityAction(Request $request, $city)
    {

        $em = $this->getDoctrine()->getManager();

        $City = $em->getRepository('FlatbelFlatBundle:City')->getCity($city);

        $title = $em->getRepository('FlatbelFlatBundle:City')->findOneBy(array('url' => $city))->getTitle();
        $description = $em->getRepository('FlatbelFlatBundle:City')->findOneBy(array('url' => $city))->getDescription();

        $seoPage = $this->container->get('sonata.seo.page');
        $seoPage
            ->setTitle($title)
            ->addMeta('name', 'description', $description)
            ;

        $flat = new Flat();

        $filter_form = $this->createForm(FilterType::class, $flat);

        $filter_form->handleRequest($request);

        if ($city == 'Global')
        {
            $cityId = null;
        }
        else
        {
            $cityId = $em->getRepository('FlatbelFlatBundle:City')->getCity($city);
        }

        if ($filter_form->isValid()) {

            $flats = $em->getRepository('FlatbelFlatBundle:Flat')
                ->getFlats(
                    $flat->getFlattype(),
                    $flat->getNumberofbeds(),
                    $flat->getMetro(),
                    null,
                    $cityId,
                    $flat->getPricehour(),
                    $flat->getPriceday());


            // Redirect - This is important to prevent users re-posting
            // the filter_form if they refresh the page
            // return $this->redirect($this->generateUrl('FlatbelFlatBundle_homepage'));
            return $this->render('FlatbelFlatBundle:Page:city.html.twig', array(
                'flats' => $flats,
                'filter_form' => $filter_form->createView(),
                'city' => $city,
                'City'=>$City,
            ));
        }



        $flats = $em->getRepository('FlatbelFlatBundle:Flat')->getFlats('Не важно', 'Не важно', 'Не важно', null, $cityId, 0,200);

        return $this->render('FlatbelFlatBundle:Page:city.html.twig', array(
            'flats' => $flats,
            'filter_form' => $filter_form->createView(),
            'city' => $city,
            'City'=>$City,
        ));
    }

    public function contactAction(Request $request)
    {
        $seoPage = $this->container->get('sonata.seo.page');
        $seoPage
            ->setTitle('Flatbel - Свяжитесь с нами')
            ->addMeta('name', 'description', 'Свяжитесь с нами');

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

    public function translate($_str) {
        $rus=array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ');
        $lat=array('a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya',' ');
        return str_replace($lat, $rus, $_str);
    }

}
