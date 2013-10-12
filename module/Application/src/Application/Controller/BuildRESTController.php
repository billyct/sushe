<?php

namespace Application\Controller;

use User\Exception\UserException;

use Application\Exception\BuildException;

use Zend\View\Model\JsonModel;

use Application\Entity\Build;

use Application\Exception\ParkException;

class BuildRESTController extends AbstractUsefulRESTController {
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::create()
	 */
	public function create($data) {
		// TODO Auto-generated method stub
		$resultStatus = $this->resultStatus;
		try {
			$name = $data['name'];
			$park_id = $data['park'];
			$user_id = $data['user'];
				
			$parkModel = $this->getServiceLocator()->get('ParkModel');
			$buildModel = $this->getServiceLocator()->get('BuildModel');
			$userModel = $this->getServiceLocator()->get('UserModel');
			
			$park = $parkModel->getById($park_id);
			if ($park == null) {
				throw new ParkException("园区不存在！");
			}
			
			$user = $userModel->getUserObjectById($user_id);
			if ($user == null) {
				throw new UserException("您所指定的管理员用户不存在");
			}
			
			$build = new Build();
			$build->setName($name)
				->setUser($user)
				->setPark($park);
			$result = $buildModel->insert($build);
			$resultStatus->setCMD($resultStatus::SUCCESS, '保存成功', $result);
		} catch (ParkException $e) {
			$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
		} catch (UserException $e) {
			$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
		}
		
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
		$buildModel = $this->getServiceLocator()->get('BuildModel');

		$build = $buildModel->getArrayById($id);
		return new JsonModel($build);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::getList()
	 */
	public function getList() {
		// TODO Auto-generated method stub
		$request = $this->getRequest();
		
		$buildModel = $this->getServiceLocator()->get('BuildModel');
		$count = ($request->getQuery('count') != null)?$request->getQuery('count'):20;
		$page = ($request->getQuery('page') != null)?$request->getQuery('page'):1;
		$builds = $buildModel->getList($count, $page);
		
		return new JsonModel($builds);
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
			$park_id = $data['park'];
			$user_id = $data['user'];
		
			$parkModel = $this->getServiceLocator()->get('ParkModel');
			$buildModel = $this->getServiceLocator()->get('BuildModel');
			$userModel = $this->getServiceLocator()->get('UserModel');
				
			$park = $parkModel->getById($park_id);
			if ($park == null) {
				throw new ParkException("园区不存在！");
			}
			
			$user = $userModel->getUserObjectById($user_id);
			if ($user == null) {
				throw new UserException("您所指定的管理员用户不存在");
			}
				
			$build = $buildModel->getById($id);
			if ($build == null) {
				throw new BuildException('楼号不存在');
			}
			$build->setName($name)
				->setUser($user)
				->setPark($park);
			$result = $buildModel->update($build);
			$resultStatus->setCMD($resultStatus::SUCCESS, '保存成功', $result);
		} catch (ParkException $e) {
			$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
		} catch (BuildException $e) {
			$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
		} catch (UserException $e) {
			$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
		}
		
		return new JsonModel($resultStatus->getCMD());
	}
}

?>