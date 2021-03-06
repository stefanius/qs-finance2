<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */

    Router::connect('/caketools/sessiondata/view/*', array('plugin' => 'CakeTools', 'controller' => 'sessiondata', 'action' => 'view'));
    Router::connect('/caketools/sessiondata', array('plugin' => 'CakeTools', 'controller' => 'sessiondata', 'action' => 'index'));
    Router::connect('/caketools/sessiondata/view/*', array('plugin' => 'CakeTools', 'controller' => 'sessiondata', 'action' => 'view'));

    Router::connect('/users/:action', array('plugin' => 'CakeTools', 'controller' => 'users'));
    Router::connect('/users', array('plugin' => 'CakeTools', 'controller' => 'users', 'action' => 'index'));

    Router::connect('/search', array('controller' => 'search'));

    Router::connect('/instellingen/grootboek-rekeningen/:action/*', array('controller' => 'grootboeks'));
    Router::connect('/instellingen/grootboek-rekeningen', array('controller' => 'grootboeks', 'action' => 'index'));

    Router::connect('/instellingen/wachtwoord-wijzigen', array('controller' => 'users', 'action' => 'changepassword'));

    Router::connect('/balans/:bookyear_key/kolombalans', array('controller' => 'balans', 'action' => 'kolombalans'));

    Router::connect('/balans/:bookyear_key/boeking/*', array('controller' => 'calculations', 'action' => 'crossbooking'));

    Router::connect('/balans/:bookyear_key/journaal/*', array('controller' => 'calculations', 'action' => 'viewbyhash'));

    Router::connect('/start-nieuw-bookjaar', array('controller' => 'bookyears', 'action' => 'newbookyear'));

    Router::connect('/balans/:bookyear_key/rekening/:rekeningnummer', array('controller' => 'grootboeks', 'action'=>'open'));

    Router::connect('/balans/:bookyear_key/import/:source/:type', array('controller' => 'calculations', 'action'=>'import'));

    Router::connect('/balans/:bookyear_key/export/excel/balans/', array('controller' => 'exportexcel', 'action'=>'balans'));
    Router::connect('/balans/:bookyear_key/export/excel/kolombalans/', array('controller' => 'exportexcel', 'action'=>'kolombalans'));

    Router::connect('/balans/:bookyear_key/saldo-overzicht/resultaatposten/', array('controller' => 'grootboeks', 'action'=>'overzicht' ,1));

    Router::connect('/balans/:bookyear_key', array('controller' => 'balans'));

    Router::connect('/balans/:bookyear_key/saldo-overzicht/balansposten/', array('controller' => 'grootboeks', 'action'=>'overzicht' ,0));

    Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));

    Router::parseExtensions();

/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
    Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
    CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
    require CAKE . 'Config' . DS . 'routes.php';
