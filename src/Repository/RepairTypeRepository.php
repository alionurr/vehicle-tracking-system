<?php

namespace App\Repository;

use App\Entity\RepairType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RepairType>
 *
 * @method RepairType|null find($id, $lockMode = null, $lockVersion = null)
 * @method RepairType|null findOneBy(array $criteria, array $orderBy = null)
 * @method RepairType[]    findAll()
 * @method RepairType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepairTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RepairType::class);
    }

//    /**
//     * @return RepairType[] Returns an array of RepairType objects
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

//    public function findOneBySomeField($value): ?RepairType
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
