<?php
		require('database.php');
 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>
		</title>
	</head>
	<body>
    <?php
		if (array_key_exists('submit',$_POST)) {
			$name = $_POST['name'];
			echo $name;
			if (isset($database)) {
				echo 'Database exists!';
			} else {
				echo 'No :(';
			}
			//$insert_query = $database->query("INSERT INTO queue (name) VALUES ('$name');");

		} // array_key_exists

			/*
		  if(isset($_POST['name']))
		  {$name = $_POST['name'];

		    if(mysql_query("INSERT INTO queue VALUES('','$name')"))
		    echo "Successful Insertion!";
		    else
		    echo "Please try again";
		  }
		  $res = mysql_query("SELECT * FROM queue");
			*/
		?>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      Name: <input type="text" name="name"/><br />
		  <input name="submit" type="submit" value=" Enter "/>
		</form>

		<h1>List of companies ..</h1>

    <?php
				$current_queue = $database->query("SELECT * FROM queue;");
				while ($customers = $database->fetch_assoc($current_queue)) {
		      echo "<p>ID: " . $customers['id'] .  " Name: " . $customers['name'] . "</p><br />";
		      #echo print_r($result);
		    }
  	?>

	</body>
</html>
