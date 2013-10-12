<?php

namespace User\Model;


use Doctrine\ORM\Tools\Pagination\Paginator;

use User\Lib\ResultStatus;

use User\Exception\UserException;

use DoctrineModule\Validator\ObjectExists;

use User\Lib\EntitySerializer;

use Doctrine\Common\Collections\ArrayCollection;

use User\Auth\Adapter;

use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\Authentication\AuthenticationService;
use User\Entity\User;

class UserModel extends AbstractModel {
	
	/*
	 * @var User\Auth\Adapter
	 * */
	private $_adapter;
	
	/**
	 * 判断用户是否存在
	 * @param string $username
	 * @param string $email
	 * @throws \Exception  
	 * */
	public function userExitCheck($field, $value) {		
		$em = $this->getEntityManager();
		$repository = $em->getRepository('User\Entity\User');
		$validator = new ObjectExists(array(
				'object_repository' => $repository,
				'fields' => array($field)
		));
		
		return $validator->isValid(array(
				$field => $value
		));
	}
	
	/**
	 * 用户注册
	 * @param User $user
	 * @return null  
	 * */
	public function register(User $user) {
		$em = $this->getEntityManager ();
		if ( $this->userExitCheck('username',$user->getUsername()) ) {
			throw new UserException('用户名存在');
		}
		if ( $this->userExitCheck('email', $user->getEmail()) ) {
			throw new UserException('邮箱存在');
		}	
		$em->persist($user);
		$em->flush();
		
		return $user;
	}
	
	/**
	 * 用户登录认证
	 * @param array $data
	 *        -$data 必须有indentity，和credential
	 * @return \Zend\Authentication\Result  
	 * */
	public function auth(array $data) {
		$authAdapter = $this->_adapter;
		$authAdapter->setIdentityColumn('username')
				->setIdentity($data['indentity'])
				->setCredentialColumn('password')
				->setCredential($data['credential']);
		
		$auth = new AuthenticationService();
		$auth->setStorage(new SessionStorage(ResultStatus::USER));
		$result = $auth->authenticate($authAdapter);
		return $result;
	}
	
	/**
	 * 通过ID获取用户信息
	 * @param int 用户ID
	 * @return array
	 **/
	public function getUserArrayById($id) {
		$em = $this->getEntityManager ();
		$user = $em->find('User\Entity\User', $id);
		$user = $this->toArray($user);
		return $user;
	}
	
	public function aasort (&$array, $key) {
		$sorter=array();
		$ret=array();
		reset($array);
		foreach ($array as $ii => $va) {
			$sorter[$ii]=$va[$key];
		}
		asort($sorter);
		foreach ($sorter as $ii => $va) {
			$ret[$ii]=$array[$ii];
		}
		$array=$ret;
	}
	
	public function toArray($user) { 
		$em = $this->getEntityManager ();
		$entitySer = new EntitySerializer($em);
		if ($user != null) {
			$roles = $user->getRoles();
			$rolesArray = array();
			foreach ($roles as $role) {
				$rolesArray[] = $entitySer->toArray($role);
			}
			
			$user = $entitySer->toArray($user);
			$this->aasort($rolesArray,"id");
			$user['roles'] = $rolesArray;
		}
		return $user;
	}
	
	/**
	 * 通过ID获取用户信息
	 * @param int 用户ID
	 * @return User
	 **/
	public function getUserObjectById($id) {
		$em = $this->getEntityManager ();
		$user = $em->find('User\Entity\User', $id);
		return $user;
	}
	
	
	public function getBy($identityColumn, $identity) {
		$em = $this->getEntityManager ();
		$user = $em->getRepository ( 'User\Entity\User' )->findOneBy ( array (
				$identityColumn => $identity
		));
		
		if ($user != null) {
			$user = $this->toArray($user);
		}
		
		return $user;
	}
	
	public function update($user) {
		$old_user = $this->getUserObjectById($user->getId());
		if ($old_user->getUsername() != $user->getUsername())
		if ( $this->userExitCheck('username',$user->getUsername()) ) {
			throw new UserException('用户名存在');
		}
		if ($old_user->getEmail() != $user->getEmail())
		if ( $this->userExitCheck('email', $user->getEmail()) ) {
			throw new UserException('邮箱存在');
		}
		$this->getEntityManager()->flush();
		return $user;
	}
	
	public function getList($count, $page) {
		$m = $this->getEntityManager();
		$qb = $m->createQueryBuilder();
		
		$first = $count*($page-1);
		$max = $count*$page;
		
		
		$query = $qb->select(array('user'))
					->where('User\Entity\User user')
					->orderBy('user.id','ASC')
					->setFirstResult($first)
					->setMaxResults($max);
		
		$paginator = new Paginator($query, $fetchJoinCollection = true);
		
		$users = array();
		foreach ($paginator as $user) {
			$users[] = $this->toArray($user);
		}
		
		return $users;
	}
	/**
	 * @return the $dapater
	 */
	public function getAdapter() {
		return $this->_adapter;
	}

	/**
	 * @param field_type $dapater
	 */
	public function setAdapter(Adapter $adapter) {
		$this->_adapter = $adapter;
		$this->_adapter->setUsermodel($this);
	}

}

?>