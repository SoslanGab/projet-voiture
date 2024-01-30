<?php

namespace App\Repository;

use App\Entity\DommageVoiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DommageVoiture>
 *
 * @method DommageVoiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method DommageVoiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method DommageVoiture[]    findAll()
 * @method DommageVoiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DommageVoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DommageVoiture::class);
    }

//    /**
//     * @return DommageVoiture[] Returns an array of DommageVoiture objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DommageVoiture
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
