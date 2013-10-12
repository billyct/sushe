<?php

namespace Application\Controller;

use Zend\View\Model\JsonModel;


class RoleRESTController extends AbstractUsefulRESTController {
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::create()
	 */
	public function create($data) {
		// TODO Auto-generated method stub
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
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::getList()
	 */
	public function getList() {
		// TODO Auto-generated method stub
		$roleModel = $this->getServiceLocator()->get('RoleModel');
		$roles = $roleModel->getList();
		return new JsonModel($roles);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::update()
	 */
	public function update($id, $data) {
		// TODO Auto-generated method stub
	}
}

?>