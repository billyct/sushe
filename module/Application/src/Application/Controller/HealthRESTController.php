<?php

namespace Application\Controller;

use Zend\View\Model\JsonModel;

use Application\Exception\RoomException;

use Application\Entity\Health;

class HealthRESTController extends AbstractUsefulRESTController {
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::create()
	 */
	public function create($data) {
		// TODO Auto-generated method stub
		$roomname = $data['room'];
		$checkdate = $data['checkdate'];
		$level = $data['level'];
		
		$roomModel = $this->getServiceLocator()->get('RoomModel');
		$room = $roomModel->getBy(array('name' => $roomname));
		if ($room == null) {
			throw new RoomException('没有该寝室');
		}
		
		$healthModel = $this->getServiceLocator()->get('HealthModel');
		
		$health = new Health();
		$health->setCheckdate(new \DateTime($checkdate))
			->setLevel($level)
			->setRoom($room);
		$health = $healthModel->insert($health);
		
		return new JsonModel($health);
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
		$healthModel = $this->getServiceLocator()->get('HealthModel');
		$health = $healthModel->getArrayById($id);
		return new JsonModel($health);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::getList()
	 */
	public function getList() {
		// TODO Auto-generated method stub
		
		$healthModel = $this->getServiceLocator()->get('HealthModel');
		$healths = $healthModel->getList();
		return new JsonModel($healths);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::update()
	 */
	public function update($id, $data) {
		// TODO Auto-generated method stub
		
		$roomname = $data['room'];
		$checkdate = $data['checkdate'];
		$level = $data['level'];
		
		$roomModel = $this->getServiceLocator()->get('RoomModel');
		$room = $roomModel->getBy(array('name' => $roomname));
		if ($room == null) {
			throw new RoomException('没有该寝室');
		}
		
		$healthModel = $this->getServiceLocator()->get('HealthModel');
		
		$health = $healthModel->getById($id);
		$health->setCheckdate(new \DateTime($checkdate))
				->setLevel($level)
				->setRoom($room);
		$health = $healthModel->update($health);
		
		return new JsonModel($health);
	}
}

?>