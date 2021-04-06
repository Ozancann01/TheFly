<?php

namespace App\Repository;

use App\Entity\Vliegveld;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vliegveld|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vliegveld|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vliegveld[]    findAll()
 * @method Vliegveld[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VliegveldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vliegveld::class);
    }

    // /**
    //  * @return Vliegveld[] Returns an array of Vliegveld objects
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
    public function findOneBySomeField($value): ?Vliegveld
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
