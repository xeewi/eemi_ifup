<?php

namespace WebSocket\Application;

/**
 * Websocket-Server demo and test application.
 * 
 * @author Simon Samtleben <web@lemmingzshadow.net>
 */

use \PDO;

class IfUpApp extends Application
{

// Variables
// ---------------------------------------------------------
	private $_clients = array();
	private $_users = array();
	private $_services = array();
	private $_candidates = array();
	private $_bdd = "";
	
// Functions
// ---------------------------------------------------------
	
// Socket
	//Utilisateur connecté
	public function onConnect($client){
		$id = $client->getClientId();
        $this->_clients[$id] = $client;
        if ($this->_bdd == "") {
       		$this->connectBdd();
        }
        $count = count($this->_clients);

        echo "Utilisateur connecté : ".$id."\n";
        echo "Nb users : ".$count."\n";
	}

	// Utilisateur déconnecté
	public function onDisconnect($client){
		$id = $client->getClientId();		
		unset($this->_clients[$id]); 

		echo "Utilisateur déconnecté : ".$id."\n";
	}

	// Sélectionne la fonction à déclenché en fonction des envoies
	public function onData($data, $client){
		$decode = $this->_decodeData($data);
		$decode['data']['client'] = $client;
		$actionName = $decode["action"];
		echo 'Action déclenchée : '.$actionName."\n";
		if(method_exists($this, $actionName))
		{			
			call_user_func(array($this, $actionName), $decode['data']);
		}
	}

//	Connection BDD
	public function connectBdd(){
		try
		{
		    $this->_bdd = new PDO('mysql:host=dev.etudiant-eemi.com;dbname=gautierg;charset=utf8',
						'gautierg',
						'149073',
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch(Exception $e)
		{
			die('Erreur :'.$e->getMessage());
		}
	}

// Service
	public function setService($data){
		$this->_services[$data['ifup_service_id']] = $this->selectService($data['ifup_service_id']);
		$this->_services[$data['ifup_service_id']]['ifup_service_district'] = $data['ifup_service_district'];
		echo "Nouveau service : ".$data['ifup_service_id']."\n";

		$notify = $this->sendNotify($data['ifup_service_id'], $data['client']);

		if ($notify == "X_BD013") {
			$err = "Service ".$data['ifup_service_id']." : Err BD013 - Aucun utilisateur trouvé \n";
			echo $err;
			$data['client']->send($this->_encodeData('socketErr', $notify));

		} else if ($notify == "X_GMZIP") {
			$err = "Service ".$data['ifup_service_id']." : Err GMZIP - zipcode invalid \n";
			echo $err;
			$data['client']->send($this->_encodeData('socketErr', $notify));
		}
	}

	public function acceptService($data){
		if ($this->_services[$data['ifup_service_id']]['ifup_service_user_up_id'] == null) {

			$data['user']['latlen'] = $data['user']['glat'].','.$data['user']['glen'];
			$insert = $this->updateUserUp($data['user'], $data['ifup_service_id']);

			if ($insert == true) {
				$this->_services[$data['ifup_service_id']] = $this->selectService($data['ifup_service_id']);
				$service = $this->_services[$data['ifup_service_id']];
				if ($service == false) {
					$data['client']->send($this->_encodeData('socketErr', 'X_BD111'));
				} else {
					$tosend = array();
					$tosend['userIF'] = $this->_users[$service['ifup_service_user_if_id']];
					$tosend['userUP'] = $this->_users[$service['ifup_service_user_up_id']];
					$tosend['service'] = $service;
					$tosend['filter'] = $this->selectFilter($service['ifup_service_filter_id']);

					//Send to iffer
					$srvIDIF = $this->_users[$service['ifup_service_user_if_id']]['srvID'];
					$this->_clients[$srvIDIF]->send($this->_encodeData('setMeeting', $tosend));

					//Send to upper
					$srvIDUP = $this->_users[$service['ifup_service_user_up_id']]['srvID'];
					$this->_clients[$srvIDUP]->send($this->_encodeData('setMeeting', $tosend));

					unset($this->_candidates[$service['ifup_service_id']]);
				}

			} else {
				$data['client']->send($this->_encodeData('socketErr', 'X_SV000'));
			}

		} else {
			$data['client']->send($this->_encodeData('socketErr', 'X_SV000bis'));

		}
	}

	public function sendNotify($serviceID, $userif){
		$service = $this->selectService($serviceID); 
		$filterID = $service['ifup_service_filter_id'];
		$districtID = $this->selectDistrictID($this->_services[$serviceID]['ifup_service_district']);

		if ($districtID == false) {
			return "X_GMZIP";
		}
		$this->_candidates[$serviceID] = $this->selectUsersUp($filterID,$districtID);

		if (array_key_exists(0, $this->_candidates[$serviceID]) == false) {
			return "X_BD013";
		} else {
			$count = count($this->_candidates[$serviceID]);
			echo "Service ".$serviceID." : ".$count." utilisateur(s) trouvé(s) \n";
			$userif->send($this->_encodeData('setCandidates', $count));
			
			$notif = array();
			$notif['filter'] = $this->selectFilter($filterID);
			$notif['district'] = $this->selectDistrict($districtID);
			$notif['msg'] = $service['ifup_service_message'];
			$notif['address'] = $service['ifup_service_address'];
			$notif['serviceID'] = $serviceID;
		
			$service['filter'] = $notif['filter'];
			$service['district'] = $notif['district'];

			foreach ($this->_candidates[$serviceID] as $key => $value) {
				$srvID = $this->_users[$value['ifup_user_id']]['srvID'];
				$this->_clients[$srvID]->send($this->_encodeData('setNotif', $notif));
			}
		}
	}

	public function denieService($data){

		$count = count($this->_candidates[$data['ifup_service_id']]);
		
		foreach ($this->_candidates[$data['ifup_service_id']] as $key => $value) {
			if ($value['ifup_user_id'] == $data['ifup_service_id']) {
				unset($this->_candidates[$data['ifup_service_id']][$key]);
			}
		}

		if ($count - 1 == 0) {
			unset($this->_candidates['ifup_service_id']);
			$service = $this->selectService($data['ifup_service_id']);
			$srvID = $this->_users[$service['ifup_service_user_if_id']]['srvID'];
			$this->_clients[$srvID]->send($this->_encodeData('socketErr', 'X_BD013bis'));
		}		
	}

	public function startService($data){
		$data['ifup_service_id'] = intval($data['ifup_service_id']);
		$service = $this->_services[$data['ifup_service_id']];
		$update = $this->updateStart($data['ifup_service_id']);
		if ($update == false) {
			$srvID = $this->_users[$data['ifup_user_id']['ifup_user_id']]['srvID'];
			$this->_clients[$srvID]->send($this->_encodeData('socketErr', 'X_BD020'));
		} else {

			$this->_services[$data['ifup_service_id']]['ifup_service_start'] = $update;
			$srvIF = $this->_users[$service['ifup_service_user_if_id']]['srvID']; 
			$srvUP = $this->_users[$service['ifup_service_user_up_id']]['srvID'];

			$data = array();
			$data = $this->_users[$service['ifup_service_user_up_id']];
			$data['now'] = $update;

			$this->_clients[$srvIF]->send($this->_encodeData('setCount', $data));
			$this->_clients[$srvUP]->send($this->_encodeData('setCount', $data));
		}
	}

	public function stopService($data){
		
		$service = $this->_services[$data['ifup_service_id']];
		
		$srvIF = $this->_users[$service['ifup_service_user_if_id']]['srvID']; 
		$srvUP = $this->_users[$service['ifup_service_user_up_id']]['srvID'];

		$send = array();
		$send['price'] = $data['timerate'];
		if ($data['status'] == 0) {
			$send['firstname'] = $this->_users[$service['ifup_service_user_up_id']]['ifup_user_firstname'];
		} else {
			$send['firstname'] = $this->_users[$service['ifup_service_user_if_id']]['ifup_user_firstname'];
		}
		
		$this->_clients[$srvIF]->send($this->_encodeData('setFinish', $send));
		$this->_clients[$srvUP]->send($this->_encodeData('setFinish', $send));
	}

	public function selectService($serviceID){
		try{
	        $select = $this->_bdd->prepare("SELECT * FROM ifup_service WHERE ifup_service_id = :serviceID");
	        $select->bindParam(':serviceID', $serviceID, PDO::PARAM_INT);
	        $select->execute();
	        $service = $select->fetch();
	        return $service;

	    } catch(Exception $e){
	        return false;
	    }
	}

	public function updateUserUp($userUP, $serviceID){
		try{
	        $select = $this->_bdd->prepare("UPDATE ifup_service SET ifup_service_user_up_id = :ifup_service_user_up_id, 
	        	ifup_service_up_lat_len = :ifup_service_up_lat_len
	        	WHERE ifup_service_id = :serviceID");
	        $select->bindParam(':ifup_service_user_up_id', $userUP['ifup_user_id'], PDO::PARAM_INT);
	        $select->bindParam(':ifup_service_up_lat_len', $userUP['latlen'], PDO::PARAM_STR);
	        $select->bindParam(':serviceID', $serviceID, PDO::PARAM_INT);
	        $select->execute();

	        return true;

	    } catch(Exception $e){
	        return false;
	    }
	}

	public function updateStart($serviceID){
		try{
	        $select = $this->_bdd->prepare("UPDATE ifup_service SET ifup_service_start = NOW() 
	        	WHERE ifup_service_id = :serviceID");
	        $select->bindParam(':serviceID', $serviceID, PDO::PARAM_INT);
	        $select->execute();
	        $now = date('Y-m-d h:i:s');
	        return $now;

	    } catch(Exception $e){
	        return false;
	    }
	}

// Users 
	public function setCurrentUser($data){
		$this->_users[$data['ifup_user_id']] = $data;
		$this->_users[$data['ifup_user_id']]['srvID'] = $data['client']->getClientId();
		$this->_users[$data['ifup_user_id']]['ifup_user_password'] = "";
		echo "Utilisateur connecté : ".$data['ifup_user_firstname'].' '.$data['ifup_user_lastname']."\n";
		echo "userID : ".$data['ifup_user_id']."\n";
		echo "srvID : ".$this->_users[$data['ifup_user_id']]['srvID']."\n";
	}

	public function setOffline($data){
		echo "SET OFFLINE \n";
		if($data['ifup_service_id'] != null) {
			$service = $this->selectService($data['ifup_service_id']);
			if ($service['ifup_service_user_if_id'] == $data['ifup_user_id']) {
				$selectUser = 'ifup_service_user_up_id';
			} else {
				$selectUser = 'ifup_service_user_if_id';
			}
			$srvID = $this->_users[$service[$selectUser]]['srvID'];
			if (is_object($this->_clients[$srvID])) {
				$this->_clients[$srvID]->send($this->_encodeData('socketErr', 'X_BDH10'));
			}
		}		
	}

	public function selectUsersUp($filterID,$districtID){
		try{
	        $select = $this->_bdd->prepare("SELECT * FROM ifup_user 
	        	LEFT JOIN ifup_users_districts
	        		ON ifup_user.ifup_user_id = ifup_users_districts.ifup_user_id
	        	LEFT JOIN ifup_users_filters 
	        		ON ifup_user.ifup_user_id = ifup_users_filters.ifup_user_id
	        	WHERE ifup_users_districts.ifup_district_id = :districtID
		        	AND ifup_users_filters.ifup_filter_ID = :filterID
		        	AND ifup_user.ifup_user_status = 1
		        	AND ifup_user.ifup_user_online = 1");
	        $select->bindParam(':filterID', $filterID, PDO::PARAM_INT);
	        $select->bindParam(':districtID', $districtID, PDO::PARAM_INT);
	        $select->execute();
	        $users = $select->fetchAll();

	        return $users;

	    } catch(Exception $e){
	        return false;
	    }
	}

// Districts
	public function selectDistrict($districtID){
		try{
	        $select = $this->_bdd->prepare("SELECT * FROM ifup_district WHERE ifup_district_id = :districtID");
	        $select->bindParam(':districtID', $districtID, PDO::PARAM_INT);
	        $select->execute();
	        $district = $select->fetch();

	        return $district;

	    } catch(Exception $e){
	        return false;
	    }
	}

	public function selectDistrictID($zipcode){
		try{
	        $select = $this->_bdd->prepare("SELECT * FROM ifup_district WHERE ifup_district_zip_code = :zipcode");
	        $select->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
	        $select->execute();
	        $district = $select->fetch();
	        $districtID = $district['ifup_district_id'];

	        return $districtID;

	    } catch(Exception $e){
	        return false;
	    }
	}

// Filters
	public function selectFilter($filterID){
		try{
	        $select = $this->_bdd->prepare("SELECT * FROM ifup_filter WHERE ifup_filter_id = :filterID");
	        $select->bindParam(':filterID', $filterID, PDO::PARAM_INT);
	        $select->execute();
	        $filter = $select->fetch();    

	        return $filter;

	    } catch(Exception $e){
	        return false;
	    }
	}

}
