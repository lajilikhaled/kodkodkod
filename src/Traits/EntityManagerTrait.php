<?php
namespace App\Traits;

use Doctrine\ORM\EntityManagerInterface;

trait EntityManagerTrait {

	protected EntityManagerInterface $em;

	/**
	 * @required
	 */
	public function setEntityManager(EntityManagerInterface $entityManager) {
		$this->em = $entityManager;
	}

}
