<?php

namespace Application\Controller;

use Application\Exception\ParkException;

use Application\Entity\Park;

use Zend\View\Model\JsonModel;


class ParkRESTController extends AbstractUsefulRESTController {
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::create()
	 */
	public function create($data) {
		// TODO Auto-generated method stub
		$resultStatus = $this->resultStatus;
		$name = $data['name'];
		$parkModel = $this->getServiceLocator()->get('ParkModel');
		$park = new Park();
		$park->setName($name)
			->setUser($this->current_user);
		$result = $parkModel->insert($park);
		$resultStatus->setCMD($resultStatus::SUCCESS, '保存园区成功', $result);
		return new JsonModel($resultStatus->getCMD());
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
		
		$parkModel = $this->getServiceLocator()->get('ParkModel');
		$park = $parkModel->getArrayById($id);
		return new JsonModel($park);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::getList()
	 */
	public function getList() {
		$request = $this->getRequest();
		
		$parkModel = $this->getServiceLocator()->get('ParkModel');
		$count = ($request->getQuery('count') != null)?$request->getQuery('count'):20;
		$page = ($request->getQuery('page') != null)?$request->getQuery('page'):1;
		$parks = $parkModel->getList($count, $page);
		
		return new JsonModel($parks);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::update()
	 */
	public function update($id, $data) {
		// TODO Auto-generated method stub
		$resultStatus = $this->resultStatus;
		try {
			$name = $data['name'];
			$parkModel = $this->getServiceLocator()->get('ParkModel');
			$park = $parkModel->getById($id);
			if ($park == null) {
				throw new ParkException('园区不存在！');
			}
			$park->setName($name);
			$result = $parkModel->update($park);
			$resultStatus->setCMD($resultStatus::SUCCESS, '更新园区成功', $result);
		} catch (ParkException $e) {
			$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
		}
		
		return new JsonModel($resultStatus->getCMD());
		
	}
}

?>