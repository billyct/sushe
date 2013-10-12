<?php
namespace User;

use Zend\ModuleManager\ModuleManager;

use OAuth\Lib\ResultStatus;

use BjyAuthorize\Provider\Identity\ZfcUserDoctrine;

class Module
{
	
	public function init(ModuleManager $moduleManager) {
		$sharedEvents = $moduleManager->getEventManager()->getSharedManager();
		$sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {
			$controller = $e->getTarget();
			$controller->layout('layout-noside');
		}, 100);
	
	}
	
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(

            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),

            
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
    					'User\Model\UserModel' => function ($sl) {	
    						$authAdapter = $sl->get('User\Auth\Adapter');   						
    						$model = Module::modelFactory($sl, 'User\Model\UserModel');
    						$model->setAdapter($authAdapter);
    						return $model;
    					},
    					'User\Model\RoleModel' => function ($sl) {
    						$model = Module::modelFactory($sl, 'User\Model\RoleModel');
    						return $model;
    					},
    					'User\Auth\Adapter' => function ($sl) {
    						return Module::modelFactory($sl, 'User\Auth\Adapter');
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
}
