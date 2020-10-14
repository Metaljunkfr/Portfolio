<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Utilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateur[]    findAll()
 * @method Utilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    //Requêtes personnalisées DQL
    public function trouvemesavis()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->addSelect('c')
            ->where('c.id > 0')
            ->join('b.recommandations', 'c')
            ->addOrderBy('c.dateCreation', 'DESC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);
    }



}
