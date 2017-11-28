<?php

namespace Flatbel\FlatBundle\Entity\Repository;
use Composer\DependencyResolver\Request;

class CityRepository extends \Doctrine\ORM\EntityRepository
{
    public function getCity()
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->addOrderBy('c.id', 'DESC');

        return $qb->getQuery()
            ->getResult();
    }
}