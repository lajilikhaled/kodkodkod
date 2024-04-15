<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\Conversion;
use App\Entity\Project;
use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use App\Repository\BlogRepository;
use App\Services\GoogleRecaptcha;
use App\Services\SpamChecker;
use App\Traits\BlogRepositoryTrait;
use App\Traits\EntityManagerTrait;
use App\Traits\LoggerTrait;
use App\Traits\MailerTrait;
use Doctrine\ORM\EntityManagerInterface;
use Presta\SitemapBundle\Exception\Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use function Symfony\Component\String\s;

class BlogController extends AbstractController
{

	use LoggerTrait;
	use MailerTrait;
	use EntityManagerTrait;
	use BlogRepositoryTrait;


	/**
	 * @Route("/{_locale<%app.supported_locales%>}/article/{slug}", priority=1)
	 */
	public function detail(Request $request, Blog $blog): Response
	{
		if ($blog->getLocale() != $request->getLocale()) {
			throw new NotFoundHttpException();
		}
		return $this->render('blog/detail.html.twig', [
			'blog' => $blog
		]);
	}

	/**
	 * @Route("/{_locale<%app.supported_locales%>}/blog", name="blog",  options={"sitemap" = true}, priority=1)
	 */
	public function findBlogs(Request $request, BlogRepository $blogRepository)
	{
		if ($request->getLocale() == 'ca' || $request->getLocale() == 'ch' || $request->getLocale() == 'fr') {
			$local = 'fr';
		} else {
			$local = $request->getLocale();
		}

		$blogs = $blogRepository->findByRequestLocale($local);
		$lastArticle = array_pop($blogs);
		return $this->render('blog/blogNew.html.twig', [
			"blogs" => $blogs,
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
