<?php
namespace Modules;
use Inc\Database as Database;
use PDO;

class Model {
	public function __construct()
	{
		if(DEBUG)
		{
			echo 'Base model construct</br>';
		}
		
		$this->dbh = new Database();
		$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	protected function check_decimal($val)
	{
		$reg = '/[0-9]{1,}\.[0-9]{2}/';
		
		return(preg_match($reg, $val));
	}
	
	/**
	 * A generic add function
	 * - assumes data has already been checked to be correct for specified table
	 *
	 * @param string $table mySQL table name
	 * @param array $data assoc array of data to be inserted
	 */
	protected function add(string $table, array $data)
	{
		try {
			$sql = 'INSERT INTO `' . $table . '` (`' . implode('`, `', array_keys($data)) . '`)
					VALUES (:' . implode(', :', array_keys($data)) . ')';
			
			$stmt = $this->dbh->prepare($sql);
			
			foreach($data as $key => &$val)
			{
				$bind = ':' . $key;
				$stmt->bindParam($bind, $val);
			}
			
			$stmt->execute();
			
			if(!$stmt) {
				print_r($this->dbh->errorInfo());
			}
			
			return $this->dbh->lastInsertId();
			
		} catch (PDOException $e) {
			$e->getmessage();
		}
	}
	
	protected function update(string $table, int $id, array $data)
	{
		try {
			$sql = 'UPDATE `' . $table. '`
			SET ' . implode('=?, ', array_keys($data)). '=?
			WHERE id=?';
			
			$stmt = $this->dbh->prepare($sql);
			
			// Append ID to data so execute knows which entity to update
			$data['id'] = $id;
			
			$stmt->execute(array_values($data));
			
			if(!$stmt) {
				print_r($this->dbh->errorInfo());
			}
			
			// If we actually updated anything return success
			if($stmt->rowCount() > 0)
			{
				return true;
			}
			return false;
			
		} catch (PDOException $e) {
			$e->getmessage();
		}
	}
	
	protected function get(string $table, int $id = null)
	{
		try {
			$sql = 'SELECT * FROM `' . $table . '`';
			
			if(!is_null($id))
			{
				$sql = $sql . ' WHERE id = ' . $id;
			}
			
			$stmt = $this->dbh->prepare($sql);
			
			$stmt->execute();
			
			if(!$stmt) {
				print_r($this->dbh->errorInfo());
			}
			
			return $stmt->fetchAll();
			
		} catch(PDOException $e) {
			$e->getmessage();
		}
	}
}

?>