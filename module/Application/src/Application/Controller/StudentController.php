<?php

namespace Application\Controller;


use Zend\View\Model\JsonModel;

use Application\Exception\StudentException;

class StudentController extends AbstractUsefulController {
	public function getInfoAction() {
		$r = $this->resultStatus;
		try {
			$studentModel = $this->getServiceLocator()->get('StudentModel');
			$student = $studentModel->getArrayBy(array('user' => $this->current_user));
			if ($student == null){
				throw new StudentException('你不是学生！');
			}
	
			return new JsonModel($student);
		} catch (StudentException $e) {
			$r->setCM($r::FAILED, $e->getMessage());
		}
	
		return new JsonModel($r->getCM());
	}
}

?>