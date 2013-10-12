<?php

namespace Application\Model;

use Doctrine\ORM\EntityManager;

class AbstractModel {
	
	protected $entityManager;
	/**
	 * @return the $entityManager
	 */
	public function getEntityManager() {
		return $this->entityManager;
	}

	/**
	 * @param field_type $entityManager
	 */
	public function setEntityManager(EntityManager $entityManager) {
		$this->entityManager = $entityManager;
	}

	
	
}

?>