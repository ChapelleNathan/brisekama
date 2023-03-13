<?php

namespace App\Repository;

use App\Entity\ItemServer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItemServer>
 *
 * @method ItemServer|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemServer|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemServer[]    findAll()
 * @method ItemServer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemServerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemServer::class);
    }

    public function save(ItemServer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ItemServer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getOneByItemServerIds(int $serverId, int $itemId): ?ItemServer
    {
        return $this->createQueryBuilder('itemServ')
        ->join('itemServ.item', 'i')
        ->join('itemServ.server', 's')
        ->where('i.id = :itemId')
        ->andWhere('s.id = :serverId')
        ->setParameter('itemId', $itemId)
        ->setParameter('serverId', $serverId)
        ->getQuery()
        ->getOneOrNullResult();
    }

//    /**
//     * @return ItemServer[] Returns an array of ItemServer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ItemServer
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
