<?php

namespace Application\Controller;

use Application\Exception\StudentException;

use Zend\View\Model\JsonModel;

use Application\Entity\Repair;

class RepairRESTController extends AbstractUsefulRESTController {
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::create()
	 */
	public function create($data) {
		// TODO Auto-generated method stub
		$problem = $data['problem'];
		$time_rest = $data['time_rest'];
		
		$time_rest = new \DateTime($time_rest);
		$time_rest = $time_rest->getTimestamp();
		
		$studentModel = $this->getServiceLocator()->get('StudentModel');
		$student = $studentModel->getBy(array('user' => $this->current_user));
		if ($student == null){
			throw new StudentException('你不是学生！');
		}
		$room = $student->getRoom();
		
		$repair = new Repair();
		$repair->setProblem($problem)
				->setTime_rest($time_rest)
				->setUser($this->current_user)
				->setStudent($student)
				->setRoom($room);
		
		$repairModel = $this->getServiceLocator()->get('RepairModel');
		$repair = $repairModel->insert($repair);
		
		return new JsonModel($repair);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::delete()
	 */
	public function delete($id) {
		// TODO Auto-generated method stub
	}
	
	/*
	 * (non-PHPdoc) @see \Zend\Mvc\Controller\AbstractRestfulController::get()
	 */
	public function get($id) {
		// TODO Auto-generated method stub
		$repairModel = $this->getServiceLocator()->get('RepairModel');
		$repair = $repairModel->getArrayById($id);
		return new JsonModel($repair);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::getList()
	 */
	public function getList() {
		// TODO Auto-generated method stub
		$repairModel = $this->getServiceLocator()->get('RepairModel');
		$repairs = $repairModel->getList();
		
		return new JsonModel($repairs);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::update()
	 */
	public function update($id, $data) {
		// TODO Auto-generated method stub
		
// 		$problem = $data['problem'];
// 		$time_rest = $data['time_rest'];
		$user_handle = $this->current_user;
		$feedback = $data['feedback'];
		$status = $data['status'];
		
		$repairModel = $this->getServiceLocator()->get('RepairModel');
		$repair = $repairModel->getById($id);
		
		$repair->setUser_handle($user_handle)
				->setFeedback($feedback)
				->setStatus($status);
		
		$repair = $repairModel->update($repair);
		return new JsonModel($repair);
		
		
	}
}

?>