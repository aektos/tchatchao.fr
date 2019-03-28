<?php

namespace App\Repository;

use App\Entity\Authlog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Authlog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Authlog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Authlog[]    findAll()
 * @method Authlog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthlogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Authlog::class);
    }

    /**
     * countFailedAuthInLimitedTime
     *
     * @param $ipaddress
     * @param $limitedTime
     * @return mixed
     * @throws \Doctrine\DBAL\DBALException
     */
    public function countFailedAuthInLimitedTime($ipaddress, $limitedTime)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT COUNT(a.id) as nb_failedauth
        FROM authlog a
        WHERE a.failure = 1
            AND a.ip = :ip
            AND FROM_UNIXTIME(a.tstamp) > TIMESTAMPADD(MINUTE, -:limited_time, UTC_TIMESTAMP())
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'ip' => $ipaddress,
            'limited_time' => $limitedTime
        ]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetch();
    }

    /**
     * @return mixed
     */
    public function deleteAll()
    {
        return $this->createQueryBuilder('a')
            ->delete()
            ->getQuery()
            ->execute();
    }
}
