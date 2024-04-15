<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class SpamChecker
{
	private $client;
	private $endpoint;

	public function __construct(HttpClientInterface $client, string $akismetKey)
	{
		$this->client = $client;
		$this->endpoint = sprintf('https://%s.rest.akismet.com/1.1/comment-check', $akismetKey);
	}

	/**
	 * @return int Spam score: 0: not spam, 1: maybe spam, 2: blatant spam
	 *
	 * @throws \RuntimeException if the call did not work
	 */
	public function getSpamScore($email, $name, $subject, $message, array $context): int
	{

//		$context = [
//			'user_ip' => $request->getClientIp(),
//			'user_agent' => $request->headers->get('user-agent'),
//			'referrer' => $request->headers->get('referer'),
//			'permalink' => $request->getUri(),
//		];


		$response = $this->client->request('POST', $this->endpoint, [
			'body' => array_merge($context, [
				'blog' => 'https://kodkodkod.studio',
				'comment_type' => 'contact-form',
				'comment_author' => $name,
				'comment_author_email' => $email,
				'comment_content' => $message,
				'comment_date_gmt' => (new \DateTime())->format('c'),
				'blog_lang' => 'fr',
				'blog_charset' => 'UTF-8',
				'is_test' => true,
			]),
		]);

		$headers = $response->getHeaders();
		if ('discard' === ($headers['x-akismet-pro-tip'][0] ?? '')) {
			return 2;
		}

		$content = $response->getContent();
		if (isset($headers['x-akismet-debug-help'][0])) {
			throw new \RuntimeException(sprintf('Unable to check for spam: %s (%s).', $content, $headers['x-akismet-debug-help'][0]));
		}

		return 'true' === $content ? 1 : 0;
	}
}
