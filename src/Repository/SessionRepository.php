<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    /**
      * @return Session[] Returns an array of Session objects
      */
    
    public function findThreeSessions()
    {
        $now = new \DateTime();
        return $this->createQueryBuilder('s')
            ->andWhere('s.dateDebut > :now')
            ->setParameter('now', $now->format('Y-m-d'))
            ->orderBy('s.dateDebut', 'ASC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Session
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function countSessions(){
        return $this->createQueryBuilder('s')
                ->select('count(s.id)')
                ->getQuery()
                ->getSingleScalarResult();
    }
}
