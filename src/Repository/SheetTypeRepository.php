<?php

namespace App\Repository;

use App\Entity\SheetType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SheetType|null find($id, $lockMode = null, $lockVersion = null)
 * @method SheetType|null findOneBy(array $criteria, array $orderBy = null)
 * @method SheetType[]    findAll()
 * @method SheetType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SheetTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SheetType::class);
    }

    // /**
    //  * @return SheetType[] Returns an array of SheetType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SheetType
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
