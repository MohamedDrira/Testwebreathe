<?php


namespace TestwebreatheBundle\Repository;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    function findUser($utilisateur,$motdepasse)
    {
        $query=$this->getEntityManager()->createQuery("select u from TestwebreatheBundle:User u WHERE u.utilisateur=:utilisateur AND u.motdepasse=:motdepasse")
            ->setParameter('utilisateur',$utilisateur)
            ->setParameter('motdepasse',$motdepasse);
        return $query->getResult();
    }
}