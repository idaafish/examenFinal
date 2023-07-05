<?php

namespace App\Repository;

use App\Entity\ArtículoCategoria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArtículoCategoria>
 *
 * @method ArtículoCategoria|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtículoCategoria|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtículoCategoria[]    findAll()
 * @method ArtículoCategoria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtículoCategoriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtículoCategoria::class);
    }

    public function save(ArtículoCategoria $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ArtículoCategoria $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ArtículoCategoria[] Returns an array of ArtículoCategoria objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ArtículoCategoria
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
