<?php
// src/EventSubscriber/LocaleSubscriber.php
namespace App\EventSubscriber;

use Negotiation\LanguageNegotiator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LocaleSubscriber implements EventSubscriberInterface
{
    private $defaultLocale;

    public function __construct(string $defaultLocale = 'fr')
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
//        if (!$request->hasPreviousSession()) {
//            return;
//        }
	    $determinedLocale = null;

	    $acceptLanguage = $event->getRequest()->headers->get('Accept-Language');
	    if ($acceptLanguage != null) {
		    $negotiator = new LanguageNegotiator();
		    try {
			    $best = $negotiator->getBest($acceptLanguage, ['fr','en', 'ko']);

			    if ($best != null) {
				    $language = $best->getType();
				    $request->setLocale($language);
				    $determinedLocale = $language;
			    }
		    } catch (\Exception $e) {
			    //$this->logger->warning("Failed to determine language from Accept-Language header " . $e);
		    }
	    }
	    if($determinedLocale == null) {
		    if ($locale = $request->attributes->get('_locale')) {
			    if(in_array($locale, ['fr', 'en', 'ko'])) {
				    $request->getSession()->set('_locale', $locale);
			    } else {
				    $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
			    }
		    } else {
			    //fallback to default
			    $request->setLocale($this->defaultLocale);
		    }
	    }


    }

    public static function getSubscribedEvents()
    {
        return [
            // must be registered before (i.e. with a higher priority than) the default Locale listener
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }
}
