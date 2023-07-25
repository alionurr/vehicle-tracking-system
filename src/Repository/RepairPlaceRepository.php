<?php

namespace App\Repository;

use App\Entity\RepairPlace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RepairPlace>
 *
 * @method RepairPlace|null find($id, $lockMode = null, $lockVersion = null)
 * @method RepairPlace|null findOneBy(array $criteria, array $orderBy = null)
 * @method RepairPlace[]    findAll()
 * @method RepairPlace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepairPlaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RepairPlace::class);
    }

//    /**
//     * @return RepairPlace[] Returns an array of RepairPlace objects
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

//    public function findOneBySomeField($value): ?RepairPlace
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
