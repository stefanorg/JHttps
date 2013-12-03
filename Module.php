<?php
/**
 * 
 */
namespace JHttps;

use Zend\ModuleManager\Feature;

class Module implements
    Feature\ConfigProviderInterface
    {

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

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap($e)
    {
        $application = $e->getTarget();
        $eventManager = $application->getEventManager();
        $sharedManager = $eventManager->getSharedManager();
        $services = $application->getServiceManager();

        //Attach jhttps listener
        $eventManager->attach($services->get("jhttps.listeners.jhttpsroutelistener"));     
    }
}