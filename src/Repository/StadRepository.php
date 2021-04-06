<?php

namespace App\Repository;

use App\Entity\Stad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stad[]    findAll()
 * @method Stad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stad::class);
    }

    // /**
    //  * @return Stad[] Returns an array of Stad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stad
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
