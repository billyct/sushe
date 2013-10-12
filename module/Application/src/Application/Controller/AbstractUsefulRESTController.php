<?php

namespace Application\Controller;

use Zend\Mvc\MvcEvent;

use Zend\EventManager\EventManagerInterface;

use User\Lib\ResultStatus;

use Zend\Authentication\AuthenticationService;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Authentication\Storage\Session as SessionStorage;
abstract class AbstractUsefulRESTController extends AbstractRestfulController {
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