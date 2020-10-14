<?php

namespace App\Repository;

use App\Entity\Recommandation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Recommandation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recommandation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recommandation[]    findAll()
 * @method Recommandation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecommandationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recommandation::class);

    }

    //Requêtes personnalisées DQL
    public function trouvederniererecommandationpardatedesc()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->addSelect('c')
            ->where('b.isPublished = true')
            ->join('b.categorieRecommandation', 'c')
            ->addOrderBy('b.dateCreation', 'DESC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);
    }

    public function trouvederniererecommandationpardateasc()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->addSelect('c')
            ->where('b.isPublished = true')
            ->join('b.categorieRecommandation', 'c')
            ->addOrderBy('b.dateCreation', 'ASC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);
    }

    public function trouvederniererecommandationparordrealpha()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->addSelect('c')
            ->where('b.isPublished = true')
            ->join('b.categorieRecommandation', 'c')
            ->addOrderBy('b.nom', 'ASC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);
    }

    public function trouvederniererecommandationparordrealphainvers()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->addSelect('c')
            ->where('b.isPublished = true')
            ->join('b.categorieRecommandation', 'c')
            ->addOrderBy('b.nom', 'DESC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);
    }


    public function trouvederniererecommandationparnotemeilleure()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->addSelect('c')
            ->where('b.isPublished = true')
            ->join('b.categorieRecommandation', 'c')
            ->addOrderBy('c.id', 'DESC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);
    }

    public function trouvederniererecommandationparnotemoinsbonne()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->addSelect('c')
            ->where('b.isPublished = true')
            ->join('b.categorieRecommandation', 'c')
            ->addOrderBy('c.id', 'ASC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);
    }

}
