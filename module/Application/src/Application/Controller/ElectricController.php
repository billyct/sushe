<?php

namespace Application\Controller;

use Application\Exception\StudentException;

use Zend\View\Model\JsonModel;

class ElectricController extends AbstractUsefulController {
	
	public function getElectricBillAction() {
		$r = $this->resultStatus;
		try {
			$studentModel = $this->getServiceLocator()->get('StudentModel');
			$student = $studentModel->getBy(array('user' => $this->current_user));
			if ($student == null){
				throw new StudentException('你不是学生！');
			}
			$room = $student->getRoom();
			$electricModel = $this->getServiceLocator()->get('ElectricModel');
			$electric = $electricModel->getArrayBy(array('room' => $room, 'status'=>'0'));
			
			return new JsonModel($electric);
		} catch (StudentException $e) {
			$r->setCM($r::FAILED, $e->getMessage());
		}
		
		return new JsonModel($r->getCM());
	}
	
	public function payAction() {
		$r = $this->resultStatus;
		try {

			$electricModel = $this->getServiceLocator()->get('ElectricModel');
			$electric_id = $this->getRequest()->getPost('electric_id');
			$electric = $electricModel->getById($electric_id);
			$electric->setStatus(1);
			$electricModel->update($electric);
			
			return new JsonModel($r::SUCCESS, '缴费成功');
		} catch (StudentException $e) {
			$r->setCM($r::FAILED, $e->getMessage());
		}
		return new JsonModel($r->getCM());
	}
	
	

	

}

?>