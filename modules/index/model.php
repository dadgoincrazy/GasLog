<?php
namespace Modules\Index;
use Modules\Model as BaseModel;

class Model extends BaseModel {
	public function __construct()
	{
		if(DEBUG)
		{
			echo 'Index model construct</br>';
		}
	}
}

?>