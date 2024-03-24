<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Blog;
use App\Repository\BlogRepository;
use App\Traits\BlogRepositoryTrait;
use App\Traits\EntityManagerTrait;
use App\Traits\MailerTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{

	use MailerTrait;
	use EntityManagerTrait;
	use BlogRepositoryTrait;


	// /**
	//  * @Route("/{_locale<%app_locales%>}/article/{slug}", priority=1)
	//  */
	// public function detail(Request $request, Blog $blog): Response
	// {
	// 	if ($blog->getLocale() != $request->getLocale()) {
	// 		throw new NotFoundHttpException();
	// 	}
	// 	return $this->render('blog/detail.html.twig', [
	// 		'blog' => $blog
	// 	]);
	// }

    #[Route('/{_locale<%app_locales%>}/blog', name: 'app_blog')]
	public function findBlogs(Request $request, BlogRepository $blogRepository)
	{
		if ($request->getLocale() == 'ca' || $request->getLocale() == 'ch' || $request->getLocale() == 'fr') {
			$local = 'fr';
		} else {
			$local = $request->getLocale();
		}

		$blogs = $blogRepository->findByRequestLocale($local);
		$allBlogs = [];
		foreach ($blogs as $blog) {
			$allBlogs[] = [
				'locale' => $blog->getLocale(),
				'slug' => $blog->getSlug(),
				'title' => $blog->getTitle(),
				'image' => $blog->getImage(),
				'posted' => $blog->getPosted(),
			];
		}
		$lastArticle = array_pop($blogs);
		return $this->render('blog/index.html.twig', [
			"blogs" => $allBlogs,
			'lastArticle' => $lastArticle
		]);
	}

	/**
	 * @Route("/load-more", name="load_more", options={"sitemap" = true}, priority=1)
	 */
	public function loadMore(Request $request, BlogRepository $blogRepository): Response
	{
		if ($request->getLocale() == 'ca' || $request->getLocale() == 'ch' || $request->getLocale() == 'fr') {
			$local = 'fr';
		} else {
			$local = $request->getLocale();
		}

		$page = $request->query->get('page', 1);
		$pageSize = $request->query->get('pageSize');
		$blogs = $blogRepository->findBlogs(
			$local,
			$page,
			$pageSize
		);

		$blogs = array_map(function ($blog) {
			return $blog->toArray();
		}, $blogs);

		return new JsonResponse($blogs);
	}

}
