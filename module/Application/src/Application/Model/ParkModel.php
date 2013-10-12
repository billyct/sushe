<?php

namespace Application\Model;

use Doctrine\ORM\Tools\Pagination\Paginator;

use User\Lib\EntitySerializer;

class ParkModel extends AbstractModel {
	public function insert($park) {
		$m = $this->getEntityManager();
		$m->persist($park);
		$m->flush();
		return $park;
	}
	
	public function update($park) {
		$m = $this->getEntityManager();
		$m->flush();
		return $park;
	}
	
	public function toArray($park) {
		$m = $this->getEntityManager();
		$entitySer = new EntitySerializer($m);
		if ($park != null) {
			$user = $park->getUser();
			$user = $entitySer->toArray($user);
			$park = $entitySer->toArray($park);
			$park['user'] = $user;	
		}
		
		return $park;
	}
	
	public function getById($id) {
		$m = $this->getEntityManager();
		$park = $m->find('Application\Entity\Park', $id);
		return $park;
	}
	
	public function getArrayById($id) {
		$park = $this->getById($id);
		$park = $this->toArray($park);
		return $park;
	}
	
	public function getList($count, $page) {
		$m = $this->getEntityManager();
		$qb = $m->createQueryBuilder();
		
		$first = $count*($page-1);
		$max = $count*$page;
		
		
		$query = $qb->select(array('park'))
					->where('Application\Entity\Park park')
					->orderBy('park.create_at','ASC')
					->setFirstResult($first)
					->setMaxResults($max);
		
		$paginator = new Paginator($query, $fetchJoinCollection = true);
		
		$parks = array();
		foreach ($paginator as $park) {
			$parks[] = $this->toArray($park);
		}
		
		return $parks;
	}
}

?>