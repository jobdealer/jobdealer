<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/[:action]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
#            'application' => array(
#                'type'    => 'Literal',
#                'options' => array(
#                    'route'    => '/application',
#                    'defaults' => array(
#                        '__NAMESPACE__' => 'Application\Controller',
#                        'controller'    => 'Index',
#                        'action'        => 'index',
#                    ),
#                ),
#                'may_terminate' => true,
#                'child_routes' => array(
#                    'default' => array(
#                        'type'    => 'Segment',
#                        'options' => array(
#                            'route'    => '/[:controller[/:action]]',
#                            'constraints' => array(
#                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
#                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
#                                'id'     => '[0-9]+',
#                            ),
#                            'defaults' => array(
#                            ),
#                        ),
#                    ),
#                ),
#            ),
            'node' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/node[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Node',
                        'action'        => 'index',
                    ),
                ),

            ),
            'job' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/job[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Job',
                        'action'        => 'index',
                    ),
                ),
            ),
            'workflow' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/workflow[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Workflow',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
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
            'Application\Controller\Node' => 'Application\Controller\NodeController',
            'Application\Controller\Job' => 'Application\Controller\JobController',
            'Application\Controller\Workflow' => 'Application\Controller\WorkflowController',
            'Application\Controller\Api' => 'Application\Controller\ApiController',
        ),
    ),
    'view_manager' => array(
        'default_suffix' => 'tpl',
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.tpl',
            'application/index/index' => __DIR__ . '/../view/application/index/index.tpl',
            'error/404'               => __DIR__ . '/../view/error/404.tpl',
            'error/index'             => __DIR__ . '/../view/error/index.tpl',
        ),
        'smarty' => array(
            'error_reporting'=> E_PARSE,
            'compile_dir' => __DIR__ . '/../../../data/Smarty/templates_c',
            'plugins_dir' => __DIR__ . '/../../../library/smarty_plugins',
            //'cache_dir' => 'path/to/cache/dir',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),

    ),
/*    'view_manager' => array(
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
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),*/
);
