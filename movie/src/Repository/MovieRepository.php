<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 *
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function save(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Movie[]  
     */
    public function sortMovieByIdDesc()
    {
        //SQL: SELECT * FROM movie ORDER BY id DESC
        return $this->createQueryBuilder('movie')
            ->orderBy('movie.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function sortMovieNameAsc()
    {
        return $this->createQueryBuilder('movie')
            ->orderBy('movie.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function sortMovieNameDesc()
    {
        return $this->createQueryBuilder('movie')
            ->orderBy('movie.name', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function searchMovie($name) 
    {
        return $this->createQueryBuilder('movie')
            ->andWhere('movie.name LIKE :n')
            ->setParameter('n', '%' . $name . '%')
            ->getQuery()
            ->getResult()
        ;
    }
}
