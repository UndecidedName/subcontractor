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
			//create Db_conncetion instance
			$this->load->model('Db_connection', 'con');
			$this->db_instance 	= $this->con->connect();
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
				$sql = "UPDATE vessel SET ";
				$sql = $sql."Name='".$this->getName()."',";	
				$sql = $sql."ShippingLineId='".$this->getShippingLineId()."',";
				$sql = $sql."Description='".$this->getDescription()."',";
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
				$sql = "INSERT INTO vessel(Name,ShippingLineId,Description,Status) VALUES(";
				$sql = $sql."'".$this->getName()."',";	
				$sql = $sql."'".$this->getShippingLineId()."',";
				$sql = $sql."'".$this->getDescription()."',";
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
					$query = $this->db_instance->query("SELECT * FROM vessel WHERE Id=".$id);
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
				$sql = "DELETE FROM vessel WHERE Id='".$Id."'";
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