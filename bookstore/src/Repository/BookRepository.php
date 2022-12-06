<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Book $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Book $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    //SQL: SELECT * FROM Book ORDER BY id DESC
    //Purpose: Newest books will be displayed first
    //DQL (Doctrine Query Language)
    public function sortBookByIdDesc()
    {
        return $this->createQueryBuilder('book')
            ->orderBy('book.id', 'DESC')
            //ASC: Ascending (tăng dần)
            //DESC: Descending (giảm dần)
            ->getQuery()
            ->getResult()
        ;
    }

    public function sortBookPriceAsc()
    {
        return $this->createQueryBuilder('book')
            ->orderBy('book.price', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function sortBookPriceDesc()
    {
        return $this->createQueryBuilder('book')
            ->orderBy('book.price', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    //SQL: SELECT * FROM Book WHERE title LIKE % 'keyword' %
    public function searchBook($keyword) 
    {
        return $this->createQueryBuilder('book')
            ->andWhere('book.title LIKE :key')
            ->setParameter('key', '%' . $keyword . '%')
            ->orderBy('book.price', 'ASC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult()
        ;
    }
}
