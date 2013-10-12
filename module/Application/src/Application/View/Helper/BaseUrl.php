<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class BaseUrl extends AbstractHelper {
	
	protected $baseurl;
	
	/**
	 * __invoke
	 *
	 * @access public
	 * @return \ZfcUser\Entity\UserInterface
	 */
	public function __invoke()
	{
		return $this->getBaseurl();
	}
	/**
	 * @return the $baseurl
	 */
	public function getBaseurl() {
		return $this->baseurl;
	}

	/**
	 * @param field_type $baseurl
	 */
	public function setBaseurl($baseurl) {
		$this->baseurl = $baseurl;
	}

	
}

?>