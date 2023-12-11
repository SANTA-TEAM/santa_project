<?php

namespace App\Repository;

use App\Entity\Reindeers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reindeers>
 *
 * @method Reindeers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reindeers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reindeers[]    findAll()
 * @method Reindeers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReindeersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reindeers::class);
    }

//    /**
//     * @return Reindeers[] Returns an array of Reindeers objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Reindeers
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
