<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Trucking extends CI_Model
	{ 
		private $Id;
		private $Name;
		private $Address;
		private $Status;
		private $db_instance;

		public function __construct()
		{
			parent::__construct();
			//create Db_conncetion instance
			$this->load->model('Db_connection', 'con');
			$this->db_instance 	= $this->con->connect();
			$this->Id = null;
			$this->Name = null;
			$this->Address = null;
			$this->Status = 1;
		}

		public function setTrucking($Name, $Address, $Status)
		{
			$this->Name 	= $Name;
			$this->Address 	= $Address;
			$this->Status 	= $Status;
		}

		public function getName()
		{
			return $this->Name;
		}

		public function getAddress()
		{
			return $this->Address;
		}

		public function getStatus()
		{
			return $this->Status;
		}

		public function retrieve($sql)
		{
			return $this->db_instance->query($sql);
		}
	}
?>