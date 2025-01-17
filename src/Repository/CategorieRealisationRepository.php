<?php

namespace App\Repository;

use App\Entity\CategorieRealisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategorieRealisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieRealisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieRealisation[]    findAll()
 * @method CategorieRealisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRealisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieRealisation::class);
    }

    // /**
    //  * @return CategorieRealisation[] Returns an array of CategorieRealisation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategorieRealisation
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
