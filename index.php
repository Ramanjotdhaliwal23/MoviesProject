<?php

/*******w******** 
    
    Name: Ramanjot kaur 
    Date: 9-11-2024
    Description:project

****************/
define('BASEPATH', true); // This must be declared before requiring 'connect.php'

require('connect.php');
     $query = "SELECT * FROM movies ORDER BY (movie_id) DESC";

     // A PDO::Statement is prepared from the query.
     $statement = $db->prepare($query);

     // Execution on the DB server is delayed until we execute().
     $statement->execute(); 
    


    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Blockbuster Movies - Home</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Blockbuster Movies</a></h1>
        
        <ul id="menu">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="admin.php">Admin</a></li>
        </ul>
        </div> 
        <!--loop-->

        <div id="info">
            <h1>Movies list </h1>
         <?php while ($row = $statement->fetch()): ?>
            <form method="get">
                <div class="movies_description">
                 <a href="movieDescription.php?id=<?= $row['movie_id'] ?>"><h2><?= $row['movie_name'] ?></h2></a>
                 <?php if(strlen($row['description']) > 200): ?>
                    <div>
                 <p><?= strip_tags(substr($row['description'],0,150)) ?>
                <a href="movieDescription.php?id=<?= $row['movie_id'] ?>"> Know more</a></p>
                  </div>
                  <?php else: ?>
                    <div class="content"><?= $row['description'] ?></div>
                <?php endif ?>
            
                </div>
            </form>
          <?php endwhile ?>
        </div>
        <div id="footer">
            <a href="index.php"><pre>Home</pre></a>
            <a href="admin.php"><pre>Admin</pre></a>
        </div>
    </div>
    

</body>
</html>
