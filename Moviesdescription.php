<?php
/*******w******** 
    
    Name:Pawanpreet Kaur
    Date:
    Description:

****************/
require('connect.php');

    // Build and prepare SQL String with :id placeholder parameter.
    $query = "SELECT * FROM movies WHERE movie_id = :id LIMIT 1";
    $statement = $db->prepare($query);
    
    // Sanitize $_GET['id'] to ensure it's a number.
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    // Bind the :id parameter in the query to the sanitized
    // $id specifying a binding-type of Integer.
    $statement->bindValue('id', $id, PDO::PARAM_INT);
    $statement->execute();
    
    // Fetch the row selected by primary key id.
    $row = $statement->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Blockbuster Movies - <?= $row['movie_name'] ?></title>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<h1><a href="index.php">Blockbuster movies</a></h1>
		</div>
		<ul id="menu">
			<li><a href="index.php">Home</a></li>
			<li><a href="admin.php">Admin</a></li>
		</ul>
		<div id="all_movies">
			<div class="post">
				<h2><?= $row['movie_name'] ?></h2>
				<p>
					<small>
						<?= $row['description']?> - 
						 
					</small>
				</p>
				<p>More Info</p>
				<div class="movie_content">
					<ul><li>Language:<?= $row['language'] ?></li>
						<li>Actors:<?= $row['actor_names'] ?></li>
						<li>Directed By:<?= $row['director_names'] ?></li>
						<li>Price: $ <?= $row['price'] ?></li>
						
					</ul>
				</div>

			</div>

			
		</div> 
		<div id="footer"><a href="index.php"><pre>Home</pre></a>
			<a href="admin.php"><pre>Admin</pre></a>

		</div>
	</div>


</body>
</html>
