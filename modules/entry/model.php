<?php
namespace Modules\Entry;
use Modules\Model as BaseModel;

class Model extends BaseModel {
	public function __construct()
	{
		parent::__construct();
		if(DEBUG)
		{
			echo 'Entry model construct</br>';
		}
		
		$this->table = 'entry';
	}
	
	public function check_validity($data)
	{
		$blueprint = [
			'cost' => 'decimal',
			'amount' => 'decimal',
			'kilos' => 'integer',
			'location' => 'string',
			'date_purchased' => 'timestamp'
		];
		
		$data_keys = array_keys($data);
		$keys_required = array_intersect_key($blueprint, $data);
		
		if(count($data_keys) == count($keys_required))
		{
			foreach($blueprint as $key => $check)
			{
				switch($check) {
					case 'decimal':
						if(!$this->check_decimal($data[$key]))
						{
							return false;
						}
						break;
					case 'integer':
						if(!is_numeric($data[$key]))
						{
							return false;
						}
						break;
					case 'string':
						if(!is_string($data[$key]))
						{
							return false;
						}
						break;
					case 'timestamp':
						if(!is_string($data[$key]))
						{
							return false;
						}
						break;
				}
			}
			return true;
		}
		
		return false;
	}
	
	public function add_entry(array $data)
	{
		// Check validity
		if($this->check_validity($data))
		{
			return $this->add($this->table, $data);
		} else {
			// Invalid, ignore
			print_r('Invalid');
		}
	}
	
	public function edit_entry(int $id, array $data)
	{
		// Check validity
		if($this->check_validity($data))
		{
			return $this->update($this->table, $id, $data);
		} else {
			// Invalid, ignore
			print_r('Invalid');
		}
	}
	
	public function get_entries()
	{
		return $this->get($this->table);
	}
	
	public function get_entry(int $id)
	{
		return $this->get($this->table, $id);
	}
}

?>