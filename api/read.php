<!DOCTYPE html>


<html>

<head>
	<title>
		Postback Parameters table
	</title>
	
<style type="text/css">
body {
	width:800px;
	border:red 1px solid;
	border-style:dashed;
	margin:auto;
	padding:10px;
}
td {
	text-align:center;
	padding:10px;
}
table {
	margin:auto;
	border:blue 1px solid;
}
label {
	font-size:18px;
	color:blue;
    font-weight: bold;
    font-family: cursive;
}
h2 {
	color:red;
	text-align:center;
}
th {
	color:red;
	font-size:20px;
    font-family: cursive;
}
</style>

</head>

<body>

<table border="1" cellspacing="5" cellpadding="5" width="100%">
	<thead>
		<tr>
			<th>ID.</th>
			<th>Postback Parameters</th>
			<th>Created at</th>
		</tr>
	</thead>
	<tbody>
	<?php
    // Headers
    header('Cache-Control: no-cache');

		include_once '../config/Database.php';
    include_once '../models/Postback.php';
    
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate postback object
    $postback = new Postback($db);

      
    // postback read query
    $result = $postback->read();
      for($i=0; $row = $result->fetch(); $i++){
	?>
		<tr>
			<td><label><?php echo $row['id']; ?></label></td>
			<td><label><?php echo $row['postback_params']; ?></label></td>
			<td><label><?php echo $row['created_at']; ?></label></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

</body>

</html>


