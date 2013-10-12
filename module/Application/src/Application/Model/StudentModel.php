<?php

namespace Application\Model;

use User\Lib\EntitySerializer;

class StudentModel extends AbstractModel {
	public function insert($student) {
		$m = $this->getEntityManager();
		$m->persist($student);
		$m->flush();
		$student = $this->toArray($student);
		return $student;
	}
	
	public function update($student) {
		$m = $this->getEntityManager();
		$m->flush();
		$student = $this->toArray($student);
		return $student;
	}
	
	public function toArray($student) {
		$m = $this->getEntityManager();
		$entitySer = new EntitySerializer($m);
		if ($student != null) {
			$room = $student->getRoom();
			$room = array(
					'id' => $room->getId(),
					'name' => $room->getName()
					);
			$student = $entitySer->toArray($student);
			$student['room'] = $room;
		}
		
		return $student;
	}
	
	public function getList($user) {
		$m = $this->getEntityManager();
		$builds = $m->getRepository('Application\Entity\Build')->findBy(array(
				'user' => $user
		));
	
		$students = array();
		foreach ($builds as $build) {
			foreach ($build->getRooms() as $room) {
				foreach ($room->getStudents() as $student){
					$students[] = $this->toArray($student);
				}
			}
		}
		
		return $students;
	}
	
	public function getById($id) {
		$m = $this->getEntityManager();
		$student = $m->find('Application\Entity\Student', $id);
		return $student;
	}
	
	public function getArrayById($id) {
		$student = $this->getById($id);
		$student = $this->toArray($student);
		return $student;
		
	}
	
	public function getBy($condition) {
		$m = $this->getEntityManager();
		$student = $m->getRepository('Application\Entity\Student')->findOneBy($condition);
		return $student;
	}
	
	public function getArrayBy($condition) {
		$student = $this->getBy($condition);
		return $this->toArray($student);
	}
}

?>