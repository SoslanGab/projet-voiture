<?php

namespace App\Repository;

use App\Entity\SanctionsLocatives;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SanctionsLocatives>
 *
 * @method SanctionsLocatives|null find($id, $lockMode = null, $lockVersion = null)
 * @method SanctionsLocatives|null findOneBy(array $criteria, array $orderBy = null)
 * @method SanctionsLocatives[]    findAll()
 * @method SanctionsLocatives[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SanctionsLocativesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SanctionsLocatives::class);
    }

//    /**
//     * @return SanctionsLocatives[] Returns an array of SanctionsLocatives objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SanctionsLocatives
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
