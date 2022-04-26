<?php
namespace Modules\Index;
use Modules\Controller as BaseController;
class Controller extends BaseController {
	public function __construct()
	{
		parent::__construct();
		
		if(DEBUG)
		{
			echo 'Index construct</br>';
		}
		
		$this->active_page = 'index';
		$this->view  = new View();
		$this->model = new Model();
	}
	
	public function show_index()
	{
		$this->view->render($this->active_page, 'Index Index Render');
	}
}

?>