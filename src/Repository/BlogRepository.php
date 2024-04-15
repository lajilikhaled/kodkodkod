<?php

namespace App\Repository;

use App\Entity\Blog;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Blog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blog[]    findAll()
 * @method Blog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
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

    public function findBlogs(string $requestLocale, int $page, int $pageSize): array
    {
        $pageSize = $pageSize;
        $offset = ($page - 1) * $pageSize + 18;
        $criteria = ['locale' => $requestLocale];
        $orderBy = ['posted' => 'DESC'];
            
        return $this->findBy($criteria, $orderBy, $pageSize, $offset);
    }
}
