<?php

namespace Application\Controller;

use Application\Exception\ParkException;

use Application\Entity\Park;

use Zend\View\Model\JsonModel;

class ParkController extends AbstractUsefulController {
	
	public function listAction() {
		$request = $this->getRequest();
		$resultStatus = $this->resultStatus;
		
		$parkModel = $this->getServiceLocator()->get('ParkModel');
		$count = ($request->getQuery('count') != null)?$request->getQuery('count'):20;
		$page = ($request->getQuery('page') != null)?$request->getQuery('page'):1;
		$parks = $parkModel->getList($count, $page);
		
		return new JsonModel($parks);
	}
	
	public function getAction() {
		
		$id = $this->getEvent()->getRouteMatch()->getParam('id');
		$parkModel = $this->getServiceLocator()->get('ParkModel');
		$park = $parkModel->getArrayById($id);
		return new JsonModel($park);
		
	}
	
	
	public function saveAction() {
		$request = $this->getRequest();
		$resultStatus = $this->resultStatus;
		
		if ($request->isPost()) {
			
			try {
				$id = $request->getPost('id');
				$name = $request->getPost('name');
					
				$parkModel = $this->getServiceLocator()->get('ParkModel');
					
				$park = null;
				$result = null;
				if ($id == null) {
					//插入
					$park = new Park();
					$park->setName($name)
						->setUser($this->current_user);
					$result = $parkModel->insert($park);
				} else {
					//编辑
					$park = $parkModel->getById($id);
					if ($park == null) {
						throw new ParkException('园区不存在！');
					}
					$park->setName($name);
					$result = $parkModel->update($park);
				}
				
				$resultStatus->setCMD($resultStatus::SUCCESS, '保存园区成功', $result);
			} catch (ParkException $e) {
				$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
			}
		} else {
			if ($request->isGet()) {
				$this->getResponse()->setStatusCode(404);
				return;
			}
			$resultStatus->setCM($resultStatus::FAILED, '未知错误');
		}
		
		return new JsonModel($resultStatus->getCMD());
	}
}

?>