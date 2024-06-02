<?php
use SFM\Router\Router;
use SFM\Plugins\PluginManager;

require dirname(__DIR__).'/lib/autoload.php';
require dirname(__DIR__, 1).'/config/routes.php';

new Router();
/**
 * Chargement auto des plugins avec la classe PluginManager
 */
PluginManager::loadPlugins();