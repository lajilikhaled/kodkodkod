<?php
namespace App\Traits;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\MailerInterface;

trait MailerTrait {

	protected MailerInterface $mailer;

	/**
	 * @required
	 */
	public function setMailer(MailerInterface $mailer) {
		$this->mailer = $mailer;
	}

}
