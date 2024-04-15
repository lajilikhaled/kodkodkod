<?php
// src/EventSubscriber/LocaleSubscriber.php
namespace App\EventSubscriber;

use App\Repository\BlogRepository;
use App\Repository\PageRepository;
use Negotiation\LanguageNegotiator;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SiteSubscriber implements EventSubscriberInterface
{
    private $blogRepository;
	private $pageRepository;

    public function __construct(
		BlogRepository $blogRepository,
		PageRepository $pageRepository)
    {
        $this->blogRepository = $blogRepository;
		$this->pageRepository = $pageRepository;
    }

    public static function getSubscribedEvents()
    {
	    return [
		    SitemapPopulateEvent::class => 'populate',
	    ];
    }

	/**
	 * @param SitemapPopulateEvent $event
	 */
	public function populate(SitemapPopulateEvent $event): void
	{
		$this->registerBlogPostsUrls($event->getUrlContainer(), $event->getUrlGenerator());
	}

	/**
	 * @param UrlContainerInterface $urls
	 * @param UrlGeneratorInterface $router
	 */
	public function registerBlogPostsUrls(UrlContainerInterface $urls, UrlGeneratorInterface $router): void
	{
		$posts = $this->blogRepository->findAll();

		$pages = $this->pageRepository->findAll();

		foreach ($posts as $post) {
			$urls->addUrl(
				new UrlConcrete(
					$router->generate(
						'app_blog_detail',
						['slug' => $post->getSlug(),'_locale' => $post->getLocale()],
						UrlGeneratorInterface::ABSOLUTE_URL
					)
				),
				'blog'
			);
		}

		foreach ($pages as $page) {
			$urls->addUrl(
				new UrlConcrete(
					$router->generate(
						'app_page_detail2',
						['slug' => $page->getSlug(),'_locale' => 'fr'],
						UrlGeneratorInterface::ABSOLUTE_URL
					)
				),
				'page'
			);
		}
	}
}
