<?php

namespace App\Repository;

use App\Entity\Vliegtuig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vliegtuig|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vliegtuig|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vliegtuig[]    findAll()
 * @method Vliegtuig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VliegtuigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vliegtuig::class);
    }

    // /**
    //  * @return Vliegtuig[] Returns an array of Vliegtuig objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vliegtuig
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
