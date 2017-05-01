<?php

namespace Flatbel\FlatBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('flattype', ChoiceType::class, array(
                'choices'  => array(
                    'Не важно' => 'Не важно',
                    'VIP' => 'VIP',
                    'Стандарт' => 'Стандарт',
                    'Бюджет' => 'Бюджет'
                ),
                'choices_as_values' => true
            ))
            ->add('numberofbeds',ChoiceType::class, array(
                'choices'  => array(
                    'Не важно' => 'Не важно',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '6+' => '7',

                ),
                'choices_as_values' => true
            ))
            ->add('metro',ChoiceType::class, array(
                'choices'  => array(
                    'Не важно' => 'Не важно',
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
                'choices_as_values' => true
            ))
            ->add('rooms',ChoiceType::class, array(
                'choices'  => array(
                    'Не важно' => 'Не важно',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4+' => '4',
                    ),
                'choices_as_values' => true
            ))
            ->add('pricehour', 'Symfony\Component\Form\Extension\Core\Type\MoneyType')
//            ->add('rooms')
//            ->add('street')
//            ->add('streettype')
//            ->add('priceday')
//            ->add('pricehour')
//            ->add('pricenight')
//            ->add('pricemounth')
//            ->add('metro')
//            ->add('tv')
//            ->add('wifi')
//            ->add('parking')
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
        return 'flatbel_flatbundle_filter';
    }


}
