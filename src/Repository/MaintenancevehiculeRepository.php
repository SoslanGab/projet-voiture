<?php

namespace App\Repository;

use App\Entity\Maintenancevehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Maintenancevehicule>
 *
 * @method Maintenancevehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Maintenancevehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Maintenancevehicule[]    findAll()
 * @method Maintenancevehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaintenancevehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Maintenancevehicule::class);
    }

//    /**
//     * @return Maintenancevehicule[] Returns an array of Maintenancevehicule objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Maintenancevehicule
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
