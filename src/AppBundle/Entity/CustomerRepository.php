<?php

namespace AppBundle\Entity;

/**
 * CustomerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CustomerRepository extends \Doctrine\ORM\EntityRepository
{
    public function queryCount() {
        $dql = 'SELECT COUNT(c.id) '
            . 'FROM AppBundle:Customer c ';

        $query = $this->getEntityManager()->createQuery($dql);


        return $query;
    }


    public function count() {

        return $this->queryCount()->getSingleScalarResult();
    }
}
