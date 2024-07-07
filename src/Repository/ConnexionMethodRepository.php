<?php

namespace App\Repository;

use App\Entity\ConnexionMethod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConnexionMethod>
 *
 * @method ConnexionMethod|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConnexionMethod|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConnexionMethod[]    findAll()
 * @method ConnexionMethod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConnexionMethodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConnexionMethod::class);
    }

//    /**
//     * @return ConnexionMethod[] Returns an array of ConnexionMethod objects
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

//    public function findOneBySomeField($value): ?ConnexionMethod
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
