<?php

namespace App\Repository;

use App\Entity\CorrespondantAdministratif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CorrespondantAdministratif|null find($id, $lockMode = null, $lockVersion = null)
 * @method CorrespondantAdministratif|null findOneBy(array $criteria, array $orderBy = null)
 * @method CorrespondantAdministratif[]    findAll()
 * @method CorrespondantAdministratif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CorrespondantAdministratifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CorrespondantAdministratif::class);
    }

    // /**
    //  * @return CorrespondantAdministratif[] Returns an array of CorrespondantAdministratif objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CorrespondantAdministratif
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
