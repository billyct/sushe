<?php

namespace Application\Navigation\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;

class HeaderNavigationFactory extends DefaultNavigationFactory {
	protected function getName() {
		return 'header';
	}
}

?>