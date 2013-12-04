<?php 
/**
 * JHttps Configuration 
 */
$config = array(
	'service_manager' => array(
		'invokables' => array(
			'jhttps.listeners.jhttpsroutelistener' => 'JHttps\Listeners\JHttpsRouteListener'
		)
    ),
    'jhttps' => array(
    	/**
    	 * If you want to reset to http scheme for non https route
    	 */
    	'force_http_for_non_https_route' => true,
    	'routes' => array()
    )
);

return $config;