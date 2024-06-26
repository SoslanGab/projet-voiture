<?php

namespace App\Repository;

use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Voiture>
 *
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }
    public function findAllMarques(){
        $qb = $this->createQueryBuilder('v')
            ->select('v.marque AS marque')
            ->groupBy('marque');
        return $qb->getQuery()->getResult();
    }
    
    public function findAllCouleurs(){
        $qb = $this->createQueryBuilder('v')
            ->select('v.couleur AS couleur')
            ->groupBy('couleur');
        return $qb->getQuery()->getResult();
    }
    public function findMostRented(int $limit): array
    {
        return $this->createQueryBuilder('v')
            ->select('v, COUNT(l.id) AS HIDDEN rentals')
            ->leftJoin('v.locations', 'l')
            ->groupBy('v.id')
            ->orderBy('rentals', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Voiture[] Returns an array of Voiture objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Voiture
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
