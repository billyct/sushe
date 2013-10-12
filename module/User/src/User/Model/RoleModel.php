<?php

namespace User\Model;


use User\Lib\EntitySerializer;

class RoleModel extends AbstractModel {
	public function getRoleById($id) {
		$em = $this->getEntityManager();
		$role = $em->find('User\Entity\Role', $id);
		return $role;
	}
	
	public function toArray($role) {
		$m = $this->getEntityManager();
		$entitySer = new EntitySerializer($m);
		if ($role != null)
			$role = $entitySer->toArray($role);
		return $role;
	}
	
	public function getList() {
		$m = $this->getEntityManager();
		$roles = $m->getRepository ( 'User\Entity\Role' )->findAll();
		$rolesArray = array();
		foreach ($roles as $role) {
			$rolesArray[] = $this->toArray($role);
		}
		
		return $rolesArray;
	}
	
	public function getUsers($id) {
		$role = $this->getRoleById($id);
		$users = $role->getUsers();
		$m = $this->getEntityManager();
		$entitySer = new EntitySerializer($m);
		$usersArray = array();
		foreach ($users as $user) {
			$usersArray[] = $entitySer->toArray($user);
		}
		
		return $usersArray;
	}
}

?>