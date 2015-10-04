<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Truck_controller extends CI_Controller {
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
		//create Truck instance
		$this->load->model('Truck', 't');
	}

	public function view()
	{
		$this->load->view('truck_view');
	}

	public function getTrucks($length, $truckingId)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$truck = array();
		$this->take = 20;
		$skip = $length;

		/*if($page == 1)
			$skip = 0;
		else
			$skip = ($page - 1) * $this->take;*/

		$sql = "SELECT * FROM truck WHERE TruckingId='".$truckingId."' LIMIT ".$skip.",".$this->take;

		$result = $this->t->retrieve($sql);

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			foreach($result->result() as $row)
			{
				$truck[] = $row;
			}
			$response['status'] = "SUCCESS";
		}
		$response['data'] = $truck;
		echo json_encode($response);
	}

	public function postTruck()
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$data 				= file_get_contents('php://input', true);
		$truck 		= json_decode($data, true);

		//Set truck information
		$this->t->setTruck(0, $truck['TruckingId'], $truck['Name'], $truck['Type'], $truck['Description'], $truck['Status']);
		//Save truck information
		$result = $this->t->save();

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			foreach($result->result() as $row)
			{
				$truckItem = $row;
			}
			$response['status'] = "SUCCESS";
			$response['data'] = $truckItem;
		}

		echo json_encode($response);
	}

	public function putTruck($Id)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$data 				= file_get_contents('php://input', true);
		$truck 		= json_decode($data, true);

		//Set truck information
		$this->t->setTruck($Id, $truck['TruckingId'], $truck['Name'], $truck['Type'], $truck['Description'], $truck['Status']);
		//Edit truck information
		$result = $this->t->edit();

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			$truckItem = $truck;
			$response['status'] = "SUCCESS";
			$response['data'] = $truckItem;
		}
		echo json_encode($response);
	}

	public function deleteTruck($Id)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";

		//Edit truck information
		$result = $this->t->delete($Id);

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
			$response['status'] = "SUCCESS";
		echo json_encode($response);
	}
}