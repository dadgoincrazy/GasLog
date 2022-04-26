<?php
namespace Modules\Error;
use Modules\Controller as BaseController;
use Modules\View as BaseView;

class Controller extends BaseController {
	public function __construct($msg = 'Whoops! Something went wrong')
	{
		parent::__construct();
		
		if(DEBUG)
		{
			echo 'Error construct</br>';
		}
		
		$this->active_page = 'error';
		$this->view = new BaseView();
		
		$this->show_error($msg);
	}
	
	public function show_error($msg)
	{
		$html = [];
		$html[] = $msg;
		$html[] = 'Whoops! Something went wrong';
		
		$this->view->render($this->active_page, implode($html));
	}
}

?>