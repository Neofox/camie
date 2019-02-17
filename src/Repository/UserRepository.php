<?php

namespace App\Repository;

use App\Entity\Child;
use App\Entity\Guardian;
use App\Entity\Nurse;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findRelatedNurse(User $user)
    {
        $nurse = $this->getEntityManager()->createQueryBuilder()
                      ->select('n')
                      ->from(Nurse::class, 'n')
                      ->where('n.user = :user');
        $nurse->setParameter(':user', $user);

        return $nurse->getQuery()->getOneOrNullResult();
    }

    public function findRelatedGuardian(User $user)
    {
        $guardian = $this->getEntityManager()->createQueryBuilder()
            ->select('g')
            ->from(Guardian::class, 'g')
            ->where('g.user = :user')
        ;
        $guardian->setParameter(':user', $user);

        return $guardian->getQuery()->getOneOrNullResult();
    }

    public function assignChildToNurse(Child $child, Nurse $nurse)
    {
        //TODO

    }

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
