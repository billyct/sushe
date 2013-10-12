<?php

namespace Application\Controller;

use Application\Exception\RoomException;

use Zend\View\Model\JsonModel;

use Application\Entity\ElectricBill;

class ElectricRESTController extends AbstractUsefulRESTController {
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::create()
	 */
	public function create($data) {
		// TODO Auto-generated method stub
		$roomname = $data['room'];
		$degree_last = $data['degree_last'];
		$degree_current = $data['degree_current'];
		$degree_pay = $data['degree_pay'];
		$price_per = $data['price_per'];
		$dead_line = $data['dead_line'];
		$create_at = $data['create_at'];
		$create_at = new \DateTime($create_at);
		$create_at = $create_at->getTimestamp();
		
		$roomModel = $this->getServiceLocator()->get('RoomModel');
		$room = $roomModel->getBy(array('name' => $roomname));
		if ($room == null) {
			throw new RoomException('没有该寝室');
		}
		
		$electric = new ElectricBill();
		
		$electric->setRoom($room)
					->setDead_line(new \DateTime($dead_line))
					->setDegree_current($degree_current)
					->setDegree_last($degree_last)
					->setDegree_pay($degree_pay)
					->setPrice_per($price_per)
					->setCreate_at($create_at);
		
		$electricModel = $this->getServiceLocator()->get('ElectricModel');
		$electric = $electricModel->insert($electric);
		return new JsonModel($electric);
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
		$electricModel = $this->getServiceLocator()->get('ElectricModel');
		$electric = $electricModel->getArrayById($id);
		return new JsonModel($electric);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::getList()
	 */
	public function getList() {
		// TODO Auto-generated method stub
		$electricModel = $this->getServiceLocator()->get('ElectricModel');
		$electrics = $electricModel->getList();
		return new JsonModel($electrics);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::update()
	 */
	public function update($id, $data) {
		// TODO Auto-generated method stub
		
		$roomname = $data['room'];
		$degree_last = $data['degree_last'];
		$degree_current = $data['degree_current'];
		$degree_pay = $data['degree_pay'];
		$price_per = $data['price_per'];
		$dead_line = $data['dead_line'];
		$create_at = $data['create_at'];
		
		$create_at = new \DateTime($create_at);
		$create_at = $create_at->getTimestamp();
		
		$roomModel = $this->getServiceLocator()->get('RoomModel');
		$room = $roomModel->getBy(array('name' => $roomname));
		if ($room == null) {
			throw new RoomException('没有该寝室');
		}
		
		$electricModel = $this->getServiceLocator()->get('ElectricModel');
		$electric = $electricModel->getById($id);
		
		$electric->setRoom($room)
				->setDead_line(new \DateTime($dead_line))
				->setDegree_current($degree_current)
				->setDegree_last($degree_last)
				->setDegree_pay($degree_pay)
				->setPrice_per($price_per)
				->setCreate_at($create_at);

		$electric = $electricModel->insert($electric);
		return new JsonModel($electric);
	}
}

?>