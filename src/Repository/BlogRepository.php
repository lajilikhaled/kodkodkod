<?php

namespace App\Repository;

use App\Entity\Blog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

#[\Doctrine\ORM\Mapping\Entity(repositoryClass: BlogRepository::class)]
class BlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }

    #[\Doctrine\ORM\Mapping\Entity(repositoryClass: BlogRepository::class)]
    public function findByRequestLocale($requestLocale, $offset = 0, $limit = 18)
    {
        return $this->findBy(
            ['locale' => $requestLocale],
            ['posted' => 'DESC'],
            $limit,
            $offset
        );
    }

    #[\Doctrine\ORM\Mapping\Entity(repositoryClass: BlogRepository::class)]
    public function findBlogs(string $requestLocale, int $page, int $pageSize): array
    {
        $pageSize = $pageSize;
        $offset = ($page - 1) * $pageSize + 18;
        $criteria = ['locale' => $requestLocale];
        $orderBy = ['posted' => 'DESC'];
            
        return $this->findBy($criteria, $orderBy, $pageSize, $offset);
    }
}
