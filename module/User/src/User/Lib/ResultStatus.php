<?php

namespace User\Lib;

class ResultStatus {
	
	const USER = 'user';
	
	const SUCCESS = 1;
	const FAILED = 0;
	
	protected $_code;
	protected $_msg;
	protected $_data;
	
	
	public function setCM($_code, $_msg) {
		$this->setCode($_code);
		$this->setMsg($_msg);
	}
	
	public function setCMD($_code, $_msg, $_data) {
		$this->setCM($_code, $_msg);
		$this->setData($_data);
	}
	
	public function getCM() {
		return array(
				'code' => $this->getCode(),
				'msg' => $this->getMsg(),
				);
	}
	
	public function getCMD() {
		return array_merge($this->getCM(), array('data' => $this->getData()));
	}
	/**
	 * @return the $_code
	 */
	public function getCode() {
		return $this->_code;
	}

	/**
	 * @return the $_msg
	 */
	public function getMsg() {
		return $this->_msg;
	}

	/**
	 * @return the $_data
	 */
	public function getData() {
		return $this->_data;
	}

	/**
	 * @param field_type $_code
	 */
	public function setCode($_code) {
		$this->_code = $_code;
	}

	/**
	 * @param field_type $_msg
	 */
	public function setMsg($_msg) {
		$this->_msg = $_msg;
	}

	/**
	 * @param field_type $_data
	 */
	public function setData($_data) {
		$this->_data = $_data;
	}

	
	
}

?>