<?php
namespace Modules;

abstract class Controller {
	
	public function __construct()
	{
		if(DEBUG)
		{
			echo 'Base controller construct</br>';
		}
		
		$this->view  = new View();
		$this->model = new Model();
	}
	
	public function show()
	{
		$this->view->render();
	}
	
	public function show_message($message)
	{
		$this->view->render($message);
	}
	
	public function show_index()
	{
		$this->view->render('Index Rendered');
	}
}

?>