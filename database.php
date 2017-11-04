<?php


class Database{

	private $link;

	public function __construct()
	{
		$this->connection();
	}

	private function connection()
	{
		$config = require_once 'config.php';
		$dsn = 'mysql:host'.$config['host'].';dbname='.$config['database'].';charset='.$config['charset'];
		$opt = [
	        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        PDO::ATTR_EMULATE_PREPARES   => false,
	    ];
	    $this->link = new PDO($dsn, $config['username'], $config['passowrd'], $opt);
	   
	    return $this;
	} 

	public function execute($sql)
	{
		$stm = $this->link->prepare($sql);
		return $stm->execute();
	}

	public function query($sql)
	{
		$stm = $this->link->prepare($sql);
		$stm ->execute();
		$result = $stm->fetchAll(PDO::FETCH_ASSOC);
		if($result === false)
		{
			return [];
		}
		return $result;
	}

}

$db = new Database();
$sql = "INSERT INTO pdodb.users (name, email, password) VALUES ('Zhanuzak', 'kudaibergenov.zhanuzak@gmail.com', '123456789')";
$db->execute($sql);