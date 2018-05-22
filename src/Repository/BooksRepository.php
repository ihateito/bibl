<?php

namespace App\Repository;

use App\Entity\Books;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Books|null find($id, $lockMode = null, $lockVersion = null)
 * @method Books|null findOneBy(array $criteria, array $orderBy = null)
 * @method Books[]    findAll()
 * @method Books[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BooksRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Books::class);
    }

    public function getFilteredData(array $filters)
    {
        $sql = 'SELECT * FROM books b
                WHERE TRUE ';

        foreach ($filters as $key => $value) {
            if ($value) {
                $sql .= 'AND b.' . $key . ' ~ :' . $key;
            } else {
                unset($filters[$key]);
            }
        }
        $conn = $this->getEntityManager()->getConnection();


        $stmt = $conn->prepare($sql);
        $stmt->execute($filters);

        return $stmt->fetchAll();
    }

    /*
    public function findOneBySomeField($value): ?Books
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
