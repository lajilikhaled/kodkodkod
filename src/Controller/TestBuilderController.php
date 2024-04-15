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
use Symfony\Contracts\HttpClient\HttpClientInterface;
use function Symfony\Component\String\s;

class TestBuilderController extends AbstractController
{

	use LoggerTrait;
	use MailerTrait;
	use EntityManagerTrait;
	use BlogRepositoryTrait;



	/**
	 * @Route("/test-builder", priority=1)
	 */
	public function test(Request $request, HttpClientInterface $httpClient): Response
	{

		$res = $httpClient->request(Request::METHOD_GET, 'https://cdn.builder.io/api/v1/html/page?apiKey=e06b077e2ebc4cd1a2157810d0a2230d&url=/test');
		$resContent= $res->getContent();
		$json = json_decode($resContent, true);

		return new Response($json['data']['html']);
	}


}
