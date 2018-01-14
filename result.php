<!DOCTYPE html>
<html>
<head>
	<title>Result</title>
</head>
<body>
<h1>Success!</h1>
<h2>User List</h2>
<table>
	<?php 
		require_once("connectdb.php");
		$query = "SELECT * FROM users";
		$result = mysql_query($query);

		echo "<table border=1><tr><th>Email</th><th>Username</th><th>Password</th></tr>";

		while($data=mysql_fetch_array($result)){
			$email=$data['email'];
			$username=$data['name'];
			$password=$data['password'];
				
			echo "<tr><td>'".$email."'</td>";
		 	echo "<td>'".$username."'</td>";
		 	echo "<td>'".$password."'</td>";
			 
		}
		echo "</tr></table>";
	?></br>
	<a href="index.php">Back</a>
</table>
</body>
</html>