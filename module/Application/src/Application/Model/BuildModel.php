<?php

namespace Application\Model;

use Doctrine\Common\Collections\ArrayCollection;

use User\Lib\Role;

use Doctrine\ORM\Tools\Pagination\Paginator;

use User\Lib\EntitySerializer;

class BuildModel extends AbstractModel {
	
	public function insert($build) {
		$m = $this->getEntityManager();
		$m->persist($build);
		$m->flush();
		$build = $this->toArray($build);
		return $build;
	}
	
	public function update($build) {
		$m = $this->getEntityManager();
		$m->flush();
		$build = $this->toArray($build);
		return $build;
	}
	
	public function toArray($build) {
		$m = $this->getEntityManager();
		$entitySer = new EntitySerializer($m);
		if ($build != null) {
			$park = $build->getPark();
			$park = array(
					'name' => $park->getName(),
					'id' => $park->getId()
					);
			//$park = $entitySer->toArray($park);
			
			$user = $build->getUser();
			$user = array(
					'username' => $user->getUsername(),
					'id' => $user->getId(),
					);
			
			$build = $entitySer->toArray($build);
			$build['park'] = $park;
			$build['user'] = $user;
		}
		
		return $build;
	}
	
	public function getById($id) {
		$m = $this->getEntityManager();
		$build = $m->find('Application\Entity\Build', $id);
		return $build;
	}
	
	public function getArrayById($id) {
		$build = $this->getById($id);
		$build = $this->toArray($build);
		return $build;
	}
	
	public function getList($count, $page) {
		$m = $this->getEntityManager();
		$qb = $m->createQueryBuilder();
		
		$first = $count*($page-1);
		$max = $count*$page;
		
		
		$query = $qb->select(array('build'))
				->where('Application\Entity\Build build')
				->orderBy('build.create_at','ASC')
				->setFirstResult($first)
				->setMaxResults($max);
		
		$paginator = new Paginator($query, $fetchJoinCollection = true);
		
		$builds = array();
		foreach ($paginator as $build) {
			$builds[] = $this->toArray($build);
		}
		
		return $builds;
	}
	
	public function getBy($field, $value) {
		$m = $this->getEntityManager();
		$builds = $m->getRepository('Application\Entity\Build')->findBy(array(
					$field => $value
				));
		$buildArray = array();
		
		foreach ($builds as $build) {
			$buildArray[] = $this->toArray($build);
		}
		return $buildArray;
	}
	

	
	
	
}

?>