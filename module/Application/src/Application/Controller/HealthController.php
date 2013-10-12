<?php

namespace Application\Controller;


use Zend\View\Model\JsonModel;

use Application\Exception\StudentException;

class HealthController extends AbstractUsefulController {
	public function getHealthsAction() {
		$r = $this->resultStatus;
		try {
			$studentModel = $this->getServiceLocator()->get('StudentModel');
			$student = $studentModel->getBy(array('user' => $this->current_user));
			if ($student == null){
				throw new StudentException('你不是学生！');
			}
			$room = $student->getRoom();
			$healthModel = $this->getServiceLocator()->get('HealthModel');
			$healths = $healthModel->getsArrayBy(array('room' => $room));
	
			return new JsonModel($healths);
		} catch (StudentException $e) {
			$r->setCM($r::FAILED, $e->getMessage());
		}
	
		return new JsonModel($r->getCM());
	}
}

?>