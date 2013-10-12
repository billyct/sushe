<?php

namespace User\Controller;

use User\Lib\ResultStatus;

use Zend\View\Model\ViewModel;

use User\InputFilter\UserFilter;

use User\Exception\UserException;

use Zend\Session\Container;

use Zend\Crypt\Password\Bcrypt;
use User\Model\UserModel;
use User\Entity\User;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;

class UserController extends AbstractUsefulController {
	
	public function __construct() {
		parent::__construct();
		$self = $this;
		$this->getEventManager()->attach ( 'userfilter', function($e) {
			$request = $e->getParams();
			if ($request->isPost()) {
				//验证输入信息
				$userFilter = new UserFilter();
				$userFilter->getInputFilter()->setData($_POST);
				if ($userFilter->getInputFilter()->isValid()) {
					$message = null;
					foreach ($userFilter->getInvalidInput() as $error) {
						$message .= $error->getMessages().'\n';
					}
					throw new \Exception($message);
				}
			}
		});
	}
	
	public function indexAction() {
		
// 		$userModel = $this->getServiceLocator()->get('User\Model\UserModel');
// 		$user = $userModel->getUserObjectById(1);
// 		$roleModel = $this->getServiceLocator()->get('User\Model\RoleModel');
// 		$role = $roleModel->getRoleById(4);
// 		$user->addRole($role);
// 		$userModel->getEntityManager()->flush();
		
		$authService = new AuthenticationService();
		$authService->setStorage(new SessionStorage(ResultStatus::USER));
		
		if ($authService->hasIdentity()) {
			$this->redirect()->toRoute('home');
		}
		$viewModel = new ViewModel();
	    return $viewModel;
	}
	
	public function signinAction() {
		$resultStatus = $this->resultStatus;
		$request = $this->getRequest();
		if ($request->isGet()) {
			$this->getResponse()->setStatusCode(404);
			return;
		}
		try {
			$this->getEventManager()->trigger('userfilter', $this, $request);
			$userModel = $this->getServiceLocator()->get('User\Model\UserModel');
			$userData = array(
					'indentity' => $request->getPost('account'),
					'credential' => $request->getPost('password')
			);
				
			$result = $userModel->auth($userData);
			
				
			$resultStatus->setCM($result->getCode(), $result->getMessages());
		} catch (\Exception $e) {
			$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
		}

		return new JsonModel($resultStatus->getCM());
	}
	
	public function signupAction() {
		$resultStatus = $this->resultStatus;
		$request = $this->getRequest();
		if ($request->isGet()) {
			$this->getResponse()->setStatusCode(404);
			return;
		}
		try {
			$this->getEventManager()->trigger('userfilter', $this, $request);
			$userModel = $this->getServiceLocator()->get('User\Model\UserModel');
			$user = new User();
			$username = $request->getPost('username');
			$password = $request->getPost('password');
			$email = $request->getPost('email');
			
			$user->setUsername($username)
				->setEmail($email)
				->setPassword($password);
			//注册
			$userModel->register($user);
			
			$userData = array(
					'indentity' => $username,
					'credential' => $password
			);
			//登录
			$userModel->auth($userData);
			
			$resultStatus->setCM($resultStatus::SUCCESS, '用户注册成功');
			
		} catch (\Exception $e) {
			$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
		} catch (UserException $e) {
			$resultStatus->setCM($resultStatus::FAILED, $e->getMessage());
		}

		return new JsonModel($resultStatus->getCM());
		
	}
	
	public function signoutAction() {
		$auth = new AuthenticationService();
		$auth->setStorage(new SessionStorage(ResultStatus::USER));
		$auth->clearIdentity();
		$this->redirect()->toRoute('user');
	}
}

?>