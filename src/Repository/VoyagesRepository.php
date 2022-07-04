<?php

namespace App\Repository;

use App\Entity\Voyages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Voyages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voyages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voyages[]    findAll()
 * @method Voyages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoyagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voyages::class);
    }

    public function infosVoyages($idVoyages){
        return $this->createQueryBuilder('v')
        ->leftJoin('v.ligne','l')
        ->leftJoin('v.bus','bs')
        ->leftJoin('bs.TypeVehicule','tv')
        ->leftJoin('l.VilleDepart','dp')
        ->leftJoin('l.VilleDepart','ar')
        ->andWhere('v.id = :val')
            ->setParameter('val', $idVoyages)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function voyageVilleDepart( $idVoyages){
        return $this->createQueryBuilder('v')

            ->leftJoin('v.ligne','l')
            ->leftJoin('l.escales','e')
            ->leftJoin("e.VilleDepart","vd")
            ->andWhere('v.id = :val')
            ->setParameter('val', $idVoyages)
            ->getQuery()
            ->getResult();
    }

    public function recherchesVoyages($depart,$destination,$date){
        return $this->createQueryBuilder('v')
        ->leftJoin('v.ligne','l')  
        ->leftJoin('l.escales','e')      
        ->leftJoin('e.VilleDepart','dp')
        ->leftJoin('e.VilleArrive','ar')
        ->Where('dp.id = :depart')
        ->andWhere('ar.id = :destination')
            ->setParameter('depart', $depart)
            ->setParameter('destination', $destination)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Voyages[] Returns an array of Voyages objects
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
    public function findOneBySomeField($value): ?Voyages
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
