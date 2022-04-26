<?php
namespace Modules\Entry;
use Modules\Controller as BaseController;
use Modules\Error\Controller as Error;

class Controller extends BaseController {
	public function __construct()
	{
		parent::__construct();
		if(DEBUG)
		{
			echo 'Entry construct</br>';
		}
		
		$this->active_page = 'entry';
		$this->view  = new View();
		$this->model = new Model();
	}
	
	/**
	 * GasLog/Entry
	 * An index page for entries
	 */
	public function show_index()
	{
		$html = [];
		$chart = $this->view->kilos_per_litre_chart();
		$html[] = $chart;
		
		$this->view->render($this->active_page, implode($html));
	}
	
	/**
	 * GasLog/Entry/add
	 * @param string $msg A msg to be displayed with the page
	 */
	public function get_add(string $msg = null)
	{
		$html = [];
		
		if(!is_null($msg))
		{
			$html[] = $msg;
		}
		
		$html[] = $this->view->entry_form(); // file_get_contents(UI_PATH . '/forms/entry.html');
		
		$this->view->render($this->active_page, implode($html));
	}
	
	/**
	 * GasLog/Entry/add
	 * Saves an entry posted to add, if it passes database validation
	 * Adds result msg and redirects to GasLog/Entry/add
	 */
	public function post_add()
	{	
		$res = $this->model->add_entry($_POST);
		
		if($res > 0)
		{
			// On entry success
			$msg = $this->view->msg_add_entry_success();
		} else {
			// On entry failure
			$msg = $this->view->msg_add_entry_failure();
		}
		
		$this->get_add($msg);
	}
	
	public function get_view_all()
	{
		$html = [];
		
		$entries = $this->model->get_entries();
		
		$table = $this->view->get_entries_table($entries);
		
		$html[] = $table;
		
		$this->view->render($this->active_page, implode($html));
	}
	
	public function get_edit(int $id, string $msg = null)
	{
		$html = [];
		
		$entry = $this->getEntry($id);
		
		if(empty($entry))
		{
			$msg = $this->view->msg_entry_not_found($msg);
			$error = new Error($msg);
			exit;
		}
		
		if(!is_null($msg))
		{
			$html[] = $msg;
		}
		
		$html[] = $this->view->entry_form($entry);
		
		$this->view->render($this->active_page, implode($html));
	}
	
	public function post_edit(int $id)
	{
		$res = $this->model->edit_entry($id, $_POST);
		
		if($res > 0)
		{
			// On entry success
			$msg = $this->view->msg_edit_entry_success();
		} else {
			// On entry failure
			$msg = $this->view->msg_edit_entry_failure();
		}
		
		$this->get_edit($id, $msg);
	}
	
	public function getEntry(int $id = null)
	{
		//$this->show_message('Get entry: ' . $id);
		if(is_null($id))
		{
			$entry = $this->model->get_latest_entry();
		} else if(is_int($id)) {
			$entry = $this->model->get_entry($id);
			if(!empty($entry))
			{ 
				$entry = $entry[0];
			}
		}
		
		return $entry;
	}
	
	public function get_kilo_per_litre_chart_data(int $num_months = 3)
	{
		// Return data for chart
		$data = [];
		$data['labels'] = [];
		
		// Kilos
		$data['kilos']['label']           = 'Kilometres';
		$data['kilos']['data']            = [];
		$data['kilos']['backgroundColor'] = 'rgba(56, 246, 137, 0.8)';
		$data['kilos']['borderColor']     = 'rgba(56, 246, 137, 0.8)';
		$data['kilos']['fill']            = 'false';
		
		// Cost
		$data['cost']['label']           = 'Cost';
		$data['cost']['data']            = [];
		$data['cost']['backgroundColor'] = 'rgba(233, 180, 76, 0.8)';
		$data['cost']['borderColor']     = 'rgba(233, 180, 76, 0.8)';
		$data['cost']['fill']            = 'false';
		
		// Litres
		$data['litres']['label']           = 'Litres';
		$data['litres']['data']            = [];
		$data['litres']['backgroundColor'] = 'rgba(141, 228, 255, 0.8)';
		$data['litres']['borderColor']     = 'rgba(141, 228, 255, 0.8)';
		$data['litres']['fill']            = 'false';
		
		// Timeframe for data
		$today = date('yy-m-d');
		$past  = date('yy-m-d' ,strtotime('-'.$num_months.' months', time()));
		
		// Get all entries purchased within timeframe, ordered by date purchased then kilos
		// Currently gets all entries unordered
		$entries = $this->model->get_entries();
		
		// Loop over entries and get each data point
		$previous_kilos = 0;
		foreach($entries as $entry)
		{
			$data['labels'][] = explode(' ', $entry['date_purchased'])[0];
			$data['kilos']['data'][]    = $entry['kilos'] - $previous_kilos;
			$data['cost']['data'][]     = $entry['cost'];
			$data['litres']['data'][]   = $entry['amount'];
			
			$previous_kilos = $entry['kilos'];
		}
		
		echo json_encode($data);
	}

}

?>