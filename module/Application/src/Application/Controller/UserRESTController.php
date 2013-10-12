<?php

namespace Application\Controller;


use User\Exception\RoleException;

use User\Exception\UserException;

use User\Entity\User;

use Zend\View\Model\JsonModel;


use Application\Controller\AbstractUsefulRESTController;

class UserRESTController extends AbstractUsefulRESTController {
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::create()
	 */
	public function create($data) {
		// TODO Auto-generated method stub
		$resultStatus = $this->resultStatus;
		try {
			$username = $data['username'];
			$displayName = $data['display_name'];
			$email = $data['email'];
			$role_ids = $data['roles'];
			$password = '123456';
			
			
			$roleModel = $this->getServiceLocator()->get('RoleModel');
			$userModel = $this->getServiceLocator()->get('UserModel');
			
			
			$user = new User();
			$user->setUsername($username)
				->setEmail($email)
				->setDisplayName($displayName)
				->setPassword($password);
			
			if (!is_array($role_ids)) $role_ids = array($role_ids);
			foreach ($role_ids as $role_id) {
				$role = $roleModel->getRoleById($role_id);
				if ($role == null) {
					throw new RoleException('权限不存在');
				}
				$user->addRole($role);
			}
			
			$userModel->register($user);
			$resultStatus->setCM($resultStatus::SUCCESS, '用户添加成功');
		} catch (UserException $e) {
			$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
		} catch (RoleException $e) {
			$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
		}
		
		return new JsonModel($resultStatus->getCM());
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
		$userModel = $this->getServiceLocator()->get('UserModel');
		$user = $userModel->getUserArrayById($id);
		return new JsonModel($user);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::getList()
	 */
	public function getList() {
		// TODO Auto-generated method stub
		$request = $this->getRequest();
		
		$userModel = $this->getServiceLocator()->get('UserModel');
		$count = ($request->getQuery('count') != null)?$request->getQuery('count'):20;
		$page = ($request->getQuery('page') != null)?$request->getQuery('page'):1;
		$users = $userModel->getList($count, $page);
		
		return new JsonModel($users);
	}
	
	/*
	 * (non-PHPdoc) @see
	 * \Zend\Mvc\Controller\AbstractRestfulController::update()
	 */
	public function update($id, $data) {
		// TODO Auto-generated method stub
		$resultStatus = $this->resultStatus;
		try {
			$username = $data['username'];
			$displayName = $data['display_name'];
			$email = $data['email'];
			$role_ids = $data['roles'];
			
			$roleModel = $this->getServiceLocator()->get('RoleModel');
			$userModel = $this->getServiceLocator()->get('UserModel');
			
			$user = $userModel->getUserObjectById($id);
			if ($user == null) {
				throw new UserException('用户不存在！');
			}
			$user->setUsername($username)
				->setEmail($email)
				->setDisplayName($displayName);
			
			$user->getRoles()->clear();
			if (!is_array($role_ids)) $role_ids = array($role_ids); 
			foreach ($role_ids as $role_id) {
				$role = $roleModel->getRoleById($role_id);
				if ($role == null) {
					throw new RoleException('权限不存在');
				}
				
				$user->addRole($role);
			}
			$userModel->update($user);
			
			$resultStatus->setCM($resultStatus::SUCCESS, '用户保存成功');
		} catch (UserException $e) {
			$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
		} catch (RoleException $e) {
			$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
		}
		
		return new JsonModel($resultStatus->getCM());
		
	}
}

?>