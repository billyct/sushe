<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="student")
 *
 * @author billyct
 */
class Student extends AbstractBase {
	
	/**
	 * @ORM\Column(type="integer")
	 **/
	protected $bed_num;
	
	/**
	 * @ORM\Column(type="string")
	 **/
	protected $student_num;
	
	/**
	 * @ORM\Column(type="string")
	 **/
	protected $real_name;
	
	/**
	 * @ORM\Column(type="integer")
	 **/
	protected $gender;
	
	/**
	 * @ORM\Column(type="string")
	 **/
	protected $college;
	
	/**
	 * @ORM\Column(type="string")
	 **/
	protected $specialty;
	
	/**
	 * @ORM\Column(type="string")
	 **/
	protected $grade;
	
	/**
	 * @ORM\Column(type="string")
	 **/
	protected $class;
	
	/**
	 * @ORM\Column(type="string")
	 **/
	protected $phone;
	
	/**
	 * @ORM\Column(type="date")
	 **/
	protected $checkin;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Application\Entity\Room", inversedBy="students")
	 **/
	protected $room;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Application\Entity\Build", inversedBy="students")
	 **/
	protected $build;
	
	/**
	 * @ORM\OneToOne(targetEntity="User\Entity\User")
	 **/
	protected $user;
	/**
	 * @return the $bed_num
	 */
	public function getBed_num() {
		return $this->bed_num;
	}

	/**
	 * @return the $student_num
	 */
	public function getStudent_num() {
		return $this->student_num;
	}

	/**
	 * @return the $real_name
	 */
	public function getReal_name() {
		return $this->real_name;
	}

	/**
	 * @return the $gender
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * @return the $college
	 */
	public function getCollege() {
		return $this->college;
	}

	/**
	 * @return the $specialty
	 */
	public function getSpecialty() {
		return $this->specialty;
	}

	/**
	 * @return the $grade
	 */
	public function getGrade() {
		return $this->grade;
	}

	/**
	 * @return the $class
	 */
	public function getClass() {
		return $this->class;
	}

	/**
	 * @return the $phone
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * @return the $checkin
	 */
	public function getCheckin() {
		return $this->checkin;
	}

	/**
	 * @return the $room
	 */
	public function getRoom() {
		return $this->room;
	}

	/**
	 * @return the $user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @param field_type $bed_num
	 */
	public function setBed_num($bed_num) {
		$this->bed_num = $bed_num;
		return $this;
	}

	/**
	 * @param field_type $student_num
	 */
	public function setStudent_num($student_num) {
		$this->student_num = $student_num;
		return $this;
	}

	/**
	 * @param field_type $real_name
	 */
	public function setReal_name($real_name) {
		$this->real_name = $real_name;
		return $this;
	}

	/**
	 * @param field_type $gender
	 */
	public function setGender($gender) {
		$this->gender = $gender;
		return $this;
	}

	/**
	 * @param field_type $college
	 */
	public function setCollege($college) {
		$this->college = $college;
		return $this;
	}

	/**
	 * @param field_type $specialty
	 */
	public function setSpecialty($specialty) {
		$this->specialty = $specialty;
		return $this;
	}

	/**
	 * @param field_type $grade
	 */
	public function setGrade($grade) {
		$this->grade = $grade;
		return $this;
	}

	/**
	 * @param field_type $class
	 */
	public function setClass($class) {
		$this->class = $class;
		return $this;
	}

	/**
	 * @param field_type $phone
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
		return $this;
	}

	/**
	 * @param field_type $checkin
	 */
	public function setCheckin($checkin) {
		$this->checkin = $checkin;
		return $this;
	}

	/**
	 * @param field_type $room
	 */
	public function setRoom($room) {
		$this->room = $room;
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
	 * @return the $build
	 */
	public function getBuild() {
		return $this->build;
	}

	/**
	 * @param field_type $build
	 */
	public function setBuild($build) {
		$this->build = $build;
		return $this;
	}


	
	
}

?>