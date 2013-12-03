<?php

/**
 * jhttps route listener
 */

namespace JHttps\Listeners;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;

class JHttpsRouteListener implements ListenerAggregateInterface
{
	protected $listeners = array();

	public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, array($this, 'preDispatch'), 100);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function preDispatch($e)
    {
    	$sl = $e->getApplication()->getServiceManager();
        $config = $sl->get('Config');

        $https_config = isset($config['force_https']) ? $config['force_https'] : array();

        $https_routes = isset($https_config['routes']) ? $https_config['routes'] : array();

        $router = $e->getRouter();
        $uri = $router->getRequestUri();

        $routeMatch = $e->getRouteMatch();
        $action = $routeMatch->getParam('action');
        $controller = $routeMatch->getParam('controller');
        $matchedRouteName = $routeMatch->getMatchedRouteName();
        
        if(in_array($matchedRouteName, $https_routes)){
            // se la rotta richiede https
            // verifico e forzo lo schema https
            if ( "https" !== $uri->getScheme() ) {
                $uri->setScheme("https");
                $uri->setPort(null);
                $url = $uri->toString();
                $response=$e->getResponse();
                $response->getHeaders()->addHeaderLine('Location', $url);
                $response->setStatusCode(302);
                $response->sendHeaders();
                return $response;
            }
        }else{
            //se la rotta non richiede https controllo se schema https in tal caso lo imposto a http
            if ( "https" === $uri->getScheme() ) {
                $uri->setScheme("http");
                $uri->setPort(null);
                $url = $uri->toString();
                $response=$e->getResponse();
                $response->getHeaders()->addHeaderLine('Location', $url);
                $response->setStatusCode(302);
                $response->sendHeaders();
                return $response;   
            }
        }
    }
}