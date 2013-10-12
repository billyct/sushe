<?php

namespace Application\Model;

use User\Lib\EntitySerializer;

class ElectricModel extends AbstractModel {
	public function insert($electric) {
		$m = $this->getEntityManager();
		$m->persist($electric);
		$m->flush();
		$electric = $this->toArray($electric);
		return $electric;
	}
	
	public function update($electric) {
		$m = $this->getEntityManager();
		$m->flush();
		$electric = $this->toArray($electric);
		return $electric;
	}
	
	public function getById($id) {
		$m = $this->getEntityManager();
		$electric = $m->find('Application\Entity\ElectricBill', $id);
		return $electric;
	}
	
	public function getArrayById($id) {
		$electric = $this->getById($id);
		return $this->toArray($electric);
	}
	
	public function toArray($electric) {
		$m = $this->getEntityManager();
		$entitySer = new EntitySerializer($m);
		
		if ($electric != null) {
			
			$room = $electric->getRoom();
			$build = $room->getBuild();
			$build = array(
					'id' => $build->getId(),
					'name' => $build->getName()
					);
			$room = array(
					'id' => $room->getId(),
					'name' => $room->getName()
					);
			
			$electric = $entitySer->toArray($electric);
			$electric['room'] = $room;
			$electric['build'] = $build;
		}
		
		return $electric;
	}
	
	public function getList() {
		$m = $this->getEntityManager();
		$electrics = $m->getRepository('Application\Entity\ElectricBill')->findAll();
		$electricsArray = array();
		foreach ($electrics as $electric) {
			$electricsArray[] = $this->toArray($electric);
		}
		
		return $electricsArray;
	}
	
	public function getBy($condition) {
		$m = $this->getEntityManager();
		$electric = $m->getRepository('Application\Entity\ElectricBill')->findOneBy($condition);
		return $electric;
	}
	
	public function getArrayBy($condition) {
		$electric = $this->getBy($condition);
		return $this->toArray($electric);
	}
}

?>