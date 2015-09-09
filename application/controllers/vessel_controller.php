<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vessel_controller extends CI_Controller {
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
		//create Vessel instance
		$this->load->model('Vessel', 'v');
	}

	public function view()
	{
		$this->load->view('vessel_view');
	}

	public function getVessels($page, $shippingLineId)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$vessel = array();
		$this->take = 20;

		if($page == 1)
			$skip = 0;
		else
			$skip = ($page - 1) * $this->take;

		$sql = "SELECT * FROM vessel WHERE ShippingLineId='".$shippingLineId."' LIMIT ".$skip.",".$this->take;

		$result = $this->v->retrieve($sql);

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			foreach($result->result() as $row)
			{
				$vessel[] = $row;
			}
			$response['status'] = "SUCCESS";
		}
		$response['data'] = $vessel;
		echo json_encode($response);
	}

	public function postVessel()
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$data 				= file_get_contents('php://input', true);
		$vessel 		= json_decode($data, true);

		//Set vessel information
		$this->v->setVessel(0, $vessel['ShippingLineId'], $vessel['Name'], $vessel['Description'], $vessel['Status']);
		//Save vessel information
		$result = $this->v->save();

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			foreach($result->result() as $row)
			{
				$vesselItem = $row;
			}
			$response['status'] = "SUCCESS";
			$response['data'] = $vesselItem;
		}

		echo json_encode($response);
	}

	public function putVessel($Id)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$data 				= file_get_contents('php://input', true);
		$vessel 		= json_decode($data, true);

		//Set vessel information
		$this->v->setVessel($Id, $vessel['ShippingLineId'], $vessel['Name'], $vessel['Description'], $vessel['Status']);
		//Edit vessel information
		$result = $this->v->edit();

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			$vesselItem = $vessel;
			$response['status'] = "SUCCESS";
			$response['data'] = $vesselItem;
		}
		echo json_encode($response);
	}

	public function deleteVessel($Id)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";

		//Edit vessel information
		$result = $this->v->delete($Id);

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
			$response['status'] = "SUCCESS";
		echo json_encode($response);
	}
}