<?php

namespace User;

return array (
		'controllers' => array (
				'invokables' => array (
						'User\Controller\User' => 'User\Controller\UserController' 
				) 
		),
		'view_manager' => array (
				'template_path_stack' => array (
						'oauth' => __DIR__ . '/../view' 
				),
				'strategies' => array (
						'ViewJsonStrategy' 
				) 
		),
		
		
		'router' => array (
				'routes' => array (
						'user' => array (
								'type' => 'Segment',
								'options' => array (
										'route' => '/user/[:action]',
										'constraints' => array (
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*' 
										),
										'defaults' => array (
												'controller' => 'User\Controller\User',
												'action' => 'index' 
										) 
								) 
						),
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