<?php

namespace App\Repository;

use App\Entity\TypeApplication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeApplication>
 *
 * @method TypeApplication|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeApplication|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeApplication[]    findAll()
 * @method TypeApplication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeApplicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeApplication::class);
    }

//    /**
//     * @return TypeApplication[] Returns an array of TypeApplication objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeApplication
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
