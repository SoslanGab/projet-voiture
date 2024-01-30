<?php

namespace App\Repository;

use App\Entity\TypeDommage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeDommage>
 *
 * @method TypeDommage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeDommage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeDommage[]    findAll()
 * @method TypeDommage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeDommageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeDommage::class);
    }

//    /**
//     * @return TypeDommage[] Returns an array of TypeDommage objects
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

//    public function findOneBySomeField($value): ?TypeDommage
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
