<?php

namespace Flatbel\FlatBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class FlatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('userid')
            //->add('payornot')
            ->add('flattype', ChoiceType::class, array(
                'choices'  => array(
                    'VIP' => 'VIP',
                    'Евро' => 'Евро',
                    'Стандарт' => 'Стандарт',
                    'Бюджет' => 'Бюджет'
                ),
                'choices_as_values' => true, 'label' => 'Тип квартиры', 'placeholder'=>'Выбрать...'
            ))
            ->add('numberofbeds',ChoiceType::class, array(
                'choices'  => array(
                    '2' => '2',
                    '2+1' => '3',
                    '2+2' => '4',
                    '2+1+1' => '4',
                    '2+2+1' => '5',
                    '2+2+2' => '6',
                    '6+' => '7',
                ),
                'choices_as_values' => true, 'label'=>'Количество спальных мест', 'placeholder'=>'Выбрать...'
            ))
            ->add('rooms',ChoiceType::class, array(
                'choices'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4+' => '4',
                ),
                'choices_as_values' => true, 'label'=>'Число комнат', 'placeholder'=>'Выбрать...'
            ))
            ->add('streettype', ChoiceType::class, array(
                'choices' => array(
                    'Проспект' => 'Проспект',
                    'Улица'=>'Улица',
                    'Переулок'=>'Переулок'
                ),
                'choices_as_values' => true, 'label'=>'Тип', 'placeholder'=>'Выбрать...'
            ))
            ->add('street', TextType::class, array('label'=>'Название'))
            ->add('home',TextType::class,array('label'=>'Номер дома'))
            ->add('priceday',TextType::class,array('label'=>'Цена за сутки'))
            ->add('pricehour',TextType::class,array('label'=>'Цена за час'))
            ->add('floorhome',TextType::class,array('label'=>'Число этажей в дома'))
            ->add('floor',TextType::class,array('label'=>'Этаж'))
            ->add('metro',ChoiceType::class, array(
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
            ->add('city',EntityType::class, array(
                'class'  => 'FlatbelFlatBundle:City',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
            ))
            ->add('city', EntityType::class, array('class' => 'FlatbelFlatBundle:City', 'label'=>'Город',
                'choice_label' => 'getName',
                'multiple' => false,
                'expanded' => false,
                'required' => false,
            ))
            ->add('tv',null,array('label'=>'Телевизор'))
            ->add('lcdtv',null,array('label'=>'ЖК-Телевизор'))
            ->add('wifi',null,array('label'=>'Wi-Fi'))
            ->add('parking',null,array('label'=>'Стоянка'))
            ->add('microwave',null,array('label'=>'Микроволновка'))
            ->add('washer',null,array('label'=>'Стиральная Машина'))
            ->add('bath',null,array('label'=>'Ванна'))
            ->add('shower',null,array('label'=>'Душ'))
            ->add('jacuzzi',null,array('label'=>'Джакузи'))
            ->add('fridge',null,array('label'=>'Холодильник'))
            ->add('dishes',null,array('label'=>'Посуда'))
            ->add('linens',null,array('label'=>'Постельное бельё'))
            ->add('telnumber',null,array('label'=>'Номер телефона'))
            ->add('viber',null,array('label'=>'Viber'))
            ->add('whatsapp',null,array('label'=>'Whatsapp'))
            ->add('telegram',null,array('label'=>'Telegram'))
            ->add('about',null,array('label'=>'Описание'))
            ->add('mainphoto', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'flatphotos',
                'label'=>'Главное фото'
            ))
            ->add('photo1','sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'flatphotos',
                'label'=>'Фото №1'
            ))
            ->add('photo2','sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'flatphotos',
                'label'=>'Фото №2'
            ))
            ->add('photo3','sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'flatphotos',
                'label'=>'Фото №3'
            ))
            ->add('photo4','sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'flatphotos',
                'label'=>'Фото №4'
            ))
            ->add('photo5','sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'flatphotos',
                'label'=>'Фото №5'
            ))

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Flatbel\FlatBundle\Entity\Flat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'flatbel_flatbundle_flat';
    }


}
