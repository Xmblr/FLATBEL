<?php

namespace Flatbel\FlatBundle\Admin;

use Flatbel\FlatBundle\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AdminAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'user';
    protected $baseRoutePattern = 'user';

    public function getUserId ()
    {
        $userid = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser()->getId();
        return $userid;
    }
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0].'.userid',':userid')

        );
        $query->setParameter('userid',$this->getUserId());
        return $query;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('clone', $this->getRouterIdParameter().'/clone');

    }
    public function translate($_str) {
        $rus=array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ');
        $lat=array('a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya',' ');
        return str_replace($rus, $lat, $_str);
    }

    public function prePersist($flat)
    {
        $description = $this->translate($flat->getStreet()) . '-' . $flat->getHome();
        $flat->setDescription($description);
        $flat->setUserid($this->getUserId());
        $flat->setPayornot(0);
        $flat->setCity($flat->getCity()->getUrl());
    }
    public function preUpdate($flat)
    {

        if ($this->getUserId() == $flat->getUserid())
        {
            $description = $this->translate($flat->getStreet()) . '-' . $flat->getHome();
            $flat->setDescription($description);
            $flat->setCity($flat->getCity()->getUrl());
        }
        else
        {
            throw new AccessDeniedException();
        }

    }

    public function preEdit($flat)
    {
        throw new AccessDeniedException();
    }

    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->with('Основная информация', array('class' => 'col-md-8'))

                ->add('city','entity', array(
                    'class'  => 'FlatbelFlatBundle:City',

                    'label'=>'Город', 'placeholder'=>'Выбрать...'
                ))

                ->add('flattype', 'choice', array(
                    'choices'  => array(
                        'VIP' => 'VIP',
                        'Стандарт' => 'Стандарт',
                        'Бюджет' => 'Бюджет'
                    ),
                    'choices_as_values' => true, 'label' => 'Тип квартиры', 'placeholder'=>'Выбрать...'
                ))
                ->add('numberofbeds','choice', array(
                    'choices'  => array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '6+' => '7',
                    ),
                    'choices_as_values' => true, 'label'=>'Количество спальных мест', 'placeholder'=>'Выбрать...'
                ))
                ->add('rooms','choice', array(
                    'choices'  => array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4+' => '4',
                    ),
                    'choices_as_values' => true, 'label'=>'Число комнат', 'placeholder'=>'Выбрать...'
                ))
                ->add('streettype', 'choice', array(
                    'choices' => array(
                        'Проспект' => 'Проспект',
                        'Улица'=>'Улица',
                        'Переулок'=>'Переулок'
                    ),
                    'choices_as_values' => true, 'label'=>'Тип', 'placeholder'=>'Выбрать...'
                ))
                ->add('street', null, array('label'=>'Название'))
                ->add('home',null,array('label'=>'Номер дома'))
                ->add('priceday',null,array('label'=>'Цена за день'))
                ->add('pricehour',null,array('label'=>'Цена за час'))
                ->add('pricenight',null,array('label'=>'Цена за ночь'))
                ->add('floorhome',null,array('label'=>'Число этажей в дома'))
                ->add('floor',null,array('label'=>'Этаж'))
                ->add('metro','choice', array(
                    'choices'  => array(
                        'Каменная горка'=>'Каменная горка',
                        'Кунцевщина'=>'Кунцевщина',
                        'Спортивная'=>'Спортивная',
                        'Пушкинская'=>'Пушкинская',
                        'Молодежная'=>'Молодежная',
                        'Фрунзенская'=>'Фрунзенская',
                        'Немига'=>'Немига',
                        'Купаловская'=>'Купаловская',
                        'Первомайская'=>'Первомайская',
                        'Пролетарская'=>'Пролетарская',
                        'Тракторный завод'=>'Тракторный завод',
                        'Партизанская'=>'Партизанская',
                        'Автозаводская'=>'Автозаводская',
                        'Могилевская'=>'Могилевская',
                        'Малиновка'=>'Малиновка',
                        'Петровщина'=>'Петровщина',
                        'Михалова'=>'Михалова',
                        'Грушевка'=>'Грушевка',
                        'Институт Культуры'=>'Институт Культуры',
                        'Площадь Ленина'=>'Площадь Ленина',
                        'Октбярьская'=>'Октбярьская',
                        'Площадь Победы'=>'Площадь Победы',
                        'Площадь Якуба Коласа'=> 'Площадь Якуба Коласа',
                        'Академия Наук'=>'Академия Наук',
                        'Парк Челюскинцев'=>'Парк Челюскинцев',
                        'Московская'=>'Московская',
                        'Восток'=>'Восток',
                        'Борисовский тракт'=>'Борисовский тракт',
                        'Уручье'=>'Уручье'

                    ),
                    'choices_as_values' => true, 'label'=>'Ближайшее метро', 'placeholder'=>'Выбрать...'
                ))

                ->add('telnumber',null,array('label'=>'Номер телефона'))
                ->add('about',null,array('label'=>'Описание'))
            ->end()

            ->with('Дополнительная информация',array('class'=>'col-md-4'))
                ->add('tv',null,array('label'=>'Телевизор'))
                ->add('wifi',null,array('label'=>'Wi-Fi'))
                ->add('parking',null,array('label'=>'Стоянка'))
                ->add('microwave',null,array('label'=>'Микроволновка'))
                ->add('washer',null,array('label'=>'Стиральная Машина'))
                ->add('bath',null,array('label'=>'Ванна'))
                ->add('shower',null,array('label'=>'Душ'))
                ->add('fridge',null,array('label'=>'Холодильник'))
                ->add('dishes',null,array('label'=>'Посуда'))
                ->add('linens',null,array('label'=>'Постельное бельё'))
//                ->add('payornot',null, array('label'=>'Оплачено', 'disabled'=>true, 'attr'=>array( 'checked'=>false)))
            ->end()

            ->with('Фотографии',array('class'=>'col-md-8'))

                ->add('mainphoto', 'sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context'  => 'flatphotos'
                ))
                ->add('photo1','sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context'  => 'flatphotos',
                    'required' => false,
                ))
                ->add('photo2','sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context'  => 'flatphotos',
                    'required' => false,
                ))
                ->add('photo3','sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context'  => 'flatphotos',
                    'required' => false,
                ))
            ->end()
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->add('_action', null, array(
                'actions' => array(
                    'clone' => array(
                        'template' => 'FlatbelFlatBundle:CRUD:list__action_clone.html.twig'
                    )
                )
            ))
            ->addIdentifier('id')
            ->addIdentifier('city')
            ->addIdentifier('payornot')
            ->addIdentifier('flattype')
            ->addIdentifier('numberofbeds')
            ->addIdentifier('rooms')
            ->addIdentifier('street')
            ->addIdentifier('streettype')
            ->addIdentifier('home')
            ->addIdentifier('priceday')
            ->addIdentifier('pricehour')
            ->addIdentifier('pricenight')
            ->addIdentifier('floorhome')
            ->addIdentifier('floor')
            ->addIdentifier('tv')
            ->addIdentifier('wifi')
            ->addIdentifier('parking')
            ->addIdentifier('microwave')
            ->addIdentifier('washer')
            ->addIdentifier('bath')
            ->addIdentifier('shower')
            ->addIdentifier('fridge')
            ->addIdentifier('dishes')
            ->addIdentifier('linens')
           ;
    }

    public function toString($object)
    {
        return $object instanceof User
            ? $object->getUsername()
            : 'Admin'; // shown in the breadcrumb on the create view
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('payornot')
            ->add('flattype')
            ->add('numberofbeds')
            ->add('rooms')
            ->add('street')
            ->add('streettype')
            ->add('home')
            ->add('priceday')
            ->add('pricehour')
            ->add('pricenight')
            ->add('floorhome')
            ->add('floor')
            ->add('tv')
            ->add('wifi')
            ->add('parking')
            ->add('microwave')
            ->add('washer')
            ->add('bath')
            ->add('shower')
            ->add('fridge')
            ->add('dishes')
            ->add('linens')
        ;
    }
}