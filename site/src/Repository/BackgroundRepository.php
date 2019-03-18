<?php

namespace App\Repository;

use App\Entity\Background;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Background|null find($id, $lockMode = null, $lockVersion = null)
 * @method Background|null findOneBy(array $criteria, array $orderBy = null)
 * @method Background[]    findAll()
 * @method Background[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BackgroundRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Background::class);
    }

    // /**
    //  * @return Background[] Returns an array of Background objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Background
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
