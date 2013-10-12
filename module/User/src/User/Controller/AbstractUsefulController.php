<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use User\Lib\ResultStatus;

abstract class AbstractUsefulController extends AbstractActionController {
	
	protected $resultStatus;
	public function __construct() {
		$this->resultStatus = new ResultStatus();
	}
	
}

?>