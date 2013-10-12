<?php

namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\Authentication\AuthenticationService;

class AuthService extends AbstractHelper {
	
	/**
	 * @var AuthenticationService
	 */
	protected $authService;
	
	/**
	 * __invoke
	 *
	 * @access public
	 * @return \ZfcUser\Entity\UserInterface
	 */
	public function __invoke()
	{
		return $this->getAuthService();
	}
	
	/**
	 * Get authService.
	 *
	 * @return AuthenticationService
	 */
	public function getAuthService()
	{
		return $this->authService;
	}
	
	/**
	 * Set authService.
	 *
	 * @param AuthenticationService $authService
	 * @return \ZfcUser\View\Helper\ZfcUserIdentity
	 */
	public function setAuthService(AuthenticationService $authService)
	{
		$this->authService = $authService;
		return $this;
	}
}

?>