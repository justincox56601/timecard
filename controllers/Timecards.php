<?php
/**
 * This is the controller class for the timecard functionality
 * I will be able to log my hours worked, they will be added ot the database, and then I can make a PDF of them
 */

 class Timecards extends Controller{
	private $data=[];

	public function __construct(){
		$this->userModel = $this->Model('Timecard');
		$this->data['clients'] = $this->userModel->getClients();
	}

	public function index(){
		//$page = $params? $params : SITE_HOME;
		//$this->data = $this->userModel->getPages($page);
		$this->view('timecards/index', $this->data);
	}

	public function postWork(){
		//gets the posted data from the timecard form
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$_POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

			$data = [
				'id' => trim($_POST['clientName']),
				'date' => date('Y-n-d', strtotime($_POST['starttime'])),
				'description' => trim($_POST['description']),
				'time' => strtotime($_POST['endtime']) - strtotime($_POST['starttime']),
			];

			$this->userModel->addWork($data);
		}


		$this->view('timecards/index', $this->data);
	}

	public function addNewClient(){
		//adds a new client to the database
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$_POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

			$data = [
				'name' => trim($_POST['clientName']),
				'email' => trim($_POST['contactEmail']),
				'rate' => intval($_POST['rate'])
			];
			
			

			if( ! empty($data['name']) &&
				! empty($data['email']) &&
				! empty($data['rate'])){
				$this->userModel->addClients($data);
				$this->data['clients'] = $this->userModel->getClients();
			}

			$this->view('timecards/index', $this->data);
		}

		$this->view('timecards/index', $this->data);
	}

	public function getWork(){
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$id = intval(filter_var($_GET['clientId'], FILTER_SANITIZE_NUMBER_INT));
			$data['hours'] = $this->userModel->getWork($id);
		}

		$this->view('timecards/invoice', $data);
	}

	
 }
