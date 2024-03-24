<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    // /**
    //  * @return Project[] Returns an array of Project objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Project
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

	public function findAllOrderedByPriority($language_code)
	{
		$qb = $this->createQueryBuilder('p');
		if ($language_code == 'ko') {
			$qb->addOrderBy('CASE WHEN p.priorityKo IS NULL THEN 1 ELSE 0 END, p.priorityKo', 'ASC');
		} else {
			$qb->addOrderBy('CASE WHEN p.priority IS NULL THEN 1 ELSE 0 END, p.priority', 'ASC');
		}
		return $qb->getQuery()->getResult();
	}

    public function findAllOrderedByCountry($country)
    {
        $qb = $this->createQueryBuilder('p');
        $qb->addSelect('(CASE WHEN LOWER(p.country) LIKE :country THEN 0 ELSE 1 END) AS HIDDEN countryOrder');
        $qb->orderBy('countryOrder', 'ASC');
	    $qb->addOrderBy('CASE WHEN p.priority IS NULL THEN 1 ELSE 0 END, p.priority', 'ASC');
        $qb->setParameter('country', $country . '%');

        return $qb->getQuery()->getResult();
    }
}
