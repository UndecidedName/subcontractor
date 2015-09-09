<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vessel_voyage_controller extends CI_Controller {
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
		//create vessel voyage instance
		$this->load->model('Vessel_voyage', 'vv');
	}

	public function view()
	{
		$this->load->view('vessel_voyage_view');
	}

	public function getVesselVoyages($page, $vesselId)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$vessel = array();
		$this->take = 20;

		if($page == 1)
			$skip = 0;
		else
			$skip = ($page - 1) * $this->take;

		$sql = "SELECT * FROM vesselvoyage WHERE VesselId='".$vesselId."' LIMIT ".$skip.",".$this->take;

		$result = $this->vv->retrieve($sql);

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

	public function postVesselVoyage()
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$data 				= file_get_contents('php://input', true);
		$vesselvoyage 		= json_decode($data, true);
		
		//Set vessel voyage information
		$this->vv->setVesselVoyage(0, $vesselvoyage['VesselId'], $vesselvoyage['EstimatedDeparture'], $vesselvoyage['EstimatedArrival'], $vesselvoyage['Departure'], $vesselvoyage['Arrival'], $vesselvoyage['Status']);
		//Save vessel voyage information
		$result = $this->vv->save();

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

	public function putVesselVoyage($Id)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$data 				= file_get_contents('php://input', true);
		$vesselvoyage 		= json_decode($data, true);
		//Set vessel voyage information
		$this->vv->setVesselVoyage($Id, $vesselvoyage['VesselId'], $vesselvoyage['EstimatedDeparture'], $vesselvoyage['EstimatedArrival'], $vesselvoyage['Departure'], $vesselvoyage['Arrival'], $vesselvoyage['Status']);
		//Edit vessel voyage information
		$result = $this->vv->edit();

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			$vesselItem = $vesselvoyage;
			$response['status'] = "SUCCESS";
			$response['data'] = $vesselItem;
		}
		echo json_encode($response);
	}

	public function deleteVesselVoyage($Id)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";

		//delete vessel voyage information
		$result = $this->vv->delete($Id);

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
			$response['status'] = "SUCCESS";
		echo json_encode($response);
	}
}