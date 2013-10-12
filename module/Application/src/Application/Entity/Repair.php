<?php

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="repair")
 *
 * @author billyct
 */
class Repair extends AbstractBase {
	/**
	 * @ORM\Column(type="text")
	 **/
	protected $problem;
	
	/**
	 * @ORM\Column(type="integer")
	 **/
	protected $time_rest;
	
	/**
	 * @ORM\ManyToOne(targetEntity="User\Entity\User")
	 **/
	protected $user;
	/**
	 * @ORM\ManyToOne(targetEntity="User\Entity\User")
	 **/
	protected $user_handle;
	
	/**
	 * @ORM\Column(type="text",nullable=true)
	 **/
	protected $feedback;
	
	/**
	 * @ORM\Column(type="integer")
	 **/
	protected $status;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Application\Entity\Student")
	 **/
	protected $student;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Application\Entity\Room")
	 **/
	protected $room;
	
	public function __construct() {
		parent::__construct();
		$this->status = 0;
	}
	/**
	 * @return the $problem
	 */
	public function getProblem() {
		return $this->problem;
	}

	/**
	 * @return the $time_rest
	 */
	public function getTime_rest() {
		return $this->time_rest;
	}

	/**
	 * @return the $user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @return the $user_handle
	 */
	public function getUser_handle() {
		return $this->user_handle;
	}

	/**
	 * @return the $feedback
	 */
	public function getFeedback() {
		return $this->feedback;
	}

	/**
	 * @return the $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param field_type $problem
	 */
	public function setProblem($problem) {
		$this->problem = $problem;
		return $this;
	}

	/**
	 * @param field_type $time_rest
	 */
	public function setTime_rest($time_rest) {
		$this->time_rest = $time_rest;
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
	 * @param field_type $user_handle
	 */
	public function setUser_handle($user_handle) {
		$this->user_handle = $user_handle;
		return $this;
	}

	/**
	 * @param field_type $feedback
	 */
	public function setFeedback($feedback) {
		$this->feedback = $feedback;
		return $this;
	}

	/**
	 * @param field_type $status
	 */
	public function setStatus($status) {
		$this->status = $status;
		return $this;
	}
	/**
	 * @return the $room
	 */
	public function getRoom() {
		return $this->room;
	}

	/**
	 * @param field_type $room
	 */
	public function setRoom($room) {
		$this->room = $room;
		return $this;
	}
	/**
	 * @return the $student
	 */
	public function getStudent() {
		return $this->student;
	}

	/**
	 * @param field_type $student
	 */
	public function setStudent($student) {
		$this->student = $student;
		return $this;
	}



	
	
}

?>