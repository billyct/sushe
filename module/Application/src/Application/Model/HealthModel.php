<?php

namespace Application\Model;

use User\Lib\EntitySerializer;

class HealthModel extends AbstractModel {
	public function insert($health) {
		$m = $this->getEntityManager();
		$m->persist($health);
		$m->flush($health);
		
		return $this->toArray($health);
		
	}
	
	public function update($health) {
		$m = $this->getEntityManager();
		$m->flush();
		return $this->toArray($health);
	}
	
	public function toArray($health) {
		$m = $this->getEntityManager();
		$entitySer = new EntitySerializer($m);
		if ($health != null ){
			
			$room = $health->getRoom();
			$room = array(
					'id' => $room->getId(),
					'name' => $room->getName()
					);
			$health = $entitySer->toArray($health);
			$health['room'] = $room;
		}
		
		return $health;
	}
	
	public function getById($id) {
		$m = $this->getEntityManager();
		$health = $m->find('Application\Entity\Health', $id);
		return $health;
	}
	
	public function getArrayById($id){
		$health = $this->getById($id);
		return $this->toArray($health);
	}
	
	public function getList() {
		$m = $this->getEntityManager();
		$healths = $m->getRepository('Application\Entity\Health')->findAll();
		
		$healthsArray = array();
		foreach ($healths as $health) {
			$healthsArray[] = $this->toArray($health);
		}
		return $healthsArray;
	}
	
	public function getBy($condition) {
		$m = $this->getEntityManager();
		$health = $m->getRepository('Application\Entity\Health')->findOneBy($condition);
		return $health;
	}
	
	public function getsBy($condition) {
		$m = $this->getEntityManager();
		$healths = $m->getRepository('Application\Entity\Health')->findBy($condition);
		return $healths;
	}
	
	public function getsArrayBy($condition) {
		$healths = $this->getsBy($condition);
		$healthsArray = array();
		foreach ($healths as $health) {
			$healthsArray[] = $this->toArray($health);
		}
		return $healthsArray;
	}
}

?>