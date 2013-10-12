<?php

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="build")
 *
 * @author billyct
 */
class Build extends AbstractBase{
	/**
	 * @ORM\Column(type="string")
	 **/
	protected $name;
	/**
	 * @ORM\ManyToOne(targetEntity="Application\Entity\Park", inversedBy="builds")
	 **/
	protected $park;
	
	/**
	 * @ORM\OneToMany(targetEntity="Application\Entity\Room", mappedBy="build")
	 **/
	protected $rooms;
	
	/**
	 * @ORM\OneToMany(targetEntity="Application\Entity\Student", mappedBy="build")
	 **/
	protected $students;
	
	/**
	 * @ORM\ManyToOne(targetEntity="User\Entity\User", inversedBy="builds")
	 **/
	protected $user;
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $park
	 */
	public function getPark() {
		return $this->park;
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
	 * @param field_type $park
	 */
	public function setPark($park) {
		$this->park = $park;
		return $this;
	}

	/**
	 * @param field_type $user
	 */
	public function setUser($user) {
		$this->user = $user;
		return $this;
	}
	/**
	 * @return the $rooms
	 */
	public function getRooms() {
		return $this->rooms;
	}

	/**
	 * @param field_type $rooms
	 */
	public function setRooms($rooms) {
		$this->rooms = $rooms;
		return $this;
	}
	/**
	 * @return the $students
	 */
	public function getStudents() {
		return $this->students;
	}

	/**
	 * @param field_type $students
	 */
	public function setStudents($students) {
		$this->students = $students;
		return $this;
	}



}

?>