<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;


/**
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="room")
 *
 * @author billyct
 */
class Room extends AbstractBase {
	
	/**
	 * @ORM\Column(type="string")
	 **/
	protected $name;
	/**
	 * @ORM\ManyToOne(targetEntity="Application\Entity\Build", inversedBy="rooms")
	 **/
	protected $build;
	
	/**
	 * @ORM\OneToMany(targetEntity="Application\Entity\Student", mappedBy="room")
	 **/
	protected $students;
	
	/**
	 * @ORM\OneToMany(targetEntity="Application\Entity\Health", mappedBy="room") 
	 **/
	protected $healths;
	
	/**
	 * @ORM\OneToMany(targetEntity="Application\Entity\Repair", mappedBy="room")
	 **/
	protected $repairs;
	
	/**
	 * @ORM\OneToMany(targetEntity="Application\Entity\ElectricBill", mappedBy="room")
	 **/
	protected $electric_bills;
	
	public function __construct() {
		parent::__construct();
		$this->students = new ArrayCollection();
		$this->healths = new ArrayCollection();
		$this->repairs = new ArrayCollection();
		$this->electric_bills = new ArrayCollection();
	}
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $build
	 */
	public function getBuild() {
		return $this->build;
	}

	/**
	 * @return the $students
	 */
	public function getStudents() {
		return $this->students;
	}

	/**
	 * @return the $healths
	 */
	public function getHealths() {
		return $this->healths;
	}

	/**
	 * @return the $repairs
	 */
	public function getRepairs() {
		return $this->repairs;
	}

	/**
	 * @return the $electric_bills
	 */
	public function getElectric_bills() {
		return $this->electric_bills;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * @param field_type $build
	 */
	public function setBuild($build) {
		$this->build = $build;
		return $this;
	}

	/**
	 * @param field_type $students
	 */
	public function addStudent($student) {
		$this->students = $student;
		return $this;
	}

	/**
	 * @param field_type $healths
	 */
	public function addHealth($health) {
		$this->healths[] = $health;
		return $this;
	}

	/**
	 * @param field_type $repairs
	 */
	public function addRepair($repair) {
		$this->repairs[] = $repair;
		return $this;
	}

	/**
	 * @param field_type $electric_bills
	 */
	public function addElectric_bill($electric_bill) {
		$this->electric_bills[] = $electric_bill;
		return $this;
	}

	
	
	
	
}

?>