<?php

namespace App\Repository;

use App\Entity\SessionsCandidat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SessionsCandidat>
 *
 * @method SessionsCandidat|null find($id, $lockMode = null, $lockVersion = null)
 * @method SessionsCandidat|null findOneBy(array $criteria, array $orderBy = null)
 * @method SessionsCandidat[]    findAll()
 * @method SessionsCandidat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionsCandidatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SessionsCandidat::class);
    }

//    /**
//     * @return SessionsCandidat[] Returns an array of SessionsCandidat objects
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

//    public function findOneBySomeField($value): ?SessionsCandidat
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
