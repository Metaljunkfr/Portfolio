<?php

namespace App\Repository;

use App\Entity\Realisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Realisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Realisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Realisation[]    findAll()
 * @method Realisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RealisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Realisation::class);
    }

    //Requêtes personnalisées DQL
    public function trouvederniererealisationpardatedesc()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->addSelect('c')
            ->where('b.isPublished = true')
            ->join('b.categorieRealisation', 'c')
            ->addOrderBy('b.dateCreation', 'DESC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);
    }

    public function trouvederniererealisationpardateasc()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->addSelect('c')
            ->where('b.isPublished = true')
            ->join('b.categorieRealisation', 'c')
            ->addOrderBy('b.dateCreation', 'ASC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);
    }

    public function trouvederniererealisationpardatecreadesc()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->addSelect('c')
            ->where('b.isPublished = true')
            ->join('b.categorieRealisation', 'c')
            ->addOrderBy('b.dateProjet', 'DESC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);
    }

    public function trouvederniererealisationpardatecreaasc()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->addSelect('c')
            ->where('b.isPublished = true')
            ->join('b.categorieRealisation', 'c')
            ->addOrderBy('b.dateProjet', 'ASC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);
    }

    public function trouvederniererealisationparordrealpha()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->addSelect('c')
            ->where('b.isPublished = true')
            ->join('b.categorieRealisation', 'c')
            ->addOrderBy('c.id', 'ASC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);
    }

    public function trouvederniererealisationparordrealphainvers()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->addSelect('c')
            ->where('b.isPublished = true')
            ->join('b.categorieRealisation', 'c')
            ->addOrderBy('c.id', 'DESC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);
    }
}
