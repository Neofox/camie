<?php

namespace App\Repository;

use App\Entity\Child;
use App\Entity\Sheet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sheet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sheet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sheet[]    findAll()
 * @method Sheet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SheetRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sheet::class);
    }

    /**
     * @param Sheet $sheet
     * @param array $data
     *
     * @return Sheet
     */
    public function updateSheetData(Sheet $sheet, array $data): Sheet
    {
        $sheet->setData($data);
        $this->save($sheet);

        return $sheet;
    }

    public function findByChildAndType(Child $child, int $type)
    {
        return $this->createQueryBuilder('s')
            ->join('s.child', 'c')
            ->where('s.type = :type')
            ->andWhere('c = :child')
            ->setParameter(':type', $type)
            ->setParameter(':child', $child)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findChildDailySheet(Child $child)
    {
        $query = $this->createQueryBuilder('s')
            ->join('s.child', 'c')
            ->where('s.type = :type')
            ->andWhere('c = :child')
            ->andWhere('s.createdAt = CURRENT_DATE()')
            ->setParameter(':type', Sheet::TYPE_DAILY)
            ->setParameter(':child', $child);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function createSheet(Sheet $sheet)
    {
        $this->getEntityManager()->persist($sheet);
        $this->getEntityManager()->flush();
    }

    public function save(Sheet $sheet)
    {
        $this->getEntityManager()->persist($sheet);
        $this->getEntityManager()->flush();
    }

}
