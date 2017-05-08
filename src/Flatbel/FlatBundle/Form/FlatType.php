<?php

namespace Flatbel\FlatBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('flattype')
            ->add('numberofbeds')
            ->add('rooms')
            ->add('street')
            ->add('streettype')
            ->add('home')
            ->add('priceday')
            ->add('pricehour')
            ->add('pricenight')
            ->add('pricemounth')
            ->add('floorhome')
            ->add('floor')
            ->add('metro')
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
            ->add('telnumber')
            ->add('about')
            //->add('description')
            ->add('mainphoto')
            ->add('photo1')
            ->add('photo2')
            ->add('photo3')
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
