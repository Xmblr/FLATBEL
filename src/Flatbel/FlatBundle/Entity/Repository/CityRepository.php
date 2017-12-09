<?php

namespace Flatbel\FlatBundle\Entity\Repository;

use Composer\DependencyResolver\Request;

class CityRepository extends \Doctrine\ORM\EntityRepository
{
    public function getCity($city)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->addOrderBy('c.id', 'ASC');
        if ($city != 'Не важно') {
            $qb->andWhere('c.url = :url')
                ->setParameter('url', $city);
        }

        return $qb->getQuery()
            ->getResult();
    }
}