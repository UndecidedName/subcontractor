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

		public function __construct()
		{
			parent::__construct();
			$this->Id = null;
			$this->TruckingId = null;
			$this->Name = null;
			$this->Type = null;
			$this->Description = null;
			$this->Status = 1;
		}

		public function setTruck($Id, $TruckingId, $Name, $Type, $Description, $Status)
		{
			$this->Id 			= $Id;
			$this->TruckingId 	= $TruckingId;
			$this->Name 		= $Name;
			$this->Type 		= $Type;
			$this->Description 	= $Description;
			$this->Status 		= $Status;
		}

		public function getId()
		{
			return $this->Id;
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
				$sql = "UPDATE truck SET ";
				$sql = $sql."Name='".$this->getName()."',";	
				$sql = $sql."TruckingId='".$this->getTruckingId()."',";
				$sql = $sql."Type='".$this->getType()."',";
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
				$sql = "INSERT INTO truck(Name,Type,TruckingId,Description,Status) VALUES(";
				$sql = $sql."'".$this->getName()."',";	
				$sql = $sql."'".$this->getType()."',";	
				$sql = $sql."'".$this->getTruckingId()."',";
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
					$query = $this->db->query("SELECT * FROM truck WHERE Id=".$id);
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
				$file_path = array();
				$sql = "SELECT attachment.FilePath as FilePath FROM truck LEFT JOIN attachment ON truck.Id = attachment.ReferenceId WHERE truck.Id ='".$Id."'";
				$query = $this->db->query($sql);
				if($query)
				{
					file_put_contents(BASEPATH.'logs.txt', date("Y-m-d H:i:s")."\t".$sql."\n", FILE_APPEND);
					foreach ($query->result() as $row) {
						$file_path[] = $row->FilePath;
					}
					$sql = "DELETE truck, attachment FROM truck LEFT JOIN attachment ON truck.Id = attachment.ReferenceId WHERE truck.Id ='".$Id."'";
					//Execute query
					$query = $this->db->query($sql);
					if($query)
					{
						file_put_contents(BASEPATH.'logs.txt', date("Y-m-d H:i:s")."\t".$sql."\n", FILE_APPEND);
						$this->db->close();
						for($i = 0; $i < sizeof($file_path); $i++)
						{
							if($file_path[$i] != "")
								unlink($file_path[$i]);
						}
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