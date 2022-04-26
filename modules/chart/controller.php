<?php
namespace Modules\Chart;
use Modules\Controller as BaseController;
class Controller extends BaseController {
	public function __construct(string $chart_func)
	{
		parent::__construct();
		
		if(DEBUG)
		{
			echo 'Chart construct</br>';
		}
		
		$this->active_page = 'chart';
		$this->view  = new View();
		
		$this->chart_func = $chart_func;
	}
	
	public function __toString() {
		$out = [];
		$out[] = '<div class="chart-container" chart-func="' . $this->chart_func . '">';
		$out[] = '<canvas class="chart">';
		$out[] = '</div>';
		
		return implode($out);
	}
}

?>