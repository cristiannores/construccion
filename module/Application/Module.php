<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
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
    
    public function getServiceConfig()
    {
        return array(
//-			'aliases' => array( // !!! aliases not alias
//-				'Zend\Authentication\AuthenticationService' => 'doctrine_authenticationservice', // aliases can be overwriten
//-			),
            'factories' => array(
                

                // Add this for SMTP transport
                'mail.transport' => function (ServiceManager $serviceManager) {
                    $config = $serviceManager->get('Config');
                    $transport = new Smtp();
                   
                  $options =   array(
                                        'host'              => '45.55.231.238',
                                        'connection_class'  => 'login',
                                        'port' => '25',
                                        'connection_config' => array(
                                                'username' => 'no-reply@jyj.cl',
                                                'password' => 'jyj2015',
                                                
                                        ),
                                );
                    $transport->setOptions(new SmtpOptions($options));

                    return $transport;
                },

               
            )
        );
    }
}
