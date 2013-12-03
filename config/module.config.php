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
);

return $config;