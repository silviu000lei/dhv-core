<?php

namespace App\Repository;

use App\Entity\CourantMusical;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CourantMusical>
 *
 * @method CourantMusical|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourantMusical|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourantMusical[]    findAll()
 * @method CourantMusical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourantMusicalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CourantMusical::class);
    }

    public function save(CourantMusical $courantMusical)
    {
        $this->getEntityManager()->persist($courantMusical);
        $this->getEntityManager()->flush();
    }

    public function bulkSave(Collection $courantMusicalCollection)
    {
        /** @var CourantMusical $courantMusical */
        foreach($courantMusicalCollection as $courantMusical){
            $this->getEntityManager()->persist($courantMusical);
        }

        $this->getEntityManager()->flush();
    }
//    /**
//     * @return CourantMusical[] Returns an array of CourantMusical objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CourantMusical
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
