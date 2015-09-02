<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Vessel_voyage extends CI_Model
	{
		private $Id;
		private $VesselId;
		private $EstimatedDeparture;
		private $EstimatedArrival;
		private $Departure;
		private $Arrival;
		private $Status;
		private $db_instance;

		public function __construct()
		{
			parent::__construct();
			//create Db_conncetion instance
			$this->load->model('Db_connection', 'con');
			$this->db_instance 	= $this->con->connect();
			$this->id 					= null;
			$this->VesselId				= null;
			$this->EstimatedDeparture	= null;
			$this->EstimatedArrival		= null;
			$this->Departure 			= null;
			$this->Arrival 				= null;
			$this->Status 				= 1;
		}

		public function setVesselVoyage($Id ,$VesselId, $EstimatedDeparture, $EstimatedArrival, $Departure, $Arrival, $Status)
		{
			$this->id 					= $Id;
			$this->VesselId				= $VesselId;
			$this->EstimatedDeparture	= $EstimatedDeparture;
			$this->EstimatedArrival		= $EstimatedArrival;
			$this->Departure 			= $Departure;
			$this->Arrival 				= $Arrival;
			$this->Status 				= $Status;
		}

		public function getId()
		{
			return $this->Id;
		}

		public function getVesselId()
		{
			return $this->VesselId;
		}

		public function getEstimatedDeparture()
		{
			return $this->EstimatedDeparture;
		}

		public function getEstimatedArrival()
		{
			return $this->EstimatedArrival;
		}

		public function getDeparture()
		{
			return $this->Departure;
		}

		public function getArrival()
		{
			return $this->Arrival;
		}

		public function getStatus()
		{
			return $this->Status;
		}

		public function retrieve($sql)
		{
			if($this->db_instance == true)
			{
				$query = $this->db_instance->query($sql);
				if(!$this->db_instance->error)
				{
					$this->con->disconnect($this->db_instance);
					file_put_contents(BASEPATH.'logs.txt', date("Y-m-d H:i:s")."\t".$sql."\n", FILE_APPEND);
					return $query;
				}
				else
				{
					file_put_contents(BASEPATH.'error.txt', date("Y-m-d H:i:s")."\t".$this->db_instance->error."\n", FILE_APPEND);
					$this->con->disconnect($this->db_instance);
					return false;
				}
			}
			else
				return false;
		}

		public function edit()
		{
			if($this->db_instance == true)
			{
				$sql = "UPDATE vesselvoyage SET ";
				$sql = $sql."VesselId='".$this->getVesselId()."',";	
				$sql = $sql."EstimatedDeparture='".$this->getEstimatedDeparture()."',";
				$sql = $sql."EstimatedArrival='".$this->getEstimatedArrival()."',";
				$sql = $sql."Departure='".$this->getDeparture()."',";
				$sql = $sql."Arrival='".$this->getArrival()."',";
				$sql = $sql."Status='".$this->getStatus()."' ";
				$sql = $sql."WHERE Id='".$this->getId()."'";
				//Execute query
				$query = $this->db_instance->query($sql);
				if(!$this->db_instance->error)
				{
					$this->con->disconnect($this->db_instance);
					file_put_contents(BASEPATH.'logs.txt', date("Y-m-d H:i:s")."\t".$sql."\n", FILE_APPEND);
					return $query;
				}
				else
				{
					file_put_contents(BASEPATH.'error.txt', date("Y-m-d H:i:s")."\t".$this->db_instance->error."\n", FILE_APPEND);
					$this->con->disconnect($this->db_instance);
					return false;
				}
			}
			else
			{
				file_put_contents(BASEPATH.'error.txt',  date("Y-m-d H:i:s")."\t".$this->db_instance->error."\n", FILE_APPEND);
				$this->con->disconnect($this->db_instance);
				return false;
			}
		}

		public function save()
		{
			if($this->db_instance == true)
			{
				$sql = "INSERT INTO vesselvoyage(VesselId,EstimatedDeparture,EstimatedArrival,Departure,Arrival,Status) VALUES(";
				$sql = $sql."'".$this->getVesselId()."',";	
				$sql = $sql."'".$this->getEstimatedDeparture()."',";
				$sql = $sql."'".$this->getEstimatedArrival()."',";
				$sql = $sql."'".$this->getDeparture()."',";
				$sql = $sql."'".$this->getArrival()."',";
				$sql = $sql."'".$this->getStatus()."')";
				//Execute query
				$query = $this->db_instance->query($sql);
				if(!$this->db_instance->error)
				{
					//get record id of the latest inserted information
					$getId = $this->db_instance->query("SELECT LAST_INSERT_ID()");

					while($row = $getId->fetch_assoc())
					{
						$id = $row['LAST_INSERT_ID()']; 
					}

					//Retrieve the last inserted data
					$query = $this->db_instance->query("SELECT * FROM vesselvoyage WHERE Id=".$id);
					$this->con->disconnect($this->db_instance);
					file_put_contents(BASEPATH.'logs.txt', date("Y-m-d H:i:s")."\t".$sql."\n", FILE_APPEND);
					return $query;
				}
				else
				{
					file_put_contents(BASEPATH.'error.txt',  date("Y-m-d H:i:s")."\t".$this->db_instance->error."\n", FILE_APPEND);
					$this->con->disconnect($this->db_instance);
					return false;
				}
			}
			else
			{
				file_put_contents(BASEPATH.'error.txt',  date("Y-m-d H:i:s")."\t".$this->db_instance->error."\n", FILE_APPEND);
				$this->con->disconnect($this->db_instance);
				return false;
			}
		}

		public function delete($Id)
		{
			if($this->db_instance == true)
			{
				$sql = "DELETE FROM vesselvoyage WHERE Id='".$Id."'";
				//Execute query
				$query = $this->db_instance->query($sql);
				if(!$this->db_instance->error)
				{
					$this->con->disconnect($this->db_instance);
					file_put_contents(BASEPATH.'logs.txt', date("Y-m-d H:i:s")."\t".$sql."\n", FILE_APPEND);
					return $query;
				}
				else
				{
					file_put_contents(BASEPATH.'error.txt', date("Y-m-d H:i:s")."\t".$this->db_instance->error."\n", FILE_APPEND);
					$this->con->disconnect($this->db_instance);
					return false;
				}
			}
			else
			{
				file_put_contents(BASEPATH.'error.txt',  date("Y-m-d H:i:s")."\t".$this->db_instance->error."\n", FILE_APPEND);
				$this->con->disconnect($this->db_instance);
				return false;
			}
		}
	}
?>