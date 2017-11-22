<?php include("config.php"); 
$q_db = 'SELECT * FROM tax_rates WHERE 1';

		
		if ($r_db = mysqli_query($conn,$q_db)) {
	
			while ($rw_db = mysqli_fetch_assoc($r_db)) {
				$rpedido[] = $rw_db;
			}}
			var_dump($rpedido);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Documento sin título</title>
</head>

<body>

</body>
</html>