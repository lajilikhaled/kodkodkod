<?php

namespace App\Services;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GoogleRecaptcha
{
	private $client;
	private $parameterBag;

	public function __construct(HttpClientInterface $client, ParameterBagInterface  $parameterBag)
	{
		$this->client = $client;
		$this->parameterBag = $parameterBag;
	}

	/**
	 * @return int Spam score: 0: not spam, 1: maybe spam, 2: blatant spam
	 *
	 * @throws \RuntimeException if the call did not work
	 */
	public function check($token)
	{
		$secret = $this->parameterBag->get('app.google_secret');
		$response = $this->client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
			'body' => [
				'secret' => $secret,
				'response' => $token
			],
		]);
		$content = $response->toArray();

		return $content;
	}
}
