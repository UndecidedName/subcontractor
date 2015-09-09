<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Vessel extends CI_Model
	{
		private $Id;
		private $ShippingLineId;
		private $Name;
		private $Description;
		private $Status;

		public function __construct()
		{
			parent::__construct();
			$this->Id 				= null;
			$this->ShippingLineId 	= null;
			$this->Name 			= null;
			$this->Description 		= null;
			$this->Status 			= 1;
		}

		public function setVessel($Id, $ShippingLineId, $Name, $Description, $Status) 
		{
			$this->Id 				= $Id;
			$this->ShippingLineId 	= $ShippingLineId;
			$this->Name 			= $Name;
			$this->Description 		= $Description;
			$this->Status 			= $Status;
		}

		public function getId()
		{
			return $this->Id;
		}

		public function getShippingLineId()
		{
			return $this->ShippingLineId;
		}

		public function getName()
		{
			return $this->Name;
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
				$sql = "UPDATE vessel SET ";
				$sql = $sql."Name='".$this->getName()."',";	
				$sql = $sql."ShippingLineId='".$this->getShippingLineId()."',";
				$sql = $sql."Description='".$this->getDescription()."',";
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
				$sql = "INSERT INTO vessel(Name,ShippingLineId,Description,Status) VALUES(";
				$sql = $sql."'".$this->getName()."',";	
				$sql = $sql."'".$this->getShippingLineId()."',";
				$sql = $sql."'".$this->getDescription()."',";
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
					$query = $this->db->query("SELECT * FROM vessel WHERE Id=".$id);
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
				//$sql = "DELETE FROM vessel WHERE Id='".$Id."'";
				$sql = "DELETE vessel, vesselvoyage, attachment FROM vessel LEFT JOIN vesselvoyage ON vessel.Id = vesselvoyage.VesselId LEFT JOIN attachment ON vessel.Id = attachment.ReferenceId WHERE vessel.Id ='".$Id."'";
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