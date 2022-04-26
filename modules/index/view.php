<?php
namespace Modules\Index;
use Modules\View as BaseView;

class View extends BaseView {
	public function __construct()
	{
		if(DEBUG)
		{
			echo 'Index view construct</br>';
		}
	}
	
}

?>