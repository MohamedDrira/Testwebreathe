<?php


namespace TestwebreatheBundle\Repository;


use Doctrine\ORM\EntityRepository;

class Operationrepository extends EntityRepository
{
    function findOperation($id)
    {
        $query=$this->getEntityManager()->createQuery("select o from TestwebreatheBundle:Operations o WHERE o.vehicule=:id")
            ->setParameter('id',$id);
        return $query->getResult();
    }
}