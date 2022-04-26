<?php
namespace Modules\Chart;
use Modules\View as BaseView;

class View extends BaseView {
	public function __construct()
	{
		if(DEBUG)
		{
			echo 'Chart view construct</br>';
		}
	}
	
}

?>