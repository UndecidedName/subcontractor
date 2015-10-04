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
		 		/*$sql = "SELECT Status FROM shippingline WHERE Id='".$this->getId()."'";
		 		$result = $this->retrieve($sql);
		 		if($result != false){
		 			foreach ($result->result_array() as $row) {
		 				$status = $row['Status'];
		 			}
			 		if($status == 1){*/
						$sql = "UPDATE shippingline LEFT JOIN vessel ON shippingline.Id = vessel.ShippingLineId  
								LEFT JOIN vesselvoyage ON vessel.Id = vesselvoyage.VesselId SET ";
						$sql = $sql."shippingline.Name='".$this->getName()."',";	
						$sql = $sql."shippingline.Address='".$this->getAddress()."',";
						$sql = $sql."shippingline.Status='".$this->getStatus()."',";
						$sql = $sql."vessel.Status='".$this->getStatus()."',";
						$sql = $sql."vesselvoyage.Status='".$this->getStatus()."' ";
						$sql = $sql."WHERE shippingline.Id='".$this->getId()."'";
					/*}
					else{
						$sql = "UPDATE shippingline SET ";
						$sql = $sql."Name='".$this->getName()."',";	
						$sql = $sql."Address='".$this->getAddress()."',";
						$sql = $sql."Status='".$this->getStatus()."' ";
						$sql = $sql."WHERE Id='".$this->getId()."'";
					}*/
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
				//}
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
				$sql = "INSERT INTO shippingline(Name,Address,Status) VALUES(";
				$sql = $sql."'".$this->getName()."',";	
				$sql = $sql."'".$this->getAddress()."',";
				$sql = $sql."'".$this->getStatus()."')";

				//Insert data 100 times for tesing
				/*for($i = 0; $i < 100; $i++)
					$query = $this->db->query($sql);*/
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
					$query = $this->db->query("SELECT * FROM shippingline WHERE Id=".$id);
					$this->db->close();
					file_put_contents(BASEPATH.'logs.txt', date("Y-m-d H:i:s")."\t".$sql."\n", FILE_APPEND);
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
				$sql = "SELECT attachment.FilePath as FilePath FROM shippingline LEFT JOIN vessel ON shippingline.Id = vessel.ShippingLineId LEFT JOIN vesselvoyage ON vessel.Id = vesselvoyage.VesselId LEFT JOIN attachment ON vessel.Id = attachment.ReferenceId WHERE shippingline.Id='".$Id."'";
				$query = $this->db->query($sql);
				if($query)
				{
					file_put_contents(BASEPATH.'logs.txt', date("Y-m-d H:i:s")."\t".$sql."\n", FILE_APPEND);
					foreach ($query->result() as $row) {
						$file_path[] = $row->FilePath;
					}

					$sql = "DELETE shippingline, vessel, vesselvoyage, attachment FROM shippingline LEFT JOIN vessel ON shippingline.Id = vessel.ShippingLineId LEFT JOIN vesselvoyage ON vessel.Id = vesselvoyage.VesselId LEFT JOIN attachment ON vessel.Id = attachment.ReferenceId WHERE shippingline.Id='".$Id."'";
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