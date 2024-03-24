<?php

namespace App\Traits;

use App\Repository\BlogRepository;
use App\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;

trait PageRepositoryTrait {

	protected PageRepository $pageRepository;

	/**
	 * @required
	 */
	public function setPageRepository(PageRepository $pageRepository) {
		$this->pageRepository = $pageRepository;
	}

}
