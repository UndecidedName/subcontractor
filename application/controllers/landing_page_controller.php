<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing_page_controller extends CI_Controller {

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
	public function __construct()
	{
		parent::__construct();
	}

	public function view()
	{
		$this->load->view('landing_page_view');
	}

	public function dataGrid1()
	{
		$this->load->view('data_grid1_view');
	}
	public function dataGrid2()
	{
		$this->load->view('data_grid2_view');
	}
	public function dataFiltering()
	{
		$this->load->view('data_filtering_view');
	}
}