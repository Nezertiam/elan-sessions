<?php

namespace App\Repository;

use App\Entity\Stagiaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stagiaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stagiaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stagiaire[]    findAll()
 * @method Stagiaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StagiaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stagiaire::class);
    }


    public function queryToFindNotInSession($session)
    {

        $subQueryBuilder = $this->getEntityManager()->createQueryBuilder();
        $subQuery = $subQueryBuilder
            ->select('s.id')
            ->from('App\Entity\Stagiaire', 's')
            ->innerJoin('s.sessions', 'se')
            ->where('se.id = :sessid');

        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        return $queryBuilder
            ->select('s2')
            ->from('App\Entity\Stagiaire', 's2')
            ->where($queryBuilder->expr()->notIn('s2.id', $subQuery->getDQL()))
            ->setParameter('sessid', $session->getId());
    }


    /*
    public function findOneBySomeField($value): ?Stagiaire
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function countStagiaires()
    {
        return $this->createQueryBuilder('st')
            ->select('count(st.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
