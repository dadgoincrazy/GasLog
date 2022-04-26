<?php
// Defines all the paths and spl autoload to auto load modules
include_once('inc/config.php');

// Splitting the request we've gotten from .htaccess
$url = isset($_GET['url']) ? $_GET['url'] : null;
$url = rtrim($url, '/');
$url = explode('/',  $url);

// If we have a url from .htaccess : Use it to build the request
// Else if it's just the base url  : Load the index controller
if(!empty($url[0])) {
	$module     = 'Modules\\' . $url[0] . '\\controller';
	$controller = new $module();
} else {
	$controller = new Modules\Index\controller();
}

// If the url looks like site/module/function/param : Call module->function(param)
// Else if it looks like site/module/function       : Call module->function()
// Else if it looks like site/module                : Call module->show_index()
if(isset($url[1]))
{
	$function = strtolower($_SERVER['REQUEST_METHOD']) . '_' . $url[1];
}

if(isset($url[2]))
{
	$param = $url[2];
}

if(isset($param))
{
	$controller->{$function}($param);
} else if(isset($function)) {
	$controller->{$function}();
} else {
	$controller->show_index();
}

?>