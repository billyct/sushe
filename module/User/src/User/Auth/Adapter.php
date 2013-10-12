<?php

namespace User\Auth;

use User\Model\AbstractModel;

use OAuth\Lib\EntitySerializer;

use Zend\Crypt\Password\Bcrypt;
use Zend\Authentication\Result;
use Zend\Authentication\Adapter\AdapterInterface;

class Adapter extends AbstractModel implements AdapterInterface {
	
	private $_identityColumn;
	private $_credentialColumn;
	private $_identity;
	private $_credential;
	protected $usermodel;
	
	public function __construct($identity = null, $credential = null) {
		$this->_identity = $identity;
		$this->_credential = $credential;
		$this->_identityColumn = 'username';
		$this->_credentialColumn = 'password';
	}
	
// 	/*
// 	 * (non-PHPdoc) @see
// 	 * \Zend\Authentication\Adapter\AdapterInterface::authenticate()
// 	 */
// 	private function _queryIdentity() {
// 		$em = $this->getEntityManager ();
// 		$user = $em->getRepository ( 'User\Entity\User' )->findOneBy ( array (
// 				$this->_identityColumn => $this->_identity 
// 		));
		
// 		return $user;
// 	}
	
	
	
	public function authenticate() {
		// TODO Auto-generated method stub
		
		$code = Result::SUCCESS;
		$message="登录成功！";
		
		$user = $this->getUsermodel()->getBy($this->_identityColumn, $this->_identity);
		
		if (!$user) {
			$code = Result::FAILURE_IDENTITY_NOT_FOUND;
			$message = '用户名或者Email不存在';
		} else {
			$bcrypt = new Bcrypt ();
// 			$getCredential = 'get' . ucfirst ( $this->_credentialColumn );
// 			$setCredential = 'set' . ucfirst ( $this->_credentialColumn );
			$result = $bcrypt->verify ( $this->_credential, $user[$this->_credentialColumn]);
			unset($user[$this->_credentialColumn]);
			if (! $result) {
				$code = Result::FAILURE_CREDENTIAL_INVALID;
				$message = '密码不正确';
				$user = null;
			}
		}
		
 		$msg = array( 'msg' => $message );
		
		return new Result ( $code, $user, $msg );
	}
	/**
	 * @return the $_identityColumn
	 */
	public function getIdentityColumn() {
		return $this->_identityColumn;
	}

	/**
	 * @return the $_credentialColumn
	 */
	public function getCredentialColumn() {
		return $this->_credentialColumn;
	}

	/**
	 * @return the $_identity
	 */
	public function getIdentity() {
		return $this->_identity;
	}

	/**
	 * @return the $_credential
	 */
	public function getCredential() {
		return $this->_credential;
	}

	/**
	 * @param field_type $_identityColumn
	 */
	public function setIdentityColumn($_identityColumn) {
		$this->_identityColumn = $_identityColumn;
		return $this;
	}

	/**
	 * @param field_type $_credentialColumn
	 */
	public function setCredentialColumn($_credentialColumn) {
		$this->_credentialColumn = $_credentialColumn;
		return $this;
	}

	/**
	 * @param field_type $_identity
	 */
	public function setIdentity($_identity) {
		$this->_identity = $_identity;
		return $this;
	}

	/**
	 * @param field_type $_credential
	 */
	public function setCredential($_credential) {
		$this->_credential = $_credential;
		return $this;
	}
	/**
	 * @return the $usermodel
	 */
	public function getUsermodel() {
		return $this->usermodel;
	}

	/**
	 * @param field_type $usermodel
	 */
	public function setUsermodel($usermodel) {
		$this->usermodel = $usermodel;
		return $this;
	}

	


}

?>