<?php
namespace App\Traits;

use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;

trait BlogRepositoryTrait {

	protected BlogRepository $blogRepository;

	/**
	 * @required
	 */
	public function setBlogRepository(BlogRepository $blogRepository) {
		$this->blogRepository = $blogRepository;
	}

}
