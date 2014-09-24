<?php
include_once("config.php");

if(isset($_POST['submit'])) {
	//todo
}
?>	
<html>
<head>

	<title>Input Bier</title>
	
</head>
<body>
	<table width = "700" border = "1" align = "center">
		<tr>
			<td>
			<p>Name</p>
			</td>
			<td>
			<input type = "text" id="name" /> 
			</td>
		</tr>
		<tr>
			<td>
			<p>Url</p>
			</td>
			<td>
			<input type = "text" id="url" />
			</td>
		</tr>
		<tr>
			<td>
			<p>Marke</p>
			</td>
			<td>
			<select>
<?php 
$query = "SELECT `ID`, `name` FROM `brand` WHERE 1";
$db = new mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME);
$res = $db->query($query);

while($row = $res->fetch_row()) {
	echo '<option value="'.$row[0].'">'.htmlspecialchars($row[1]).'</option>';
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
			<select>
			<option value="Oberland">Oberland</option>
			
			</select>
			</td>
		</tr>
	</table>
</body>
</html>