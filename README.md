JHttps
======
This module allow you to force zf2 routing to https scheme for some route you decide.

You can find italian instructions [here](http://stefanorg.github.io/articles/jhttps-zf2-https-module)

== Installation

* download with composer `php composer.phar require stefanorg/jhttps:dev-master`
* enable it in your application.config.php
* copy file `vendor/stefanorg/jhttps/config/jhttps.config.global.php.dist` to `config/autoload/jhttps.config.global.php` and edit as you wish

== Options
* force_http_for_non_https_route: true if you want to redirect navigation to normal http if the requested route is not forced to be https

== Example
If you want to enable https for route `zfcuser/login` (you have the zfc-user module installed didn't you?!?) modify `jhttps.config.global.php` like this:

<pre>
	/**
     * If you want reset to http scheme for non https route
     */
    'force_http_for_non_https_route' => true,
	'routes' => array(
        //enable https for user login page
        'zfcuser/login'
    )
</pre>