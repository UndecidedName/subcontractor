<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_line_controller extends CI_Controller {
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
		$this->load->model('Shipping_line', 'sl');
	}

	public function view()
	{
		$this->load->view('shipping_line_view');
	}

	public function getShippingLines($length)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$shippingLine = array();
		$this->take = 20;

		if($length == 1)
			$skip = 0;
		else
			$skip = ($length - 1) * $this->take;

		$sql = "SELECT * FROM shippingline LIMIT ".$skip.",".$this->take;

		$result = $this->sl->retrieve($sql);

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			while($row = $result->fetch_assoc())
			{
				$shippingLine[] = $row;
			}
			$response['status'] = "SUCCESS";
		}
		$response['data'] = $shippingLine;
		echo json_encode($response);
	}

	public function postShippingLine()
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$data 				= file_get_contents('php://input', true);
		$shippingLine 		= json_decode($data, true);

		//Set shipping line information
		$this->sl->setShippingLine(0, $shippingLine['Name'], $shippingLine['Address'], $shippingLine['Status']);
		//Save shipping line information
		$result = $this->sl->save();

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			while($row = $result->fetch_assoc())
			{
				$shippingLineItem = $row;
			}
			$response['status'] = "SUCCESS";
			$response['data'] = $shippingLineItem;
		}

		echo json_encode($response);
	}

	public function putShippingLine($Id)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";
		$data 				= file_get_contents('php://input', true);
		$shippingLine 		= json_decode($data, true);

		//Set shipping line information
		$this->sl->setShippingLine($Id, $shippingLine['Name'], $shippingLine['Address'], $shippingLine['Status']);
		//Edit shipping line information
		$result = $this->sl->edit();

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
		{
			$shippingLineItem = $shippingLine;
			$response['status'] = "SUCCESS";
			$response['data'] = $shippingLineItem;
		}
		echo json_encode($response);
	}

	public function deleteShippingLine($Id)
	{
		header('Content-Type: application/json');
		$response['status'] = "FAILURE";

		//Edit shipping line information
		$result = $this->sl->delete($Id);

		if($result == false)
			$response['message'] = "A database error has occured, please contact IT adminstrator immediately.";
		else
			$response['status'] = "SUCCESS";
		echo json_encode($response);
	}
}