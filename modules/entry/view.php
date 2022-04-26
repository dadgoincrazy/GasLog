<?php
namespace Modules\Entry;
use Modules\View as BaseView;
use UI\Forms\EntryForm as EntryForm;
use Modules\Chart\controller as Chart;

class View extends BaseView {
	public function __construct()
	{
		if(DEBUG)
		{
			echo 'Entry view construct</br>';
		}
	}
	
	public function msg_add_entry_success()
	{
		$class = 'msg-success';
		return $this->msg('Successfully Added Entry', $class);
	}
	
	public function msg_add_entry_failure()
	{
		$class = 'msg-error';
		return $this->msg('Error Adding Entry', $class);
	}
	
	public function msg_edit_entry_success()
	{
		$class = 'msg-success';
		return $this->msg('Successfully Edited Entry', $class);
	}
	
	public function msg_edit_entry_failure()
	{
		$class = 'msg-error';
		return $this->msg('Error Editing Entry', $class);
	}
	
	public function msg_entry_not_found()
	{
		$class = 'msg-error';
		return $this->msg('Error Entry Not Found', $class);
	}
	
	public function get_entries_table(array $entries)
	{
		$table = [];
		
		$table[] = "<div class='entries-table-container'>";
		
		$table[] = "<table id='entries-table'>";
		$table[] = "<thead>";
		$table[] = "<tr>";
		
		$table[] = "<th></th>";
		$table[] = "<th>Cost</th>";
		$table[] = "<th>Amount</th>";
		$table[] = "<th>Kilos</th>";
		$table[] = "<th>Location</th>";
		$table[] = "<th>Date Purchased</th>";
		$table[] = "<th>Date Entered</th>";
		$table[] = "<th>Date Updated</th>";
		
		$table[] = "</tr>";
		$table[] = "</thead>";
		
		$table[] = "<tbody>";
		
		foreach($entries as $entry)
		{
			$table[] = "<tr>";
			
			$table[] = "<td><a href='/GasLog/Entry/edit/{$entry['id']}'>" .
			'<svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" width="20" height="20"><path d="M.5 10.5l-.354-.354-.146.147v.207h.5zm10-10l.354-.354a.5.5 0 00-.708 0L10.5.5zm4 4l.354.354a.5.5 0 000-.708L14.5 4.5zm-10 10v.5h.207l.147-.146L4.5 14.5zm-4 0H0a.5.5 0 00.5.5v-.5zm.354-3.646l10-10-.708-.708-10 10 .708.708zm9.292-10l4 4 .708-.708-4-4-.708.708zm4 3.292l-10 10 .708.708 10-10-.708-.708zM4.5 14h-4v1h4v-1zm-3.5.5v-4H0v4h1z" fill="currentColor"></path></svg>'
			. "</a></td>";
			$table[] = "<td>" . $this->display_money($entry['cost']) . "</td>";
			$table[] = "<td>" . $entry['amount'] . "</td>";
			$table[] = "<td>" . $this->display_km($entry['kilos']) . "</td>";
			$table[] = "<td>" . $entry['location'] . "</td>";
			$table[] = "<td>" . $this->display_date($entry['date_purchased']) . "</td>";
			$table[] = "<td>" . $this->display_date($entry['date_entered']) . "</td>";
			$table[] = "<td>" . $this->display_date($entry['date_edited']) . "</td>";
			
			$table[] = "</tr>";
		}
		
		$table[] = "</tbody>";
		
		$table[] = "</table>";
		
		$table[] = "</div>";
		
		return implode($table);
	}
	
	public function entry_form(array $data = array())
	{
		$form = new EntryForm($data);
		return $form;
	}
	
	public function kilos_per_litre_chart(int $num_months = 3)
	{
		$chart_func = 'Entry/kilo_per_litre_chart_data/'.$num_months;
		$chart = new Chart($chart_func);
		
		return $chart;
	}
	
}

?>