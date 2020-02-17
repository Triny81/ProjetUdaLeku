<?php

namespace App\Repository;

use App\Entity\ListeAffaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ListeAffaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeAffaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeAffaire[]    findAll()
 * @method ListeAffaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeAffaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeAffaire::class);
    }

    // /**
    //  * @return ListeAffaire[] Returns an array of ListeAffaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListeAffaire
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
