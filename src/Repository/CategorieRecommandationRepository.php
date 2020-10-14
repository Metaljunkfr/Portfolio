<?php

namespace App\Repository;

use App\Entity\CategorieRecommandation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method CategorieRecommandation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieRecommandation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieRecommandation[]    findAll()
 * @method CategorieRecommandation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRecommandationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieRecommandation::class);
    }


}
