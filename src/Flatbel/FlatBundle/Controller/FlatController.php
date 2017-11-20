<?php

namespace Flatbel\FlatBundle\Controller;

use Flatbel\FlatBundle\Entity\Flat;
use Flatbel\FlatBundle\Entity\User;
use Flatbel\FlatBundle\Form\FlatType;
use Flatbel\FlatBundle\Form\FilterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Flatbel\FlatBundle\Service\FileUploader;



/**
 * Flat controller.
 */
class FlatController extends Controller
{
    /**
     * Show a flat entry
     */
    public function showAction($description,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $flat = $em->getRepository('FlatbelFlatBundle:Flat')->findOneBy(array('description'=>$description,'id' => $id));

        if (!$flat) {
            throw $this->createNotFoundException('Уупс... Квартиры не найдены');
        }

        return $this->render('FlatbelFlatBundle:Flat:show.html.twig', array('flat' => $flat));
    }

    public function createAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');
        $flat = new Flat();
        $create_form = $this->createForm(FlatType::class, $flat);
        $create_form->handleRequest($request);

        if ($create_form->isValid()) {

//            if($flat->getMainphoto())
//            {
//                $mainphotofile = $flat->getMainphoto();
//                $mainphotofileName = md5(uniqid()).'.'.$mainphotofile->guessExtension();
//
//                $mainphotofile->move(
//                    $this->getParameter('photo_directory'),
//                    $mainphotofileName
//                );
//            }
//            if($flat->getPhoto1())
//            {
//                $photo1file = $flat->getPhoto1();
//                $photo1fileName = md5(uniqid()).'.'.$photo1file->guessExtension();
//
//                $photo1file->move(
//                    $this->getParameter('photo_directory'),
//                    $photo1fileName
//                );
//            }
//            if($flat->getPhoto2())
//            {
//                $photo2file = $flat->getPhoto2();
//                $photo2fileName = md5(uniqid()).'.'.$photo2file->guessExtension();
//
//                $photo2file->move(
//                    $this->getParameter('photo_directory'),
//                    $photo2fileName
//                );
//            }
//            if($flat->getPhoto3())
//            {
//                $photo3file = $flat->getPhoto3();
//                $photo3fileName = md5(uniqid()).'.'.$photo3file->guessExtension();
//
//                $photo3file->move(
//                    $this->getParameter('photo_directory'),
//                    $photo3fileName
//                );
//            }

            $description = $this->translate($flat->getStreet()) . '-' . $flat->getHome();
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $flat
                ->setUserid($user->getId())
                ->setPayornot(0)
                ->setDescription($description)
//                ->setMainphoto($mainphotofileName)
//                ->setPhoto1($photo1fileName)
//                ->setPhoto2($photo2fileName)
//                ->setPhoto3($photo3fileName)
                ;
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

        $flats = $em->getRepository('FlatbelFlatBundle:Flat')->getFlats('Не важно', 'Не важно', 'Не важно', null, 0,0,1000);

        return $this->render('FlatbelFlatBundle:Page:index.html.twig', array(
            'flats' => $flats,
            'filter_form' => $filter_form->createView()
        ));
    }

    function translate($_str) {
        $rus=array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ');
        $lat=array('a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya',' ');
        return str_replace($rus, $lat, $_str);
    }
}
