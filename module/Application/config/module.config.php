<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        		'park' => array(
        				'type' => 'Segment',
        				'options' => array(
        						'route'    => '/park[/][:action][/]',
        						'constraints' => array(
        								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
        								'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
        						),
        						'defaults' => array(
        								'controller' => 'Application\Controller\Park',
        								'action'     => 'list',
        						),
        				),
        				'may_terminate' => true,
        				'child_routes' => array(
        						'park-single' => array(
        							'type' => 'Segment',
        							'options' => array(
	        							'route' => '[:id][/]',
	        							'constraints' => array(
	        								'id' => '[a-zA-Z0-9_-]',
	        							),
	        							'defaults' => array(
	        								'action' => 'get'	
	        							),
        							),
        						),
        				),
        		),
        		'build' => array(
        				'type' => 'Segment',
        				'options' => array(
        						'route'    => '/build[/][:action]',
        						'constraints' => array(
        								'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
        						),
        						'defaults' => array(
        								'controller' => 'Application\Controller\Build',
        								'action'     => 'list',
        						),
        				),
        		),
        		'electric' => array(
        				'type' => 'Segment',
        				'options' => array(
        						'route'    => '/electric[/][:action]',
        						'constraints' => array(
        								'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
        						),
        						'defaults' => array(
        								'controller' => 'Application\Controller\Electric',
        						),
        				),
        		),
        		'student' => array(
        				'type' => 'Segment',
        				'options' => array(
        						'route'    => '/student[/][:action]',
        						'constraints' => array(
        								'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
        						),
        						'defaults' => array(
        								'controller' => 'Application\Controller\Student',
        						),
        				),
        		),
        		'health' => array(
        				'type' => 'Segment',
        				'options' => array(
        						'route'    => '/health[/][:action]',
        						'constraints' => array(
        								'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
        						),
        						'defaults' => array(
        								'controller' => 'Application\Controller\Health',
        						),
        				),
        		),
        		'park-rest' => array(
        				'type'    => 'segment',
        				'options' => array(
        						'route'    => '/parks-rest[/:id]',
        						'constraints' => array(
        								'id'     => '[0-9]+',
        						),
        						'defaults' => array(
        								'controller' => 'Application\Controller\ParkREST',
        						),
        				),
        		),
        		'build-rest' => array(
        				'type'    => 'segment',
        				'options' => array(
        						'route'    => '/builds-rest[/:id]',
        						'constraints' => array(
        								'id'     => '[0-9]+',
        						),
        						'defaults' => array(
        								'controller' => 'Application\Controller\BuildREST',
        						),
        				),
        		),
        		'user-rest' => array(
        				'type'    => 'segment',
        				'options' => array(
        						'route'    => '/users-rest[/:id]',
        						'constraints' => array(
        								'id'     => '[0-9]+',
        						),
        						'defaults' => array(
        								'controller' => 'Application\Controller\UserREST',
        						),
        				),
        		),
        		
        		'role-rest' => array(
        				'type'    => 'segment',
        				'options' => array(
        						'route'    => '/roles-rest[/:id]',
        						'constraints' => array(
        								'id'     => '[0-9]+',
        						),
        						'defaults' => array(
        								'controller' => 'Application\Controller\RoleREST',
        						),
        				),
        		),
        		'student-rest' => array(
        				'type'    => 'segment',
        				'options' => array(
        						'route'    => '/students-rest[/:id]',
        						'constraints' => array(
        								'id'     => '[0-9]+',
        						),
        						'defaults' => array(
        								'controller' => 'Application\Controller\StudentREST',
        						),
        				),
        		),
        		'electric-rest' => array(
        				'type'    => 'segment',
        				'options' => array(
        						'route'    => '/electrics-rest[/:id]',
        						'constraints' => array(
        								'id'     => '[0-9]+',
        						),
        						'defaults' => array(
        								'controller' => 'Application\Controller\ElectricREST',
        						),
        				),
        		),
        		'health-rest' => array(
        				'type'    => 'segment',
        				'options' => array(
        						'route'    => '/healths-rest[/:id]',
        						'constraints' => array(
        								'id'     => '[0-9]+',
        						),
        						'defaults' => array(
        								'controller' => 'Application\Controller\HealthREST',
        						),
        				),
        		),
        		'repair-rest' => array(
        				'type'    => 'segment',
        				'options' => array(
        						'route'    => '/repairs-rest[/:id]',
        						'constraints' => array(
        								'id'     => '[0-9]+',
        						),
        						'defaults' => array(
        								'controller' => 'Application\Controller\RepairREST',
        						),
        				),
        		),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
//             'application' => array(
//                 'type'    => 'Literal',
//                 'options' => array(
//                     'route'    => '/application',
//                     'defaults' => array(
//                         '__NAMESPACE__' => 'Application\Controller',
//                         'controller'    => 'Index',
//                         'action'        => 'index',
//                     ),
//                 ),
//                 'may_terminate' => true,
//                 'child_routes' => array(
//                     'default' => array(
//                         'type'    => 'Segment',
//                         'options' => array(
//                             'route'    => '/[:controller[/:action]]',
//                             'constraints' => array(
//                                 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                 'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
//                             ),
//                             'defaults' => array(
//                             ),
//                         ),
//                     ),
//                 ),
//             ),
        ),
    ),
    
    'navigation' => array(
    		'header' => array(),
    		'aside' => array(
    				array(
    						'label' => '宿舍管理',
    						'name' => 'depart-manage',
    						'uri' => '#',
    						'icon' => '/img/icons/stuttgart-icon-pack/32x32/building.png',
    						'role' => 'super',
    						'pages' => array(
    								array(
    										'label' => '园区',
    										'uri' => '#depart/park/list',
    										'role-child' => 'super',
    								),
    								array(
    										'label' => '楼号',
    										'uri' => '#depart/build/list',
    										'role-child' => 'super',
    								),
    						),
    				),
    				array(
    						'label' => '用户管理',
    						'name' => 'user-manage',
    						'uri' => '#user/list',
    						'icon' => '/img/icons/stuttgart-icon-pack/32x32/user.png',
    						'role' => 'super',
    				),
    				
    				array(
    						'label' => '学生管理',
    						'name' => 'student-manage',
    						'uri' => '#student/list',
    						'icon' => '/img/icons/stuttgart-icon-pack/32x32/student.png',
    						'role' => 'depart',
    				),
    				
    				array(
    						'label' => '电费管理',
    						'name' => 'electric-bill-manage',
    						'uri' => '#electric/list',
    						'icon' => '/img/icons/stuttgart-icon-pack/32x32/electric.png',
    						'role' => 'depart',
    				),
    				
    				array(
    						'label' => '卫生评分',
    						'name' => 'health-manage',
    						'uri' => '#health/list',
    						'icon' => '/img/icons/stuttgart-icon-pack/32x32/star.png',
    						'role' => 'depart',
    				),
    				
    				array(
    						'label' => '寝室电费情况',
    						'name' => 'student-electric-manage',
    						'uri' => '#student/electric',
    						'icon' => '/img/icons/stuttgart-icon-pack/32x32/student-electric.png',
    						'role' => 'student',
    				),
    				
    				array(
    						'label' => '寝室卫生情况',
    						'name' => 'student-health-manage',
    						'uri' => '#student/health',
    						'icon' => '/img/icons/stuttgart-icon-pack/32x32/student-health.png',
    						'role' => 'student',
    				),
    				
    				array(
    						'label' => '个人信息',
    						'name' => 'student-info-manage',
    						'uri' => '#student/info',
    						'icon' => '/img/icons/stuttgart-icon-pack/32x32/hulk-3.png',
    						'role' => 'student',
    				),
    				
    				array(
    						'label' => '报修',
    						'name' => 'student-repair-manage',
    						'uri' => '#student/repair',
    						'icon' => '/img/icons/stuttgart-icon-pack/32x32/student-repair.png',
    						'role' => 'student',
    				),
    				
    				array(
    						'label' => '报修情况',
    						'name' => 'repair-manage',
    						'uri' => '#repair/list',
    						'icon' => '/img/icons/stuttgart-icon-pack/32x32/repair.png',
    						'role' => 'engine',
    				),
    				
    				
    				
    		),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
            'aside-navigation' => 'Application\Navigation\Service\AsideNavigationFactory',
            'header-navigation' => 'Application\Navigation\Service\HeaderNavigationFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Build' => 'Application\Controller\BuildController',
            'Application\Controller\Park' => 'Application\Controller\ParkController',
        	'Application\Controller\BuildREST' => 'Application\Controller\BuildRESTController',
        	'Application\Controller\ParkREST' => 'Application\Controller\ParkRESTController',
        	'Application\Controller\UserREST' => 'Application\Controller\UserRESTController',
        	'Application\Controller\RoleREST' => 'Application\Controller\RoleRESTController',
        	'Application\Controller\StudentREST' => 'Application\Controller\StudentRESTController',
        	'Application\Controller\ElectricREST' => 'Application\Controller\ElectricRESTController',
        	'Application\Controller\HealthREST' => 'Application\Controller\HealthRESTController',
        	'Application\Controller\RepairREST' => 'Application\Controller\RepairRESTController',
        	'Application\Controller\Electric' => 'Application\Controller\ElectricController',
        	'Application\Controller\Student' => 'Application\Controller\StudentController',
        	'Application\Controller\Health' => 'Application\Controller\HealthController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'layout-noside' 		  => __DIR__ . '/../view/layout/layout-noside.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    	'strategies' => array (
    			'ViewJsonStrategy'
   		),
    ),
    
    'doctrine' => array (
    		'driver' => array (
    				__NAMESPACE__ . '_entity' => array (
    						'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
    						'paths' => array (
    								__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
    						)
    				),
    				'orm_default' => array (
    						'drivers' => array (
    								__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_entity'
    						)
    				)
    		)
    ),
);
