<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trucking_controller extends CI_Controller {

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
	public function __construct(){
		parent::__construct();
		//create Shipping_line instance
		$this->load->model('Trucking', 't');
	}

	public function view()
	{
		$this->load->view('trucking_view');
	}

	public function getTruckings($page)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$trucking = array();
		$this->take = 20;

		if($page == 1)
			$skip = 0;
		else
			$skip = ($page - 1) * $this->take;

		$sql = "SELECT * FROM trucking LIMIT ".$skip.",".$this->take;

		$result = $this->t->retrieve($sql);
	
		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			foreach ($result->result() as $row) {
				$trucking[] = $row;
			}
			$response['status'] = "SUCCESS";
		}
		$response['data'] = $trucking;
		echo json_encode($response);
	}

	public function postTrucking()
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$data 				= file_get_contents('php://input', true);
		$trucking 		= json_decode($data, true);

		//Set trucking information
		$this->t->setTrucking(0, $trucking['Name'], $trucking['Address'], $trucking['Status']);
		//Save trucking information
		$result = $this->t->save();

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			foreach($result->result() as $row)
			{
				$truckingItem = $row;
			}
			$response['status'] = "SUCCESS";
			$response['data'] = $truckingItem;
		}

		echo json_encode($response);
	}

	public function putTrucking($Id)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$data 				= file_get_contents('php://input', true);
		$trucking 		= json_decode($data, true);

		//Set trucking information
		$this->t->setTrucking($Id, $trucking['Name'], $trucking['Address'], $trucking['Status']);
		//Edit trucking information
		$result = $this->t->edit();

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			$truckingItem = $trucking;
			$response['status'] = "SUCCESS";
			$response['data'] = $truckingItem;
		}
		echo json_encode($response);
	}

	public function deleteTrucking($Id)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";

		//delete trucking information
		$result = $this->t->delete($Id);

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
			$response['status'] = "SUCCESS";
		echo json_encode($response);
	}
}