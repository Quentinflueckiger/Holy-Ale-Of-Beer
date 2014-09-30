<?php
include_once("config.php");
$db = new mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME);
session_start();

if(isset($_POST['name'])) {
	$query = 'INSERT INTO `brand` (`name`, `region`) VALUES ("'.$_POST['name'].'", '.$_POST['region'].')';
	$res = $db->query($query);
	$ID = $db->insert_id;
	
	//if nessesary update brand on the last beer added
	if(isset($_SESSION['brandRequired']['beer'])) {
		$query = 'UPDATE `beer` SET `brand` = '.$ID.' WHERE `ID` = '.$_SESSION['brandRequired']['beer'];
		$res = $db->query($query);
	}
} else {
	if(isset($_SESSION['brandRequired']['beer'])) {
		$query = 'SELECT `name` FROM `beer` WHERE `ID` = '.$_SESSION['brandRequired']['beer'];
		$res = $db->query($query);
		$obj = $res->fetch_object();
		echo '<h1>Add brand for '.$obj->name.'</h1>';
	} else {
		echo '<h1>Add brand</h1>';
	}
	?>
	<form action="" method="post">
		<label for="name">Name</label><input type="text" name="name" /><br />
		<label for="region">Region</label>
		<select name="region">
			<option value="NULL"></option>

	<?php
	$query = "SELECT `ID`, `name` FROM `region` WHERE 1";
	$res = $db->query($query);

	while($obj = $res->fetch_object()) {
		echo '<option value="'.$obj->ID.'">'.htmlentities($obj->name).'</option>';
	}
	?>

		</select>
		<button type="submit">Senden</button>
	</form>
<?php
}