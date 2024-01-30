<?php

namespace App\Repository;

use App\Entity\Typevoiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Typevoiture>
 *
 * @method Typevoiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Typevoiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Typevoiture[]    findAll()
 * @method Typevoiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypevoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Typevoiture::class);
    }

//    /**
//     * @return Typevoiture[] Returns an array of Typevoiture objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Typevoiture
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
