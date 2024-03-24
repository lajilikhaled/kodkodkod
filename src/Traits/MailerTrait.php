<?php
namespace App\Traits;

use Symfony\Component\Mailer\MailerInterface;

trait MailerTrait {

	protected MailerInterface $mailer;

	public function setMailer(MailerInterface $mailer) {
		$this->mailer = $mailer;
	}

}
