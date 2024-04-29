<?php

namespace App\Controller;

use App\Entity\Conversion;
use App\Entity\Project;
use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use App\Services\GoogleRecaptcha;
use App\Services\SpamChecker;
use App\Traits\EntityManagerTrait;
use App\Traits\LoggerTrait;
use App\Traits\MailerTrait;
use Doctrine\ORM\EntityManagerInterface;
use ipinfo\ipinfo\IPinfo;
use Presta\SitemapBundle\Exception\Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

class HomeController extends AbstractController
{

	use LoggerTrait;
	use MailerTrait;
	use EntityManagerTrait;

	/**
	 * @Route("/{_locale<%app.supported_locales%>}/kodwallet", name="kodwallet",  options={"sitemap" = true}, priority=1)
	 * @Route("/{_locale<%app.supported_locales%>}", name="kodwallet_home", host="kodwallet.com")
	 */
	public function kodwallet()
	{
		return $this->render('home/kodwallet.html.twig', [
		]);
	}


	/**
	 * @Route("/")
	 */
    public function indexNoLocale(Request $request): Response
    {
	    $locale = $request->getLocale();
        return $this->redirectToRoute('home', ['_locale' => $locale], 301);
    }

	/**
	 * @Route("/{_locale<%app.supported_locales%>}", name="home",  options={"sitemap" = true}, priority=1)
	 * @Cache(public=true, maxage=3600, mustRevalidate=true)
	 */
	public function index(Request $request): Response
	{
		$hongKong = false;
		if($request->getLocale() === 'en'){
			$access_token = '06c0daa024478b';
			$client = new IPinfo($access_token);
			$ip_address = $request->getClientIp();
			$details = $client->getDetails($ip_address);

			if(isset($details->country) && $details->country  == 'HK') {
				$hongKong = true;
			}
		}

		return $this->render('home/newHome.html.twig', [
			'hongKong' => $hongKong
		]);
	}

//	/**
//	 * @Route("/{_locale<%app.supported_locales%>}/web-agency-{city}", name="home",  options={"sitemap" = true}, priority=1)
//	 * @Cache(public=true, maxage=3600, mustRevalidate=true)
//	 */
//	public function webAgency(Request $request, $city): Response
//	{
//		$hongKong = false;
//		if($request->getLocale() === 'en'){
//			$access_token = '06c0daa024478b';
//			$client = new IPinfo($access_token);
//			$ip_address = $request->getClientIp();
//			$details = $client->getDetails($ip_address);
//
//			if(isset($details->country) && $details->country  == 'HK') {
//				$hongKong = true;
//			}
//		}
//
//		return $this->render('home/index.html.twig', [
//			'hongKong' => $hongKong
//		]);
//	}

	/**
	 * @Route("/devis", name="send_devis", priority=1)
	 */
	public function sendDevis(
		Request $request,
		MailerInterface $mailer,
		LoggerInterface $logger,
		GoogleRecaptcha $checker,
		EntityManagerInterface  $entityManager
	): Response
	{
		$name = $request->request->get('name');
		$email = $request->request->get('email');
		$subject = $request->request->get('subject');
		$message = $request->request->get('message');
		$token = $request->request->get('token');

		if($request->isMethod(Request::METHOD_POST)){

			if($name === 'John John' || $email === 'incognito2005@mail.com') {
				return new JsonResponse(['error' => false]);
			}

			$conversion = 	new Conversion();
			$conversion->setName($name);
			$conversion->setEmail($email);
			$conversion->setSubject($subject);
			$conversion->setMesssage($message);


			$response = $checker->check($token);
			$conversion->setGoogleRes(json_encode($response));
			$conversion->setSpam($response['success']);

			$entityManager->persist($conversion);
			$entityManager->flush();

			if($response['success'] === true){
				$email = (new TemplatedEmail())
					->from('team@kodkodkod.studio')
					->to(new Address('maxtor3569@gmail.com'), new Address('morgan@kodkodkod.studio'))
					//->cc('cc@example.com')
					//->bcc('bcc@example.com')
					//->replyTo('fabien@example.com')
					->priority(Email::PRIORITY_HIGH)
					->subject('Nouvelle demande')
					->htmlTemplate('emails/devis.html.twig')
					->context([
						'name' => $name,
						'emailClient' => $email, // email is reservded
						'message' => $message,
						'subject' => $subject
					]);

				try {
					$mailer->send($email);
				} catch (\Exception $e) {
					$logger->error($e->getMessage());
					return new JsonResponse(['error' => true]);

				} catch (TransportExceptionInterface $e) {
					$logger->error($e->getMessage());
					return new JsonResponse(['error' => true]);
				}

			}


		}





		return new JsonResponse(['error' => false]);
	}


	/**
	 * @Route("/devis-send", name="send_form", priority=1)
	 */
	public function sendForm(
		Request $request,
		MailerInterface $mailer,
		LoggerInterface $logger ,
		GoogleRecaptcha $checker,
		EntityManagerInterface  $entityManager
	): Response
	{
		$name = $request->request->get('firstname');
		$email = $request->request->get('email');
		$type = $request->request->get('type');
		$entreprise = $request->request->get('company');
		$message = $request->request->get('message');
		$token = $request->request->get('token');

		if($request->isMethod(Request::METHOD_POST)) {

			$conversion = 	new Conversion();
			$conversion->setName($name);
			$conversion->setEmail($email);
			$conversion->setSubject($type);
			$conversion->setMesssage($message);
			$conversion->setCompany($entreprise);


			$response = $checker->check($token);
			$conversion->setGoogleRes(json_encode($response));
			$conversion->setSpam($response['success']);

			$entityManager->persist($conversion);
			$entityManager->flush();


		}
		if($response['success'] === true) {
			$email = (new TemplatedEmail())
				->from('team@kodkodkod.studio')
				->to(new Address('maxtor3569@gmail.com'), new Address('morgan@kodkodkod.studio'))
				//->cc('cc@example.com')
				//->bcc('bcc@example.com')
				//->replyTo('fabien@example.com')
				->priority(Email::PRIORITY_HIGH)
				->subject('Nouvelle demande')
				//->text('Sending emails is fun again!')
				->htmlTemplate('emails/devisForm.html.twig')
				->context([
					'firstname' => $name,
					'emailClient' => $email,
					'entreprise' => $entreprise,
					'message' => $message,
					'type' => $type
				]);


			try {
				$mailer->send($email);
			} catch (\Exception $e) {
				$logger->error($e->getMessage());
				return $this->redirectToRoute('send_form');

			} catch (TransportExceptionInterface $e) {
				$logger->error($e->getMessage());
				return $this->redirectToRoute('send_form');
			}

		}
		return $this->redirectToRoute('thank_you');
	}



	/**
	 * Not in use
	 * @Route("/{_locale<%app.supported_locales%>}/send-form-contact", name="send-form-contact", priority=1)
	 */
	public function sendFormContact(
		Request $request,
		MailerInterface $mailer,
		LoggerInterface $logger
		//GoogleRecaptcha $checker,
		// EntityManagerInterface  $entityManager
	): Response
	{
		$name = $request->request->get('name');
		$email = $request->request->get('email');
		$telNumber = $request->request->get('tel-number');
		$enterprise = $request->request->get('enterprise');
		$typeProject = $request->request->get('type-project');
		$projectDetail = $request->request->get('project-detail');
		$budget = $request->request->get('budget');
		$time = $request->request->get('time');
		//$token = $request->request->get('token');

		if($request->isMethod(Request::METHOD_POST)) {

		 	$conversion = 	new Conversion();
		 	$conversion->setName($name);
		 	$conversion->setEmail($email);
		 	$conversion->setPhone($telNumber);
		 	$conversion->setCompany($enterprise);
		 	$conversion->setTypeProject($typeProject);


		// 	$response = $checker->check($token);
		// 	$conversion->setGoogleRes(json_encode($response));
		// 	$conversion->setSpam($response['success']);

		// 	$entityManager->persist($conversion);
		// 	$entityManager->flush();


		// }
		//if($response['success'] === true) {
			$email = (new TemplatedEmail())
				->from('team@kodkodkod.studio')
				->to(new Address('maxtor3569@gmail.com'), new Address('morgan@kodkodkod.studio'))
				->priority(Email::PRIORITY_HIGH)
				->subject('Nouvelle demande')
				//->text('Sending emails is fun again!')
				->htmlTemplate('emails/newFormContact.html.twig')
				->context([
					'name' => $name,
					'emailClient' => $email,
					'telNumber' => $telNumber,
					'enterprise' => $enterprise,
					'typeProject' => $typeProject,
					'projectDetail' => $projectDetail,
					'budget' => $budget,
					'time' => $time
				]);


			try {
				$mailer->send($email);
			} catch (\Exception $e) {
				$logger->error($e->getMessage());
				return $this->redirectRoute($typeProject);


			} catch (TransportExceptionInterface $e) {
				$logger->error($e->getMessage());
				return $this->redirectRoute($typeProject);
			}

		}
		return $this->render('home/thank_you.html.twig', []);
	}

	private function handleForm(Request $request){
		$name = $request->request->get('name');
		$email = $request->request->get('email');
		$telNumber = $request->request->get('tel-number');
		$enterprise = $request->request->get('enterprise');
		$typeProject = $request->request->get('type-project');
		$projectDetail = $request->request->get('project-detail');
		$budget = $request->request->get('budget');
		$time = $request->request->get('time');
		//$token = $request->request->get('token');
		$conversion = new Conversion();
		$conversion->setName($name);
		$conversion->setEmail($email);
		$conversion->setPhone($telNumber);
		$conversion->setCompany($enterprise);
		$conversion->setTypeProject($typeProject);
		$conversion->setMesssage($projectDetail);
		$this->em->persist($conversion);
		$this->em->flush();

		$email = (new TemplatedEmail())
			->from('team@mg.kodkodkod.studio')
			->to(new Address('maxtor3569@gmail.com'), new Address('morgan@kodkodkod.studio'))
			->priority(Email::PRIORITY_HIGH)
			->subject('Nouvelle demande')
			//->text('Sending emails is fun again!')
			->htmlTemplate('emails/newFormContact.html.twig')
			->context([
				'name' => $name,
				'emailClient' => $email,
				'telNumber' => $telNumber,
				'enterprise' => $enterprise,
				'typeProject' => $typeProject,
				'projectDetail' => $projectDetail,
				'budget' => $budget,
				'time' => $time
			]);


		try {
			$this->mailer->send($email);
		} catch (\Exception $e) {
			$this->logger->error($e->getMessage());
			return false;

		} catch (TransportExceptionInterface $e) {
			$this->logger->error($e->getMessage());
			return false;
		}

		return true;

	}



	/**
	 * @Route("/{_locale<%app.supported_locales%>}/agence-blockchain",options={"sitemap" = true}, priority=1)
	 */
	public function agenceBlockchain(Request $request)
	{
		return $this->render('home/agence-blockchain.html.twig', [
		]);
	}


	/**
	 * @Route("/creation-refonte-site-web-lp", name="landing",  options={"sitemap" = true}, priority=1)
	 */
	public function landing()
	{
		return $this->render('home/landing.html.twig', [
		]);
	}

	/**
	 * @Route("/creation-refonte-site-web-magento-lp", name="landing_magento",  options={"sitemap" = true}, priority=1)
	 */
	public function landingMagento()
	{
		return $this->render('home/landing_magento.html.twig', [
		]);
	}

	/**
	 * @Route("/{_locale<%app.supported_locales%>}/create-website-magento", name="landing_magento_intl",  options={"sitemap" = true}, priority=1)
	 */
	public function landingMagentoIntl()
	{
		return $this->render('home/landing_magento.html.twig', [
		]);
	}

	/**
	 * @Route("/creation-refonte-site-web-prestashop-lp", name="landing_prestashop",  options={"sitemap" = true}, priority=1)
	 */
	public function landingPrestashop()
	{
		return $this->render('home/landing_prestashop.html.twig', [
		]);
	}

	/**
	 * @Route("/{_locale<%app.supported_locales%>}/create-website-prestashop", name="landing_prestashop_intl",  options={"sitemap" = true}, priority=1)
	 */
	public function landingPrestashopIntl()
	{
		return $this->render('home/landing_prestashop.html.twig', [
		]);
	}

	/**
	 * @Route("/creation-refonte-site-web-shopify-lp", name="landing_shopify",  options={"sitemap" = true}, priority=1)
	 */
	public function landingShopify()
	{
		return $this->render('home/landing_shopify.html.twig', [
		]);
	}

	/**
	 * @Route("/{_locale<%app.supported_locales%>}/create-website-shopify", name="landing_shopify_intl",  options={"sitemap" = true}, priority=1)
	 */
	public function landingShopifyIntl()
	{
		return $this->render('home/landing_shopify.html.twig', [
		]);
	}

	/**
	 * Old landingF
	 * @Route("/creation-refonte-site-web-react-lp", name="landing_react",  options={"sitemap" = true}, priority=1)
	 */
	public function landingReact()
	{
		return $this->redirectToRoute('react',[], 301);
		return $this->render('home/landing_react.html.twig', [
		]);
	}

	/**
	 * @Route("/{_locale<%app.supported_locales%>}/create-website-react", name="landing_react_intl",  options={"sitemap" = true}, priority=1)
	 */
	public function landingReactIntl()
	{
		return $this->redirectToRoute('react',[], 301);
		return $this->render('home/landing_react.html.twig', [
		]);
	}

	/**
	 * @Route("/creation-refonte-site-web-vue-lp", name="landing_vue",  options={"sitemap" = true}, priority=1)
	 */
	public function landingVue()
	{
		return $this->render('home/landing_vue.html.twig', [
		]);
	}

	/**
	 * @Route("/{_locale<%app.supported_locales%>}/create-website-vue", name="landing_vue_intl",  options={"sitemap" = true}, priority=1)
	 */
	public function landingVueIntl()
	{
		return $this->redirectToRoute('vue',[], 301);
		return $this->render('home/landing_vue.html.twig', [
		]);
	}

	/**
	 * @Route("/creation-refonte-site-web-laravel-lp", name="landing_laravel",  options={"sitemap" = true}, priority=1)
	 */
	public function landingLaravel()
	{
		return $this->render('home/landing_laravel.html.twig', [
		]);
	}

	/**
	 * @Route("/{_locale<%app.supported_locales%>}/create-website-laravel", name="landing_laravel_intl",  options={"sitemap" = true}, priority=1)
	 */
	public function landingLaravelIntl()
	{
		return $this->render('home/landing_laravel.html.twig', [
		]);
	}

	/**
	 * @Route("/creation-refonte-site-web-ecommerce-nft-lp", name="landing_nft",  options={"sitemap" = true}, priority=1)
	 */
	public function landingNft()
	{
		return $this->render('home/landing_nft.html.twig', [
		]);
	}

	/**
	 * @Route("/{_locale<%app.supported_locales%>}/create-website-nft", name="landing_nft_intl",  options={"sitemap" = true}, priority=1)
	 */
	public function landingNftIntl()
	{
		return $this->render('home/landing_nft.html.twig', [
		]);
	}

	/**
	 * @Route("/creation-application-blockchain-lp", name="landing_blockchain",  options={"sitemap" = true}, priority=1)
	 */
	public function landingBlockchain()
	{
		return $this->render('home/landing_blockchain.html.twig', [
		]);
	}

	/**
	 * @Route("/{_locale<%app.supported_locales%>}/create-blockchain-app", name="landing_blockchain_intl",  options={"sitemap" = true}, priority=1)
	 */
	public function landingBlockchainIntl()
	{
		return $this->render('home/landing_blockchain.html.twig', [
		]);
	}


	/**
	 * @Route("/politique-confidentialite", name="polique",  options={"sitemap" = {"priority" = 0.7 }}, priority=1)
	 */
	public function politique()
	{
		return $this->render('home/politique.html.twig', [
		]);
	}


	/**
	 * @Route("/conditions-generales", name="conditions",  options={"sitemap" = {"priority" = 0.7 }}, priority=1)
	 */
	public function conditions()
	{
		return $this->render('home/conditions.html.twig', [
		]);
	}

	/**
	 * @Route("/creation-refonte-site-web-symfony-lp", name="symfony",  options={"sitemap" = true}, priority=1)
	 */
	public function symfony()
	{
		return $this->render('home/landing_symfony.html.twig', [
		]);
	}

	/**
	 * @Route("/confirm", name="confirm")
	 */
	public function confirm()
	{
		return $this->render('home/confirm.html.twig', [
		]);
	}


//    /**
//     * @Route("/{_locale<%app.supported_locales%>}/homepage-creation", name="newlandingpage",  options={"sitemap" = true}, priority=1)
//     */
//    public function newLandingPage()
//    {
//        return $this->render('home/newLandingPage.html.twig', [
//        ]);
//    }


    /**
     * @Route("/{_locale<%app.supported_locales%>}/portfolio", name="portfolio",  options={"sitemap" = true}, priority=1)
     */
    public function portfolio(Request $request, ProjectRepository $projectRepository, CategoryRepository $categoryRepository)
    {
	    $projects = $projectRepository->findAllOrderedByPriority($request -> getLocale());

	    $categories = $categoryRepository->findAll();
		$categoriesWithTechnos = [];

		foreach ($categories as $cat) {
			$nbProjects = count($cat->getProjects());
			$listTechnologies = [];
			foreach ($cat->getProjects() as $project ) {
				foreach($project->getTechnology() as $techno){

					$techno = ucfirst(strtolower($techno));

					if (!in_array($techno, $listTechnologies)) {
						array_push($listTechnologies, $techno);
					}
				}
			}
			$nbProjectByTechno = [];
			foreach ($listTechnologies as $techno ) {
				$nbProj = 0;
				foreach ($cat->getProjects() as $project) {
					foreach ($project->getTechnology() as $technoProject) {
						if (ucfirst(strtolower($technoProject)) == ucfirst(strtolower($techno))) {
							$nbProj = $nbProj + 1;
						}
					}
				}
				$objectTmp = (object) ["techno" => ucfirst(strtolower($techno)), "nbProjects" => $nbProj];
				array_push($nbProjectByTechno, $objectTmp);
			}

			$object = (object) ["cat" => $cat, "nbProjects" => $nbProjects, "technologies" => $nbProjectByTechno];
			array_push($categoriesWithTechnos, $object);
		}

        return $this->render('homeNew/portfolio.html.twig', [
            "projects" => $projects,
	        'categories' => $categories,
			"categoriesWithTechnos" => $categoriesWithTechnos
        ]);
    }

    // /**
    //  * @Route("/{_locale<%app.supported_locales%>}/portfolio/{slug}", name="portfolio_detail",  options={"sitemap" = true}, priority=1)
    //  */
    // public function portfolio_detail(Project $project)
    // {
    //     return $this->render('home/portfolio_detail.html.twig', [
	// 		'project' => $project
    //     ]);
    // }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/blockchain", name="blockchain",  options={"sitemap" = true}, priority=1)
     */
	public function blockchain(Request $request): Response
	{
		$hongKong = false;
		if($request->getLocale() === 'en'){
			$access_token = '06c0daa024478b';
			$client = new IPinfo($access_token);
			$ip_address = $request->getClientIp();
			$details = $client->getDetails($ip_address);

			if(isset($details->country) && $details->country  == 'HK') {
				$hongKong = true;
			}
		}

		return $this->render('home/blockchain.html.twig', [
			'hongKong' => $hongKong
		]);
	}

	/**
     * @Route("/{_locale<%app.supported_locales%>}/smart-contracts", name="smart-contracts",  options={"sitemap" = true}, priority=1)
     */
	public function smartContracts(Request $request): Response
	{
		$hongKong = false;
		if($request->getLocale() === 'en'){
			$access_token = '06c0daa024478b';
			$client = new IPinfo($access_token);
			$ip_address = $request->getClientIp();
			$details = $client->getDetails($ip_address);

			if(isset($details->country) && $details->country  == 'HK') {
				$hongKong = true;
			}
		}

		return $this->render('home/blockchain_variants/templates/smart_contracts.html.twig', [
			'hongKong' => $hongKong
		]);
	}

	/**
     * @Route("/{_locale<%app.supported_locales%>}/d-apps", name="d-apps",  options={"sitemap" = true}, priority=1)
     */
	public function dApps(Request $request): Response
	{
		$hongKong = false;
		if($request->getLocale() === 'en'){
			$access_token = '06c0daa024478b';
			$client = new IPinfo($access_token);
			$ip_address = $request->getClientIp();
			$details = $client->getDetails($ip_address);

			if(isset($details->country) && $details->country  == 'HK') {
				$hongKong = true;
			}
		}

		return $this->render('home/blockchain_variants/templates/d_apps.html.twig', [
			'hongKong' => $hongKong
		]);
	}

	/**
		 * @Route("/{_locale<%app.supported_locales%>}/marketplace-nft", name="marketplace-nft",  options={"sitemap" = true}, priority=1)
		 */
		public function marketplaceNft(Request $request): Response
		{
			$hongKong = false;
			if($request->getLocale() === 'en'){
				$access_token = '06c0daa024478b';
				$client = new IPinfo($access_token);
				$ip_address = $request->getClientIp();
				$details = $client->getDetails($ip_address);

				if(isset($details->country) && $details->country  == 'HK') {
					$hongKong = true;
				}
			}

			return $this->render('home/blockchain_variants/templates/marketplace_nft.html.twig', [
				'hongKong' => $hongKong
			]);
		}

	/**
		 * @Route("/{_locale<%app.supported_locales%>}/play-earn", name="play-earn",  options={"sitemap" = true}, priority=1)
		 */
		public function playEarn(Request $request): Response
		{
			$hongKong = false;
			if($request->getLocale() === 'en'){
				$access_token = '06c0daa024478b';
				$client = new IPinfo($access_token);
				$ip_address = $request->getClientIp();
				$details = $client->getDetails($ip_address);

				if(isset($details->country) && $details->country  == 'HK') {
					$hongKong = true;
				}
			}

			return $this->render('home/blockchain_variants/templates/play_earn.html.twig', [
				'hongKong' => $hongKong
			]);
		}

	/**
		 * @Route("/{_locale<%app.supported_locales%>}/metavers", name="metavers",  options={"sitemap" = true}, priority=1)
		 */
		public function metavers(Request $request): Response
		{
			$hongKong = false;
			if($request->getLocale() === 'en'){
				$access_token = '06c0daa024478b';
				$client = new IPinfo($access_token);
				$ip_address = $request->getClientIp();
				$details = $client->getDetails($ip_address);

				if(isset($details->country) && $details->country  == 'HK') {
					$hongKong = true;
				}
			}

			return $this->render('home/blockchain_variants/templates/metavers.html.twig', [
				'hongKong' => $hongKong
			]);
		}

	/**
		 * @Route("/{_locale<%app.supported_locales%>}/data-security-traceability", name="data-security-traceability",  options={"sitemap" = true}, priority=1)
		 */
		public function dataSecurityTraceability(Request $request): Response
		{
			$hongKong = false;
			if($request->getLocale() === 'en'){
				$access_token = '06c0daa024478b';
				$client = new IPinfo($access_token);
				$ip_address = $request->getClientIp();
				$details = $client->getDetails($ip_address);

				if(isset($details->country) && $details->country  == 'HK') {
					$hongKong = true;
				}
			}

			return $this->render('home/blockchain_variants/templates/data_security_traceability.html.twig', [
				'hongKong' => $hongKong
			]);
		}

		/**
     * @Route("/{_locale<%app.supported_locales%>}/la-blockchain", name="la-blockchain",  options={"sitemap" = true}, priority=1)
     */
    public function laBlockchain()
    {
        return $this->render('home/la_blockchain.html.twig', [
		]);
    }

		/**
     * @Route("/{_locale<%app.supported_locales%>}/react", name="react",  options={"sitemap" = true}, priority=1)
     */
    public function react()
    {
        return $this->render('home/react.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/flutter", name="flutter",  options={"sitemap" = true}, priority=1)
     */
    public function flutter()
    {
        return $this->render('home/flutter.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/vue", name="vue",  options={"sitemap" = true}, priority=1)
     */
    public function vue()
    {
        return $this->render('home/vue.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/symfony", name="symfony",  options={"sitemap" = true}, priority=1)
     */
    public function newsymfony()
    {
        return $this->render('home/symfony.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/thank-you", name="thank-you",  options={"sitemap" = true}, priority=1)
     */
    public function thankYou()
    {
        return $this->render('home/thank_you.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/sitemap", name="sitemap",  options={"sitemap" = true}, priority=1)
     */
    public function sitemap()
    {
        return $this->render('home/sitemap.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/magento", name="magento",  options={"sitemap" = true}, priority=1)
     */
    public function magento()
    {
        return $this->render('home/magento.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/prestashop", name="prestashop",  options={"sitemap" = true}, priority=1)
     */
    public function prestashop()
    {
        return $this->render('home/prestashop.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/cms", name="cms",  options={"sitemap" = true}, priority=1)
     */
    public function cms()
    {
        return $this->render('home/cms_page.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/form-contact", name="form-contact",  options={"sitemap" = true}, priority=1)
     */
    public function formContact(Request $request)
    {
		if($request->isMethod(Request::METHOD_POST)){
			if(!$this->handleForm($request)){
				return $this->render('form_contact/index.html.twig', [
					'error'=> true
				]);
			};
			//OK
			return $this->redirectToRoute('thank-you');
		}

        return $this->render('form_contact/index.html.twig', []);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/form-contact/blockchain", name="form-contact/blockchain",  options={"sitemap" = true}, priority=1)
     */
    public function formContactBlockchain(Request $request)
    {
	    if($request->isMethod(Request::METHOD_POST)){
		    if(!$this->handleForm($request)){
			    return $this->render('form_contact/index.html.twig', [
				    'error'=> true
			    ]);
		    };
		    //OK
		    return $this->redirectToRoute('thank-you');
	    }

        return $this->render('form_contact/index.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/form-contact/react", name="form-contact/react",  options={"sitemap" = true}, priority=1)
     */
    public function formContactReact(Request $request)
    {
	    if($request->isMethod(Request::METHOD_POST)){
		    if(!$this->handleForm($request)){
			    return $this->render('form_contact/index.html.twig', [
				    'error'=> true
			    ]);
		    };
		    //OK
		    return $this->redirectToRoute('thank-you');
	    }

        return $this->render('form_contact/index.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/form-contact/vue", name="form-contact/vue",  options={"sitemap" = true}, priority=1)
     */
    public function formContactVue(Request $request)
    {
	    if($request->isMethod(Request::METHOD_POST)){
		    if(!$this->handleForm($request)){
			    return $this->render('form_contact/index.html.twig', [
				    'error'=> true
			    ]);
		    };
		    //OK
		    return $this->redirectToRoute('thank-you');
	    }

        return $this->render('form_contact/index.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/form-contact/flutter", name="form-contact/flutter",  options={"sitemap" = true}, priority=1)
     */
    public function formContactFlutter(Request $request)
    {
	    if($request->isMethod(Request::METHOD_POST)){
		    if(!$this->handleForm($request)){
			    return $this->render('form_contact/index.html.twig', [
				    'error'=> true
			    ]);
		    };
		    //OK
		    return $this->redirectToRoute('thank-you');
	    }

        return $this->render('form_contact/index.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/form-contact/symfony", name="form-contact/symfony",  options={"sitemap" = true}, priority=1)
     */
    public function formContactSymfony(Request $request)
    {
	    if($request->isMethod(Request::METHOD_POST)){
		    if(!$this->handleForm($request)){
			    return $this->render('form_contact/index.html.twig', [
				    'error'=> true
			    ]);
		    };
		    //OK
		    return $this->redirectToRoute('thank-you');
	    }

        return $this->render('form_contact/index.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/form-contact/magento", name="form-contact/magento",  options={"sitemap" = true}, priority=1)
     */
    public function formContactMagento(Request $request)
    {
	    if($request->isMethod(Request::METHOD_POST)){
		    if(!$this->handleForm($request)){
			    return $this->render('form_contact/index.html.twig', [
				    'error'=> true
			    ]);
		    };
		    //OK
		    return $this->redirectToRoute('thank-you');
	    }

        return $this->render('form_contact/index.html.twig', [
		]);
    }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/form-contact/prestashop", name="form-contact/prestashop",  options={"sitemap" = true}, priority=1)
     */
    public function formContactPrestashop(Request $request)
    {
	    if($request->isMethod(Request::METHOD_POST)){
		    if(!$this->handleForm($request)){
			    return $this->render('form_contact/index.html.twig', [
				    'error'=> true
			    ]);
		    };

		    return $this->redirectToRoute('thank-you');
	    }

        return $this->render('form_contact/index.html.twig', [
		]);
    }
	/**
     * @Route("/{_locale<%app.supported_locales%>}/form-contact/cms", name="form-contact/cms",  options={"sitemap" = true}, priority=1)
     */
    public function formContactCms(Request $request)
    {
	    if($request->isMethod(Request::METHOD_POST)){
		    if(!$this->handleForm($request)){
			    return $this->render('form_contact/index.html.twig', [
				    'error'=> true
			    ]);
		    };

		    return $this->redirectToRoute('thank-you');
	    }

        return $this->render('form_contact/index.html.twig', [
		]);
    }

	// /**
    //  * @Route("/{_locale<%app.supported_locales%>}/portfolio/{slug}", name="portfolio_project_detail", priority=1)
    //  */
    // public function portfolioProjectDetail(ProjectRepository $projectRepository, CategoryRepository $categoryRepository)
    // {
	// 	$projects = $projectRepository->findAll();
	//     $categories = $categoryRepository->findAll();

    //     return $this->render('home/portfolio_project_detail.html.twig', [
	// 		"projects" => $projects,
	//         "categories" => $categories,
	// 	]);
    // }

	/**
     * @Route("/{_locale<%app.supported_locales%>}/portfolio/{slug}", name="app_portfolio_detail", priority=1)
     */
    public function portfolio_detail(Project $project)
    {
        return $this->render('portfolio/project/index.html.twig', [
			'project' => $project
        ]);
    }

	/**
	 * @Route("/{_locale<%app.supported_locales%>}/newsletter", name="app_newsletter", priority=10)
	 */
	public function newletter()
	{
		return $this->render('home/empty.html.twig', [
		]);
	}

	/**
     * @Route("/{_locale<%app.supported_locales%>}/contact", name="contact",  options={"sitemap" = true}, priority=1)
     */
    public function contact(Request $request)
    {

	    $firstname = $request->request->get('firstname');
	    $lastname = $request->request->get('lastname');
	    $email = $request->request->get('email');
		$phone =   $request->request->get('tel-number');
	    $type = $request->request->get('type');
	    $entreprise = $request->request->get('enterprise');
	    $message = $request->request->get('description');
	    $token = $request->request->get('token');

	    if($request->isMethod(Request::METHOD_POST)) {

		    $conversion = 	new Conversion();
		    $conversion->setName($firstname. ' ' . $lastname);
		    $conversion->setEmail($email);
		    $conversion->setSubject($type);
		    $conversion->setMesssage($message);
			$conversion->setPhone($phone);
		    $conversion->setCompany($entreprise);


		    $this->em->persist($conversion);
		    $this->em->flush();

		    $email = (new TemplatedEmail())
			    ->from('team@kodkodkod.studio')
			    ->to(new Address('maxtor3569@gmail.com'), new Address('morgan@kodkodkod.studio'))
			    //->cc('cc@example.com')
			    //->bcc('bcc@example.com')
			    //->replyTo('fabien@example.com')
			    ->priority(Email::PRIORITY_HIGH)
			    ->subject('Nouvelle demande')
			    //->text('Sending emails is fun again!')
			    ->htmlTemplate('emails/devisForm.html.twig')
			    ->context([
				    'firstname' => $firstname. ' ' . $lastname,
					'phone' => $phone,
				    'emailClient' => $email,
				    'entreprise' => $entreprise,
				    'message' => $message,
				    'type' => $type
			    ]);


		    try {
			    $this->mailer->send($email);
		    } catch (\Exception $e) {
			    $this->logger->error($e->getMessage());
			    return $this->redirectToRoute('contact');

		    } catch (TransportExceptionInterface $e) {
			    $this->logger->error($e->getMessage());
			    return $this->redirectToRoute('contact');
		    }

		    return $this->redirectToRoute('thank-you');

	    }


        return $this->render('contact/index.html.twig');
    }



	#[Route('/logout', name: 'app_logout', methods: ['GET'])]
	public function logout()
	{
		// controller can be blank: it will never be called!
		throw new \Exception('Don\'t forget to activate logout in security.yaml');

	}

	#[Route('/footer-contact', name: 'app_contact_footer')]
    public function footerForm(Request $request) : JsonResponse
    {
        $firstname = $request->request->get('firstName');
        $email = $request->request->get('email');
        $message = $request->request->get('message');

		$customMessage = '';
		$currentLanguage = $this->detectLanguageFromUrl($request);
		switch ($currentLanguage) {
			case 'en':
				$customMessage = 'Thank you! Your message has been sent successfully. We will get back to you shortly.';
				break;
			case 'fr':
				$customMessage = 'Merci! Votre message a été envoyé avec succès. Nous vous répondrons sous peu.';
				break;
			case 'kor':
				$customMessage = '감사합니다! 메시지가 성공적으로 전송되었습니다. 곧 답변 드리겠습니다.';
				break;
			default:
				$customMessage = 'Thank you! Your message has been sent successfully. We will get back to you shortly.';
				break;
		}
        if($request->isMethod(Request::METHOD_POST)) {


            $conversion = 	new Conversion();
            $conversion->setName($firstname);
            $conversion->setEmail($email);
            $conversion->setMesssage($message);

            $this->em->persist($conversion);
            $this->em->flush();

            $email = (new TemplatedEmail())
                ->from('team@kodkodkod.studio')
                ->to(new Address('maxtor3569@gmail.com'), new Address('morgan@kodkodkod.studio'))
                ->priority(Email::PRIORITY_HIGH)
                ->subject('Nouvelle demande')
                ->htmlTemplate('emails/devisFooterForm.html.twig')
                ->context([
                    'firstname' => $firstname,
                    'emailClient' => $email,
                    'message' => $message,
                ]);
				$this->mailer->send($email);
            try {
                $this->mailer->send($email);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                return new JsonResponse(['message' => $customMessage], 500);

            } catch (TransportExceptionInterface $e) {
                $this->logger->error($e->getMessage());
                return new JsonResponse(['message' => $customMessage], 500);
            }

            return new JsonResponse(['message' => $customMessage], 200);

        }
        return new JsonResponse(['message' => $customMessage], 200);
    }

	private function detectLanguageFromUrl(Request $request): string
    {
        $pathInfo = $request->getPathInfo();
        $segments = explode('/', $pathInfo);
        return isset($segments[1]) ? $segments[1] : 'fr';
    }
}
