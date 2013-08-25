<?php
 class Database {
 
	private $link;
	
	function connect() {
		if (!$this->link = mysql_connect('localhost', '', '')) {
			echo 'Could not connect to mysql';
			exit;
		}

		if (!mysql_select_db('test', $this->link)) {
			echo 'Could not select database';
			exit;
		}
	}
	
	function disconnect() {
		mysql_close($this->link);
	}
	
	public function getLink() {
		return $this->link;
	}
}
	
?>