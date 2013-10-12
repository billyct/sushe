<?php

namespace User\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="role")
 *
 * @author billyct
 */
class Role {
	
	/**
	 *
	 * @var int 
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 *
	 * @var string 
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $name;
	
	/**
	 *
	 * @var string 
	 * @ORM\Column(type="text", nullable=true)
	 */
	protected $desc;
	
	/**
	 * 
	 * @ORM\ManyToMany(targetEntity="User\Entity\User", mappedBy="roles")
	 */
	protected $users;
	
	public function __construct() {
		$this->users = new ArrayCollection();
	}
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $desc
	 */
	public function getDesc() {
		return $this->desc;
	}

	/**
	 * @return the $users
	 */
	public function getUsers() {
		return $this->users;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param string $desc
	 */
	public function setDesc($desc) {
		$this->desc = $desc;
	}

	/**
	 * @param \Doctrine\Common\Collections\ArrayCollection $users
	 */
	public function setUsers($users) {
		$this->users = $users;
	}

	
}

?>