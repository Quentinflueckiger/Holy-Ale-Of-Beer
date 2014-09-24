<?php
include_once("config.php");

if(isset($_GET['region'])) {
	$db = new mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME);
	
	if(!mysqli_errno($db)) {
		function children($ID) {
			global $db;

			$return[] = $ID;
			$query = "SELECT `ID` FROM `region` WHERE `super` = ".$ID;

			if($res = $db->query($query)) {
				while($obj = $res->fetch_object()) {
					$return = array_merge($return, children($obj->ID));
				}
			} else {
				//ToDo: query failed
			}

			return $return;
		}
			
		if(!is_numeric($_GET['region'])) {
			$query = 'SELECT `ID` FROM `region` WHERE `name` LIKE "%'.$_GET['region'].'%"';
			
		}
		
	} else {
		//ToDo: Datenbankverbindung gescheitert
	}
}