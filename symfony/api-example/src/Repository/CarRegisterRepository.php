<?php

namespace App\Repository;

use App\Entity\CarRegister;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarRegister>
 *
 * @method CarRegister|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarRegister|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarRegister[]    findAll()
 * @method CarRegister[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRegisterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarRegister::class);
    }

//    /**
//     * @return CarRegister[] Returns an array of CarRegister objects
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

//    public function findOneBySomeField($value): ?CarRegister
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
