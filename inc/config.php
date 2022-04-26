<?php
/***
 * Config file for GasLogbookDemo
 * Contains: Paths and Autoload configuration
 */

define('BASE_PATH',       $_SERVER['DOCUMENT_ROOT'] . '/GasLog/');
define('URL',             'http://localhost/GasLog/');
define('MODULES_PATH',    BASE_PATH . 'modules/');
define('INC_PATH',        BASE_PATH . 'inc/');
define('IMG_PATH',        BASE_PATH . 'img/');
define('TEMPLATES_PATH',  BASE_PATH . 'templates/');
define('UI_PATH',         BASE_PATH . 'ui/');
define('JS_PATH',         URL . 'js/');
define('CSS_PATH',        URL . 'css/');

//define('DEBUG', TRUE);
define('DEBUG', FALSE);

class Loaders
{
	// Module loader
	public static function ModuleLoader($className)
	{
		$file = BASE_PATH . str_replace("\\", DIRECTORY_SEPARATOR, $className) . '.php';
		if(file_exists($file))
		{
			include_once $file;
		} else {
			//new Modules\Error\controller("'" . $file . "' not found");
		}
		
	}
}

spl_autoload_register('Loaders::ModuleLoader');

if(DEBUG)
{
	echo 'Config loaded</br>';
}

?>