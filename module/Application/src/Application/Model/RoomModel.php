<?php

namespace Application\Model;

use User\Lib\EntitySerializer;

class RoomModel extends AbstractModel {
	
	public function insert($room) {
		$m = $this->getEntityManager();
		$m->persist($room);
		$m->flush();
		
		return $room;
	}
	public function getBy(array $conditions) {
		$m = $this->getEntityManager();
		$room = $m->getRepository('Application\Entity\Room')->findOneBy($conditions);
		return $room;
	}
	
	public function getById($id) {
		$m = $this->getEntityManager();
		$room = $m->find('Application\Entity\Room', $id);
		return $room;
	}
	
	public function toArray($room) {
		$m = $this->getEntityManager();
		$entitySer = new EntitySerializer($m);
		if ($room != null) {
			$room = $entitySer->toArray($room);
		}
		
		return $room;
	}
}

?>