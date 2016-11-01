<?php

namespace ResaBundle\Repository;

use Doctrine\ORM\EntityRepository;
use ResaBundle\Entity\Hotel;

class HotelRepository extends EntityRepository
{
    public function findFirstLetter($letter)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT id, ville FROM ResaBundle:Hotel WHERE ville LIKE :letter')->setParameter('letter', $letter)
            ->getResult();
    }
}