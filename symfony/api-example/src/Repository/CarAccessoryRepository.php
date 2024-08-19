<?php

namespace App\Repository;

use App\Entity\CarAccessory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarAccessory>
 *
 * @method CarAccessory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarAccessory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarAccessory[]    findAll()
 * @method CarAccessory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarAccessoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarAccessory::class);
    }

//    /**
//     * @return CarAccessory[] Returns an array of CarAccessory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CarAccessory
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
