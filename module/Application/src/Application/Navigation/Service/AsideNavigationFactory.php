<?php

namespace Application\Navigation\Service;

require_once ('vendor/zendframework/zendframework/library/Zend/Navigation/Service/DefaultNavigationFactory.php');

use Zend\Navigation\Service\DefaultNavigationFactory;

class AsideNavigationFactory extends DefaultNavigationFactory {
	protected function getName() {
		return 'aside';
	}
}

?>