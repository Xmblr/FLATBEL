<?php

namespace Flatbel\FlatBundle\Admin;

use Flatbel\FlatBundle\Entity\City;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class CityAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Content', array('class' => 'col-md-9'))
                ->add('id')
                ->add('name')
                ->add('url')
                ->add('description')
                ->add('title')
                ->add('text')
                ->add('h1')
            ->end()
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->addIdentifier('url')
            ->addIdentifier('description')
            ->addIdentifier('title')
            ->addIdentifier('text')
            ->addIdentifier('h1')
        ;
    }

    public function toString($object)
    {
        return $object instanceof City
            ? $object->getName()
            : 'City'; // shown in the breadcrumb on the create view
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('url')
            ->add('description')
            ->add('title')
            ->add('text')
            ->add('h1')
        ;
    }
}