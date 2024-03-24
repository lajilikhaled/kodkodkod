<?php
namespace App\Traits;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

trait LoggerTrait {

	protected LoggerInterface $logger;

	public function setLogger(LoggerInterface $logger) {
		$this->logger = $logger;
	}

}
