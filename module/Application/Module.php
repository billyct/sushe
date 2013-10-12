<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Navigation\Page\Mvc;

use Zend\EventManager\StaticEventManager;

use Application\View\Helper\BaseUrl;

use User\Lib\ResultStatus;

use Application\View\Helper\AuthService;

use Application\View\Helper\UserIdentity;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
    
    public function init() {
    	$events = StaticEventManager::getInstance();
    	$events->attach(__NAMESPACE__, MvcEvent::EVENT_DISPATCH, array($this, 'check'));
    }
    
    public function check($event) {
    	$target = $event->getTarget ();
    	$authService = new AuthenticationService();
    	$authService->setStorage(new SessionStorage(ResultStatus::USER));
    	if (!$authService->hasIdentity()) {
			$target->plugin('redirect')->toRoute('user');
			$event->stopPropagation();
			return false;
    	}
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig() {
    	return array(
    			'factories' => array(
    					'UserModel' => function ($sl) {
    						$authAdapter = $sl->get('Adapter');
    						$model = Module::modelFactory($sl, 'User\Model\UserModel');
    						$model->setAdapter($authAdapter);
    						return $model;
    					},
    					'RoleModel' => function ($sl) {
    						$model = Module::modelFactory($sl, 'User\Model\RoleModel');
    						return $model;
    					},
    					'Adapter' => function ($sl) {
    						$model = Module::modelFactory($sl, 'User\Auth\Adapter');
    						return $model;
    					},
    					'ParkModel' => function ($sl) {
    						$model = Module::modelFactory($sl, 'Application\Model\ParkModel');
    						return $model;
    					},
    					'BuildModel' => function ($sl) {
    						$model = Module::modelFactory($sl, 'Application\Model\BuildModel');
    						return $model;
    					},
    					'RoomModel' => function ($sl) {
    						$model = Module::modelFactory($sl, 'Application\Model\RoomModel');
    						return $model;
    					},
    					'StudentModel' => function ($sl) {
    						$model = Module::modelFactory($sl, 'Application\Model\StudentModel');
    						return $model;
    					},
    					'ElectricModel' => function ($sl) {
    						$model = Module::modelFactory($sl, 'Application\Model\ElectricModel');
    						return $model;
    					},
    					'HealthModel' => function ($sl) {
    						$model = Module::modelFactory($sl, 'Application\Model\HealthModel');
    						return $model;
    					},
    					'RepairModel' => function ($sl) {
    						$model = Module::modelFactory($sl, 'Application\Model\RepairModel');
    						return $model;
    					},
    					
    			),
    	);
    }
    
    public static function modelFactory($sl, $className) {
    	$entityManager = $sl->get('Doctrine\ORM\EntityManager');
    	$model = new $className();
    	$model->setEntityManager($entityManager);
    	return $model;
    }
    
    public function getViewHelperConfig() {
    	return array(
    			'factories' => array(
    					'userIdentity' => function($sm) {
    						$authService = new AuthenticationService();
    						$authService->setStorage(new SessionStorage(ResultStatus::USER));
    						$viewHelper = new UserIdentity();
    						$viewHelper->setAuthService($authService);
    						return $viewHelper;
    
    					},
    					'authService' => function($sm) {
    						$authService = new AuthenticationService();
    						$authService->setStorage(new SessionStorage(ResultStatus::USER));
    						$viewHelper = new AuthService();
    						$viewHelper->setAuthService($authService);
    						return $viewHelper;
    					},
    					'baseUrl' => function() {
    						$baseurl = "http://shushe.localhost";
    						$viewHelper = new BaseUrl();
    						$viewHelper->setBaseurl($baseurl);
    						return $viewHelper;
    					}
    			),
    	);
    }
}
