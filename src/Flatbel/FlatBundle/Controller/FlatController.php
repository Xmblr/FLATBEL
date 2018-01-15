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
    public function showAction($city, $description, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $flat = $em->getRepository('FlatbelFlatBundle:Flat')->findOneBy(array('description'=>$description,'id' => $id));

        if (!$flat) {
            throw $this->createNotFoundException('Уупс... Квартиры не найдены');
        }


        $text = $flat->getAbout();
        $pretext = '';
        for ($i=0; $i<strlen($text); $i++){
            // условие определения конца предложения (может быть более сложным)
            if ($text[$i]=="." || $text[$i]=="!" || $text[$i]=="?") {
                $pretext .= $text[$i]; break;
            }
            $pretext .= $text[$i];
        }

        $seoDescription = 'Квартира на сутки по адресу г.'. $flat->getCity().' '.$flat->getStreettype(). ' '. $flat->getStreet(). ' '. $flat->getHome().'. '.$pretext;
        $seoPage = $this->container->get('sonata.seo.page');
        $seoPage
            ->setTitle('Flatbel - '. $flat->getStreettype(). ' '. $flat->getStreet(). ' '. $flat->getHome())
            ->addMeta('name', 'description', $seoDescription)
            ->addMeta('property', 'og:description', $seoDescription)
        ;

        return $this->render('FlatbelFlatBundle:Flat:show.html.twig', array('flat' => $flat));
    }

    public function createAction(Request $request)
    {
        $seoPage = $this->container->get('sonata.seo.page');
        $seoPage
            ->setTitle('Flatbel - Создание квартиры')
            ->addMeta('name', 'description', 'Создание квартиры');

        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');
        $flat = new Flat();
        $create_form = $this->createForm(FlatType::class, $flat);
        $create_form->handleRequest($request);

        if ($create_form->isValid()) {

            $description = $this->translate($flat->getStreet()) . '-' . $flat->getHome();

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $flat
                ->setUserid($user->getId())
                ->setPayornot(0)
                ->setDescription($description)

                ;
            $em = $this->getDoctrine()
                ->getManager();
            $em->persist($flat);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success','Квартира успешно добавлена!')
            ;

            // Redirect - This is important to prevent users re-posting
            // the create_form if they refresh the page
            return $this->redirect($this->generateUrl('FlatbelFlatBundle_flat_create'));
        }


        return $this->render('FlatbelFlatBundle:Flat:create.html.twig', array(
            'create_form' => $create_form->createView()
        ));
    }


    public function translate($_str) {
        $rus=array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ');
        $lat=array('a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya',' ');
        return str_replace($rus, $lat, $_str);
    }
}
