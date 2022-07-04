<?php

namespace App\Repository;

use App\Entity\Passagers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Passagers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Passagers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Passagers[]    findAll()
 * @method Passagers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassagersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Passagers::class);
    }

    // /**
    //  * @return Passagers[] Returns an array of Passagers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Passagers
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
