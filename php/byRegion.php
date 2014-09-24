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
			//search regions by name
			$query = 'SELECT `ID` FROM `region` WHERE `name` LIKE "%'.$_GET['region'].'%"';
			$res = $db->query($query);
			while($obj = $res->fetch_object()) {
				$IDs[] = $obj->ID;
			}
		} else {
			//region is given by ID
			$IDs[] = $_GET['region'];
		}
		
		//Get sub-regions (child elements)
		$IDsTmp = $IDs;
		foreach($IDsTmp as $ID) {
			$IDs = array_merge($IDs, children($ID));
		}
				
		//generate SQL-query
		$query = "SELECT 
`brand`.`ID`,`brand`.`name`, `beer`.`ID`, `beer`.`name`, `beer`.`url`, `region`.`ID`, `region`.`name`
FROM `beer`
JOIN `brand` ON `beer`.`brand` = `brand`.`ID`
JOIN `region` ON `brand`.`region` = `region`.`ID`";
		//add where statement
		$query = $query."\n WHERE `brand`.`region` = ".implode($IDs, " OR `brand`.`region` = ");
				
		//print table of mighty beers
		$res = $db->query($query);
		echo "<table>";
		echo "<tr>";
		echo "<th>Marke</th><th>Name</th><th>Region</th>";
		echo "</tr>";
		while($row = $res->fetch_row()) {
			echo "<tr>";
			echo '<td><a href="brand.php?id='.$row[0].'">'.$row[1].'</a></td>';
			echo '<td><a href="beer.php?id='.$row[2].'">'.$row[3].'</a></td>';
			echo '<td><a href="byRegion.php?region='.$row[5].'">'.$row[6].'</a></td>';
			echo "<tr>";
		}
		echo "</table>";
	} else {
		//ToDo: Datenbankverbindung gescheitert
	}
}