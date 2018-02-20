<?php

class dbConfig {

	public $host;
	public $db;
	public $user;
	public $pass;

	function __construct(){
		$this->host = '127.0.0.1';
		$this->db  = 'todo';
		$this->user  = 'root';
		$this->pass = '';
	}

}

?>