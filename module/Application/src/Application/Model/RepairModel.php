<?php

namespace Application\Model;


use User\Lib\EntitySerializer;

class RepairModel extends AbstractModel {
	
	public function insert($repair) {
		$m = $this->getEntityManager();
		$m->persist($repair);
		$m->flush();
		return $this->toArray($repair);
	}
	
	public function update($repair) {
		$m = $this->getEntityManager();
		$m->flush();
		return $this->toArray($repair);
	}
	
	public function toArray($repair) {
		$m = $this->getEntityManager();
		$entitySer = new EntitySerializer($m);
		if ($repair != null) {
			$user = $repair->getUser();
			if ($user != null) {
				$user = array(
						'id' => $user->getId(),
						'username' => $user->getUsername(),
						'display_name' => $user->getDisplayName(),
						);
			}
			$user_handle = $repair->getUser_handle();
			if ($user_handle != null) {
				$user_handle = array(
						'id' => $user_handle->getId(),
						'username' => $user_handle->getUsername(),
						'display_name' => $user_handle->getDisplayName(),
						);
			}
			$student = $repair->getStudent();
			if ($student != null) {
				$student = array(
						'id' => $student->getId(),
						'real_name' => $student->getReal_name(),
						'phone' => $student->getPhone(),
						);
			}
			
			$room = $repair->getRoom();
			$build = $room->getBuild();
			if ($build != null) {
				$build = array(
						'id' => $build->getId(),
						'name' => $build->getName(),
						);
			}
			if ($room != null) {
				$room = array(
						'id' => $room->getId(),
						'name' => $room->getName(),
						);
			}
			$repair = $entitySer->toArray($repair);
			$repair['user'] = $user;
			$repair['user_handle'] = $user_handle;
			$repair['student'] = $student;
			$repair['room'] = $room;
			$repair['build'] = $build;
		}
		
		return $repair;
	}
	
	public function getList() {
		$m = $this->getEntityManager();
		$repairs = $m->getRepository('Application\Entity\Repair')->findAll();
		$repairsArray = array();
		foreach ($repairs as $repair) {
			$repairsArray[] = $this->toArray($repair);
		}
	
		return $repairsArray;
	}
	
	public function getById($id) {
		$m = $this->getEntityManager();
		$repair = $m->find('Application\Entity\Repair', $id);
		return $repair;
	}
	
	public function getArrayById($id) {
		$repair = $this->getById($id);
		return $this->toArray($repair);
	}
}

?>