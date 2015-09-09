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
			$this->Id 					= null;
			$this->VesselId				= null;
			$this->EstimatedDeparture	= null;
			$this->EstimatedArrival		= null;
			$this->Departure 			= null;
			$this->Arrival 				= null;
			$this->Status 				= 1;
		}

		public function setVesselVoyage($Id ,$VesselId, $EstimatedDeparture, $EstimatedArrival, $Departure, $Arrival, $Status)
		{
			$this->Id 					= $Id;
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
			if($this->db->conn_id)
			{
				$query = $this->db->query($sql);
				if($query)
				{
					file_put_contents(BASEPATH.'logs.txt', date("Y-m-d H:i:s")."\t".$sql."\n", FILE_APPEND);
					$this->db->close();
					return $query;
				}
				else
				{
					$error = $this->db->error();
		 			file_put_contents(BASEPATH.'error.txt', date("Y-m-d H:i:s")."\t".$error['message']."\n", FILE_APPEND);
					$this->db->close();
					return false;
				}
			}
			else
				return false;
		}

		public function edit()
		{
			if($this->db->conn_id)
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
				$query = $this->db->query($sql);
				if($query)
				{
					file_put_contents(BASEPATH.'logs.txt', date("Y-m-d H:i:s")."\t".$sql."\n", FILE_APPEND);
					$this->db->close();
					return $query;
				}
				else
				{
					$error = $this->db->error();
		 			file_put_contents(BASEPATH.'error.txt', date("Y-m-d H:i:s")."\t".$error['message']."\n", FILE_APPEND);
					$this->db->close();
					return false;
				}
			}
			else
			{
				$error = $this->db->error();
	 			file_put_contents(BASEPATH.'error.txt', date("Y-m-d H:i:s")."\t".$error['message']."\n", FILE_APPEND);
				$this->db->close();
				return false;
			}
		}

		public function save()
		{
			if($this->db->conn_id)
			{
				$sql = "INSERT INTO vesselvoyage(VesselId,EstimatedDeparture,EstimatedArrival,Departure,Arrival,Status) VALUES(";
				$sql = $sql."'".$this->getVesselId()."',";	
				$sql = $sql."'".$this->getEstimatedDeparture()."',";
				$sql = $sql."'".$this->getEstimatedArrival()."',";
				$sql = $sql."'".$this->getDeparture()."',";
				$sql = $sql."'".$this->getArrival()."',";
				$sql = $sql."'".$this->getStatus()."')";
				//Execute query
				$query = $this->db->query($sql);
				if($query)
				{
					//get record id of the latest inserted information
					$getId = $this->db->query("SELECT LAST_INSERT_ID()");

					foreach($getId->result_array() as $row)
					{
						$id = $row['LAST_INSERT_ID()']; 
					}

					//Retrieve the last inserted data
					$query = $this->db->query("SELECT * FROM vesselvoyage WHERE Id=".$id);
					file_put_contents(BASEPATH.'logs.txt', date("Y-m-d H:i:s")."\t".$sql."\n", FILE_APPEND);
					$this->db->close();
					return $query;
				}
				else
				{
					$error = $this->db->error();
		 			file_put_contents(BASEPATH.'error.txt', date("Y-m-d H:i:s")."\t".$error['message']."\n", FILE_APPEND);
					$this->db->close();
					return false;
				}
			}
			else
			{
				$error = $this->db->error();
	 			file_put_contents(BASEPATH.'error.txt', date("Y-m-d H:i:s")."\t".$error['message']."\n", FILE_APPEND);
				$this->db->close();
				return false;
			}
		}

		public function delete($Id)
		{
			if($this->db->conn_id)
			{
				$sql = "DELETE FROM vesselvoyage WHERE Id='".$Id."'";
				//Execute query
				$query = $this->db->query($sql);
				if($query)
				{
					file_put_contents(BASEPATH.'logs.txt', date("Y-m-d H:i:s")."\t".$sql."\n", FILE_APPEND);
					$this->db->close();
					return $query;
				}
				else
				{
					$error = $this->db->error();
		 			file_put_contents(BASEPATH.'error.txt', date("Y-m-d H:i:s")."\t".$error['message']."\n", FILE_APPEND);
					$this->db->close();
					return false;
				}
			}
			else
			{
				$error = $this->db->error();
	 			file_put_contents(BASEPATH.'error.txt', date("Y-m-d H:i:s")."\t".$error['message']."\n", FILE_APPEND);
				$this->db->close();
				return false;
			}
		}
	}
?>