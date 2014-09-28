<?php
include_once("config.php");
$db = new mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME);
session_start();

if(isset($_POST['name'])) {
	$query = 'INSERT INTO `region` (`name`, `super`) VALUES ("'.$_POST['name'].'", '.$_POST['super'].')';
	$res = $db->query($query);
	$ID = $db->insert_id;
	
	//if nessesary update region on the last beer added
	if(isset($_SESSION['regionRequired']['beer'])) {
		$query = 'UPDATE `beer` SET `region` = '.$ID.' WHERE `ID` = '.$_SESSION['regionRequired']['beer'];
		$res = $db->query($query);
		
		//if nessesary redirect to add a Brand for the beer
		if(isset($_SESSION['brandRequired']['beer'])) {
			header('Location: addBrand.php');
		}
	}
} else {
	if(isset($_SESSION['regionRequired']['beer'])) {
		$query = 'SELECT `name` FROM `beer` WHERE `ID` = '.$_SESSION['regionRequired']['beer'];
		$res = $db->query($query);
		$obj = $res->fetch_object();
		echo '<h1>Add region for '.$obj->name.'</h1>';
	} else {
		echo '<h1>Add region</h1>';
	}
	?>
	<form action="" method="post">
		<label for="name">Name</label><input type="text" name="name" /><br />
		<label for="super">Superior Region</label>
		<select name="super">

	<?php
	$query = "SELECT `ID`, `name` FROM `region` WHERE 1";
	$res = $db->query($query);

	while($obj = $res->fetch_object()) {
		echo 25;
		echo '<option value="'.$obj->ID.'">'.htmlentities($obj->name).'</option>';
	}
	?>

		</select>
		<button type="submit">Senden</button>
	</form>
<?php
}