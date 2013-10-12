<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Authentication\AuthenticationService;

use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\View\Model\JsonModel;

use User\Lib\ResultStatus;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractUsefulController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
