<?php

namespace Application\Controller;

use User\Lib\Role;

use Zend\View\Model\JsonModel;

use Application\Exception\BuildException;

use Application\Exception\ParkException;

use Application\Entity\Build;

class BuildController extends AbstractUsefulController {
	
	public function saveAction() {
		$request = $this->getRequest();
		$resultStatus = $this->resultStatus;
		if ($request->isPost()) {
			try {
				$id = $request->getPost('id');
				$name = $request->getPost('name');
				$park_id = $request->getPost('park');
					
				$parkModel = $this->getServiceLocator()->get('ParkModel');
				$buildModel = $this->getServiceLocator()->get('BuildModel');
				
				$park = $parkModel->getById($park_id);
				if ($park == null) {
					throw new ParkException("园区不存在！");
				}
				$build = null;
				$result = null;
				if ( $id == null ) {
					//插入
					$build = new Build();
					$build->setName($name)
						->setUser($this->current_user)
						->setPark($park);
					$result = $buildModel->insert($build);
					
				} else {
					//编辑
					$build = $buildModel->getById($id);
					if ($build == null) {
						throw new BuildException('楼号不存在！');
					}
					$build->setName($name)
						->setPark($park);
					$result = $buildModel->update();
				}
				
				$resultStatus->setCMD($resultStatus::SUCCESS, '保存成功', $result);

			} catch (ParkException $e) {
				$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
			} catch (BuildException $e) {
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
	
	public function adminsAction() {
		$roleModel = $this->getServiceLocator()->get('RoleModel');
		
		$users = $roleModel->getUsers(Role::DEPART);
		return new JsonModel($users);
	}
	
	public function getManagedListAction() {
		$buildModel = $this->getServiceLocator()->get('BuildModel');
		$user = $this->current_user;
		$builds = $buildModel->getBy('user', $user);
		
		return new JsonModel($builds);
	}
}

?>