<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;


/**
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="park")
 *
 * @author billyct
 */
class Park extends AbstractBase{
	/**
	 * @ORM\Column(type="string")
	 **/
	protected $name;
	/**
	 * @ORM\OneToMany(targetEntity="Application\Entity\Build", mappedBy="park")
	 **/
	protected $builds;
	
	/**
	 * @ORM\ManyToOne(targetEntity="User\Entity\User")
	 **/
	protected $user;
	
	public function __construct() {
		parent::__construct();
		$this->builds = new ArrayCollection();
	}
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $builds
	 */
	public function getBuilds() {
		return $this->builds;
	}

	/**
	 * @return the $user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * @param \Doctrine\Common\Collections\ArrayCollection $builds
	 */
	public function setBuilds($builds) {
		$this->builds = $builds;
		return $this;
	}

	/**
	 * @param field_type $user
	 */
	public function setUser($user) {
		$this->user = $user;
		return $this;
	}

	
	

}

?>