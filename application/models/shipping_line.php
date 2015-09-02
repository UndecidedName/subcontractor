<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Shipping_line extends CI_Model
	{
		private $Id;
		private $Name;
		private $Address;
		private $Status;
		private $db_instance;

		public function __construct(){
			parent::__construct();
			//create Db_conncetion instance
			$this->load->model('Db_connection', 'con');
			$this->db_instance 	= $this->con->connect();
			$this->Id 			= null;
			$this->Name 		= null;
			$this->Address 		= null;
			$this->Status 		= 1;
		}

		public function setShippingLine($Id, $Name, $Address, $Status)
		{
			$this->Id 		= $Id;
			$this->Name 	= $Name;
			$this->Address 	= $Address;
			$this->Status 	= $Status;
		}

		public function getId()
		{
			return $this->Id;
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
				$sql = "UPDATE shippingline SET ";
				$sql = $sql."Name='".$this->getName()."',";	
				$sql = $sql."Address='".$this->getAddress()."',";
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
				$sql = "INSERT INTO shippingline(Name,Address,Status) VALUES(";
				$sql = $sql."'".$this->getName()."',";	
				$sql = $sql."'".$this->getAddress()."',";
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
					$query = $this->db_instance->query("SELECT * FROM shippingline WHERE Id=".$id);
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
				$sql = "DELETE FROM shippingline WHERE Id='".$Id."'";
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