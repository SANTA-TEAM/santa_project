<?php

namespace App\Repository;

use App\Entity\Age;
use App\Entity\Gift;
use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Gift>
 *
 * @method Gift|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gift|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gift[]    findAll()
 * @method Gift[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GiftRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gift::class);
    }


    public function findGiftsWithImages()
    {

        $qb = $this->createQueryBuilder('g')
            ->leftJoin('g.images', 'i')
            ->orderBy('g.id', 'DESC')
            ->getQuery()
            ->getResult();

        return $qb;
    }


    public function filter(Age|null $age = null, Category|null $category = null, string|null $order = null)
    {
        $qb = $this->createQueryBuilder('g')
            ->leftJoin('g.images', 'i');
            if($age) {
                $qb->andWhere('g.age = :age')
                ->setParameter(':age', $age);
            }
            if($category) {
                $qb->andWhere('g.category = :category')
                ->setParameter(':category', $category);
            }
            if($order) {
                switch ($order) {
                    case 'Age_ASC':
                        $qb->orderBy('g.age', 'ASC');
                        break;
                    case 'Age_DESC':
                        $qb->orderBy('g.age', 'DESC');
                        break;
                    case 'Cat_ASC':
                        $qb->orderBy('g.category', 'ASC');
                        break;
                    case 'Cat_DESC':
                        $qb->orderBy('g.category', 'DESC');
                        break;
                }
            } else {
                $qb->orderBy('g.id', 'DESC');
            }
        return $qb->getQuery()->getResult();
    }


    //    /**
    //     * @return Gift[] Returns an array of Gift objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Gift
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
