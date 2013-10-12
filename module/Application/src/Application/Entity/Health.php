<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="health")
 *
 * @author billyct
 */
class Health extends AbstractBase {
	/**
	 * @ORM\Column(type="date")
	 **/
	protected $checkdate;
	
	/**
	 * @ORM\Column(type="integer")
	 **/
	protected $level;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Application\Entity\Room", inversedBy="healths")
	 **/
	protected $room;
	/**
	 * @return the $checkdate
	 */
	public function getCheckdate() {
		return $this->checkdate;
	}

	/**
	 * @return the $level
	 */
	public function getLevel() {
		return $this->level;
	}

	/**
	 * @return the $room
	 */
	public function getRoom() {
		return $this->room;
	}

	/**
	 * @param field_type $checkdate
	 */
	public function setCheckdate($checkdate) {
		$this->checkdate = $checkdate;
		return $this;
	}

	/**
	 * @param field_type $level
	 */
	public function setLevel($level) {
		$this->level = $level;
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