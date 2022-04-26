<?php
namespace UI\Forms;

class EntryForm {
	public $id;
	public $cost;
	public $amount;
	public $kilos;
	public $location;
	public $date_purchased;
	
	public function __construct(array $data = [])
	{
		if(isset($data['id']))
			$this->id = $data['id'];
		
		if(isset($data['cost']))
			$this->cost = $data['cost'];
			
		if(isset($data['amount']))
			$this->amount = $data['amount'];
			
		if(isset($data['kilos']))
			$this->kilos = $data['kilos'];
			
		if(isset($data['location']))
			$this->location = $data['location'];
			
		if(isset($data['date_purchased']))
			$this->date_purchased = $data['date_purchased'];
	}
	
	public function __toString()
	{
		ob_start();
?>
<div class='entry-form-container'>
	<?php if(!isset($this->id)): ?>
	<h1>Add an Entry</h1></br>
	<?php else: ?>
	<h1>Edit an Entry</h1></br>
	<?php endif; ?>
	
	<form id='entry-form' method='post'>
		<div class='input-container'>
			<label for='cost'>Cost</label>
			<input type='text'
				   name='cost'
				   <?php if(is_numeric($this->cost)): ?>
				   value='<?=$this->cost?>'
				   <?php endif; ?>
				   id='form-cost'
				   class='input-money'
				   pattern='[0-9]{1,}\.[0-9]{2}'
				   placeholder='0.00'
				   required>
			<br><br>
		</div>
		
		<div class='input-container'>
			<label for='amount'>Fuel Amount</label>
			<input type='text'
			       name='amount'
				   <?php if(is_numeric($this->amount)): ?>
				   value='<?=$this->amount?>'
				   <?php endif; ?>
				   id='form-amount'
				   class='input-decimal'
				   pattern='[0-9]{1,}\.[0-9]{2}'
				   placeholder='0.00'
				   required>
			<br><br>
		</div>
		
		<div class='input-container'>
			<label for='kilos'>Kilos</label>
			<input type='number'
			       name='kilos'
				   <?php if(is_numeric($this->kilos)): ?>
				   value='<?=$this->kilos?>'
				   <?php endif; ?>
				   id='form-kilos'
				   required>
			<br><br>
		</div>
		
		<div class='input-container'>
			<label for='location'>Location</label>
			<input type='text'
			       name='location'
				   <?php if(is_string($this->location)): ?>
				   value='<?=$this->location?>'
				   <?php endif; ?>
				   id='form-location'
				   required>
			<br><br>
		</div>
		
		<div class='input-container'>
			<label for='date_purchased'>Date Purchased</label>
			<input type='date'
			       name='date_purchased'
				   <?php if(!empty($this->date_purchased)): ?>
				   value='<?=explode(' ', $this->date_purchased)[0]?>'
				   <?php endif; ?>
				   id='form-date'
				   class='date'
				   required>
			<br><br>
		</div>
		
		</br>
		<?php if($this->id): ?>
		<button type="submit">Save Entry</button>
		<?php else: ?>
		<button type="submit">Add Entry</button>
		<?php endif; ?>
	</form>
</div>
	<?php
		return ob_get_clean();
	}

}