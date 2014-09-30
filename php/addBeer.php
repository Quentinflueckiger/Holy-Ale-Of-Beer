<?php
include_once("config.php");
$db = new mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME);
session_start();

if(isset($_POST['name'])) {
	if(!is_numeric($_POST['brand'])) {
		$_POST['brand'] = 0;
	}
	if(!is_numeric($_POST['region'])) {
		$_POST['region'] = 0;
	}	
	
	$query = "INSERT INTO `beer` (`name`, `url`, `brand`, `region`)".
		'VALUES ("'.$_POST['name'].'", "'.$_POST['url'].'", "'.$_POST['brand'].'", "'.$_POST['region'].'")';

	$res = $db->query($query);
	$ID = $db->insert_id;

	if($_POST['region'] == 0) {
		$_SESSION['regionRequired']['beer'] = $ID;
	}
	if($_POST['brand'] == 0) {
		$_SESSION['brandRequired']['beer'] = $ID;
	}
	
	if(isset($_SESSION['regionRequired']['beer'])) {
		header("Location: addRegion.php");
	} elseif(isset($_SESSION['brandRequired']['beer'])) {
		header("Location: addBrand.php");
	}
	
} else {
?>	
<html>
<head>

	<title>Input Bier</title>
	
</head>
<body>
	
	<form action="" method="post">
  First name: <input type="text" name="fname"><br>
  Last name: <input type="text" name="lname"><br>
  <input type="submit" value="Submit">
</form>
	
	<form action="addBeer.php" method="post">
	<table width = "700" border = "1" align = "center">
		<tr>
			<td>
			<p>Name</p>
			</td>
			<td>
			<input type="text" name="name" /> 
			</td>
		</tr>
		<tr>
			<td>
			<p>Url</p>
			</td>
			<td>
			<input type="text" name="url" />
			</td>
		</tr>
		<tr>
			<td>
			<p>Marke</p>
			</td>
			<td>
			<select name="brand">
<?php 
$query = "SELECT `ID`, `name` FROM `brand` WHERE 1";
$res = $db->query($query);

while($row = $res->fetch_row()) {
	echo '<option value="'.$row[0].'">'.htmlspecialchars_decode($row[1]).'</option>';
}
?>
			<option value="new">Neue Marke</option>
			
			</select>
			</td>
		</tr>
		<tr>
			<td>
			<p>Region</p>
			</td>
			<td>
			<select name	="region">
<?php 
$query = "SELECT `ID`, `name` FROM `region` WHERE 1";
//$db = new mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME);
$res = $db->query($query);

while($row = $res->fetch_row()) {
	echo '<option value="'.$row[0].'">'.htmlspecialchars_decode($row[1]).'</option>';
}
?>
			<option value="new">Neue Region</option>
			</select>
			</td>
		</tr>
	</table>
		<input type="submit" value="submit">
	</form>
</body>
</html>

<?php
}
?>