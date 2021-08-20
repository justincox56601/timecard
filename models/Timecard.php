<?php
/**
 * This is the model for the timecard functionality
 */

class Timecard{
	private $db;

	public function __construct(){
		$this->db = Database::getInstance();
	}

	public function getClients(){
		//returns a list of clients fomr the database
		$this->db->query('SELECT * FROM timecardclients');
		return $this->db->getResults();

	}

	public function addClients($data){
		//get an array of all clients as objects in the database
		
		$clients = $this->getClients();

		//not a huge fan of doing it this way, see if there is a better way later
		$found = false;
		foreach($clients as $client){
			if($client->name == $data['name']){
				$found = true;
			}
		}
		

		if(!$found){
			$this->db->query('INSERT INTO timecardclients VALUES (NULL, ?, ?, ?)');
			$this->db->bind($data['name'], 's');
			$this->db->bind($data['email'], 's');
			$this->db->bind($data['rate'], 'i');
		
			return $this->db->insert();
		}

		
	}

	public function addWork($data){
		//adds a work entry to the work database using the client ID as
		$this->db->query('INSERT INTO timecardwork VALUES (NULL, ?, ?,?,?, false, false)');
		$this->db->bind($data['id'], 'i');
		$this->db->bind($data['date'], 's');
		$this->db->bind($data['description'], 's');
		$this->db->bind($data['time'], 'i');

		return $this->db->insert();
	}

	public function getWork($id){
		//$this->db->query('SELECT * FROM timecardwork WHERE client_id=? AND billed=false');
		$this->db->query('SELECT timecardclients.name, timecardclients.rate, timecardwork.date, timecardwork.workDescription, timecardwork.timeWorked, timecardwork.billed
						  FROM timecardclients INNER JOIN timecardwork
						  ON timecardclients.id=timecardwork.client_id
						  WHERE timecardclients.id=?');
		$this->db->bind($id, 'i');
		return $this->db->getResults();
	}
}
