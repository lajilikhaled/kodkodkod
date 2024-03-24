<?php

namespace App\Repository;

use App\Entity\Blog;
use App\Entity\Category;
use App\Entity\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Blog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blog[]    findAll()
 * @method Blog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Page::class);
    }
/**
     * Finds all blogs with the specified Request Locale.
     *
     * @param string $categoryName The name of the category to search for.
     *
     * @return Blog[] An array of Blog entities.
     */
    public function findByRequestLocale($requestLocale, $offset = 0, $limit = 18)
    {
        return $this->findBy(
            ['locale' => $requestLocale],
            ['posted' => 'DESC'],
            $limit,
            $offset
        );
    }

}
