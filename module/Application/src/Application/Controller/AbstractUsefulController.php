<?php

namespace Application\Controller;

use Zend\EventManager\EventManagerInterface;

use Zend\Authentication\AuthenticationService;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\Storage\Session as SessionStorage;
use User\Lib\ResultStatus;

abstract class AbstractUsefulController extends AbstractActionController {
	
	protected $resultStatus;
	protected $authService;
	protected $current_user;
	
	public function __construct() {
		$this->authService = new AuthenticationService();
		$this->authService->setStorage(new SessionStorage(ResultStatus::USER));
		$this->resultStatus = new ResultStatus();
	}
	
	public function setEventManager(EventManagerInterface $events) {
		parent::setEventManager($events);
		$this->init();
	}
	
	public function init() {
		
		$user = $this->authService->getIdentity();
		$userModel = $this->getServiceLocator()->get('UserModel');
		if ($user != null && $this->authService->hasIdentity()) {
			$this->current_user = $userModel->getUserObjectById($user['id']);
		}
	}
	
}

?>