<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Db_connection extends CI_Model
	{
		private $server;
		private $username;
		private $password;
		private $db;

		public function __construct()
		{
			parent::__construct();
			$this->server = 'localhost';
			$this->username = 'root';
			$this->password = '';
			$this->db = 'subcontractor';
		}

		public function setConnection($server, $username, $password, $db)
		{
			$this->server 	= $server;
			$this->username = $username;
			$this->password = $password;
			$this->db 		= $db;
		}

		public function connect()
		{
			return mysqli_connect($this->server, $this->username, $this->password, $this->db);
		}

		public function disconnect($db_instance)
		{
			mysqli_close($db_instance);
		}
		public function query($sql)
		{
			return mysqli_query($this->connect, $sql);
		}
	}
?>