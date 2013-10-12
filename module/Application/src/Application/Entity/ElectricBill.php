<?php

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="electric_bill")
 *
 * @author billyct
 */
class ElectricBill extends AbstractBase {
	/**
	 * @ORM\Column(type="string")
	 **/
	protected $degree_last;
	/**
	 * @ORM\Column(type="string")
	 **/
	protected $degree_current;
	/**
	 * @ORM\Column(type="string")
	 **/
	protected $degree_pay;
	/**
	 * @ORM\Column(type="float")
	 **/
	protected $price_per;
	/**
	 * @ORM\Column(type="date")
	 **/
	protected $dead_line;
	/**
	 * @ORM\Column(type="integer")
	 **/
	protected $status;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Application\Entity\Room", inversedBy="electric_bills")
	 **/
	protected $room;
	
	public function __construct() {
		$this->status = 0;
	}
	/**
	 * @return the $degree_last
	 */
	public function getDegree_last() {
		return $this->degree_last;
	}

	/**
	 * @return the $degree_current
	 */
	public function getDegree_current() {
		return $this->degree_current;
	}

	/**
	 * @return the $degree_pay
	 */
	public function getDegree_pay() {
		return $this->degree_pay;
	}

	/**
	 * @return the $price_per
	 */
	public function getPrice_per() {
		return $this->price_per;
	}

	/**
	 * @return the $dead_line
	 */
	public function getDead_line() {
		return $this->dead_line;
	}

	/**
	 * @return the $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @return the $room
	 */
	public function getRoom() {
		return $this->room;
	}

	/**
	 * @param field_type $degree_last
	 */
	public function setDegree_last($degree_last) {
		$this->degree_last = $degree_last;
		return $this;
	}

	/**
	 * @param field_type $degree_current
	 */
	public function setDegree_current($degree_current) {
		$this->degree_current = $degree_current;
		return $this;
	}

	/**
	 * @param field_type $degree_pay
	 */
	public function setDegree_pay($degree_pay) {
		$this->degree_pay = $degree_pay;
		return $this;
	}

	/**
	 * @param field_type $price_per
	 */
	public function setPrice_per($price_per) {
		$this->price_per = $price_per;
		return $this;
	}

	/**
	 * @param field_type $dead_line
	 */
	public function setDead_line($dead_line) {
		$this->dead_line = $dead_line;
		return $this;
	}

	/**
	 * @param number $status
	 */
	public function setStatus($status) {
		$this->status = $status;
		return $this;
	}

	/**
	 * @param field_type $room
	 */
	public function setRoom($room) {
		$this->room = $room;
		return $this;
	}

}

?>