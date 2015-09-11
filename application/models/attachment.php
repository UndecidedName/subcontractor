<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Attachment extends CI_Model
	{
		private $Id;
		private $ReferenceId;
		private $Type;
		private $FileName;
		private $FilePath;

		public function __construct()
		{
			parent::__construct();
			$this->Id 		= null;
			$this->ReferenceId = null;
			$this->Type 	= null;
			$this->FileName = null;
			$this->FilePath = null;
		}

		public function setAttachment($id, $ReferenceId, $type, $fileName, $filePath)
		{
			$this->Id 		= $id;
			$this->ReferenceId = $ReferenceId;
			$this->Type 	= $type;
			$this->FileName = $fileName;
			$this->FilePath = $filePath;
		}

		public function getId()
		{
			return $this->Id;
		}

		public function getReferenceId()
		{
			return $this->ReferenceId;
		}

		public function getType()
		{
			return $this->Type;
		}

		public function getFileName()
		{
			return $this->FileName;
		}

		public function getFilePath()
		{
			return $this->FilePath;
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
				$sql = "UPDATE attachment SET ";
				$sql = $sql."Type='".$this->getType()."',";	
				$sql = $sql."ReferenceId='".$this->getReferenceId()."',";
				$sql = $sql."Filename='".$this->getFileName()."',";
				$sql = $sql."Filepath='".$this->getFilePath()."' ";
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
				$sql = "INSERT INTO attachment(ReferenceId, Type,FileName,FilePath) VALUES(";
				$sql = $sql."'".$this->getReferenceId()."',";	
				$sql = $sql."'".$this->getType()."',";	
				$sql = $sql."'".$this->getFileName()."',";
				$sql = $sql."'".$this->getFilePath()."')";
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
					$query = $this->db->query("SELECT * FROM attachment WHERE Id=".$id);
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
				$sql = "SELECT FilePath FROM attachment WHERE Id='".$Id."'";
				$query = $this->db->query($sql);
				if($query)
				{
					file_put_contents(BASEPATH.'logs.txt', date("Y-m-d H:i:s")."\t".$sql."\n", FILE_APPEND);
					foreach($query->result() as $row)
					{
						$file_path = $row->FilePath;
					}
					$sql = "DELETE FROM attachment WHERE Id='".$Id."'";
					//Execute query
					$query = $this->db->query($sql);
					if($query)
					{
						file_put_contents(BASEPATH.'logs.txt', date("Y-m-d H:i:s")."\t".$sql."\n", FILE_APPEND);
						if($file_path[$i] != "")
							unlink($file_path[$i]);
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