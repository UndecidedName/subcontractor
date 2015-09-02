<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Truck extends CI_Model
	{
		private $Id;
		private $TruckingId;
		private $Name;
		private $Type;
		private $Description;
		private $Status;
		private $db_instance;

		public function __construct()
		{
			parent::__construct();//create Db_conncetion instance
			$this->load->model('Db_connection', 'con');
			$this->db_instance 	= $this->con->connect();
			$this->Id = null;
			$this->TruckingId = null;
			$this->Name = null;
			$this->Type = null;
			$this->Description = null;
			$this->Status = 1;
		}

		public function setTruck($TruckingId, $Name, $Type, $Description, $Status)
		{
			$this->TruckingId 	= $TruckingId;
			$this->Name 		= $Name;
			$this->Type 		= $Type;
			$this->Description 	= $Description;
			$this->Status 		= $Status;
		}

		public function getTruckingId()
		{
			return $this->TruckingId;
		}

		public function getName()
		{
			return $this->Name;
		}

		public function getType()
		{
			return $this->Type;
		}

		public function getDescription()
		{
			return $this->Description;
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