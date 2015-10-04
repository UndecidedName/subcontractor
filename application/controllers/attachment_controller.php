<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attachment_controller extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	private $response;
	private $take;
	private $base_path;
	public function __construct(){
		parent::__construct();
		$basepath = explode("/", BASEPATH);
		$this->base_path = $basepath[0]."/".$basepath[1]."/".$basepath[2]."/".$basepath[3]."/";
		$this->load->model('Attachment', 'a');
		$this->load->helper(array('form', 'url'));
	}

	public function view()
	{
		$this->load->view('attachment_view', array('error' => ' ' ));
	}

	public function getAttachments($length, $referenceId)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$attachment = array();
		$this->take = 20;
		$skip = $length;

		/*if($page == 1)
			$skip = 0;
		else
			$skip = ($page - 1) * $this->take;*/

		$sql = "SELECT * FROM attachment WHERE ReferenceId = '".$referenceId."' LIMIT ".$skip.",".$this->take;

		$result = $this->a->retrieve($sql);

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			foreach($result->result() as $row)
			{
				$attachment[] = $row;
			}
			$response['status'] = "SUCCESS";
		}
		$response['data'] = $attachment;
		echo json_encode($response);
	}

	public function uploadTrucking()
	{
		$status = "";
		$msg = "";
		$file_element_name = 'attachment';
		if ($status != "error")
		{
			$config['upload_path'] 		= $this->base_path.'attachments/trucking/';
			$config['allowed_types'] 	= 'gif|jpg|png|doc|txt';
			$config['encrypt_name'] 	= FALSE;

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload($file_element_name))
			{
			    $status = "FAILURE";
			}
		  	else
		   	{
		   		$data = $this->upload->data();
		   		$image_path = $data['full_path'];
		   		if(file_exists($image_path))
		   		{
			      	$status = "SUCCESS";
		 		}
		 		else
		 		{
		  			$status = "FAILURE";
		 		}
			}
		 	@unlink($_FILES[$file_element_name]);
		}
	 	echo json_encode(array('status' => $status));
	}

	public function uploadShippingLine()
	{
		$status = "";
		$msg = "";
		$file_element_name = 'attachment';
		if ($status != "error")
		{
			$config['upload_path'] 		= $this->base_path.'attachments/shippingline/';
			$config['allowed_types'] 	= 'gif|jpg|png|doc|txt';
			$config['encrypt_name'] 	= FALSE;

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload($file_element_name))
			{
			    $status = "FAILURE";
			}
		  	else
		   	{
		   		$data = $this->upload->data();
		   		$image_path = $data['full_path'];
		   		if(file_exists($image_path))
		   		{
			      	$status = "SUCCESS";
		 		}
		 		else
		 		{
		  			$status = "FAILURE";
		 		}
			}
		 	@unlink($_FILES[$file_element_name]);
		}
	 	echo json_encode(array('status' => $status));
	}

	public function openAttachment($fileName, $type)
	{
		if($type == "S")
			$attachment = '/subcontractor/attachments/shippingline/'.$fileName;
		else
			$attachment = '/subcontractor/attachments/trucking/'.$fileName;
		
		$this->load->view('attachment_container', array('attachment' => $attachment));
	}

	public function postAttachment()
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$data 				= file_get_contents('php://input', true);
		$attachment 		= json_decode($data, true);

		if($attachment['Type'] == "T")
			$attachment['FilePath'] = $this->base_path.'attachments/trucking/'.$attachment['FileName'];
		else
			$attachment['FilePath'] = $this->base_path.'attachments/shippingline/'.$attachment['FileName'];
		//Set Attachment information
		$this->a->setAttachment(0, $attachment['ReferenceId'], $attachment['Type'], $attachment['FileName'], $attachment['FilePath']);
		//Save Attachment information
		$result = $this->a->save();

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			foreach($result->result() as $row)
			{
				$attachmentItem = $row;
			}
			$response['status'] = "SUCCESS";
			$response['data'] = $attachmentItem;
		}

		echo json_encode($response);
	}

	public function putAttachment($Id)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$data 				= file_get_contents('php://input', true);
		$attachment 		= json_decode($data, true);
		//Set Attachment information
		$this->a->setAttachment($Id, $attachment['Id'], $attachment['Type'], $attachment['FileName'], $attachment['FilePath']);
		//Edit Attachment information
		$result = $this->a->edit();

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			$attachmentItem = $attachment;
			$response['status'] = "SUCCESS";
			$response['data'] = $attachmentItem;
		}
		echo json_encode($response);
	}

	public function deleteAttachment($Id)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";

		//Delete Attachment information
		$result = $this->a->delete($Id);

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
			$response['status'] = "SUCCESS";
		echo json_encode($response);
	}
}