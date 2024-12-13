<?php

/*******w******** 
    
    Name:Ramanjot kaur
    Date:9-11-2024
    Description: Final project

****************/
define('BASEPATH', true); // This must be declared before requiring 'connect.php'

require('connect.php');




     
 if (isset($_POST['sort'])) {
  // Get the user input for the sorting criteria
  $sort = $_POST['sort'];

  // Extract the sorting column and order from the user input
  if ($sort == 'name_asc') {
    $column = 'movie_name';
    $order = 'ASC';
  } else if ($sort == 'name_desc') {
    $column = 'movie_name';
    $order = 'DESC';
  } else if ($sort == 'language_asc') {
    $column = 'language';
    $order = 'ASC';
  } else if ($sort == 'language_desc') {
    $column = 'language';
    $order = 'DESC';
  }
  elseif($sort == 'price_asc'){
    $column = 'price';
    $order = 'ASC';
  }
  elseif($sort == 'price_desc'){
    $column = 'price';
    $order = 'DESC';
  }

  // Create a PDO query to retrieve the data and sort it according to the user input
  $statement = $db->prepare("SELECT * FROM movies ORDER BY $column $order");

  // Execute the query with the user input as a parameter
  $statement->execute();


}
else{
    $statement = $db->prepare("SELECT * FROM movies ORDER BY movie_name ");

  // Execute the query with the user input as a parameter
  $statement->execute();

}

 if(isset($_POST['delete'])){
    $query = "DELETE FROM my_table WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindParam(':id',$id);
    $statement->execute();


 }  


    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <title>Blockbuster Movies - Admin</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Blockbuster Movies</a></h1>
        
        <ul id="menu">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="viewMovies.php">View Movies</a></li>
            <li><a href="addmovies.php">Add movies</a></li>
            <li><a href="registeradmin.php">Add new admin</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
        <!--loop-->

        <div id="info">
            <h1>Movies list </h1>
            <form method="post" >
         <label for="sort">Sort by:</label>
  <select name="sort" id="sort">
    <option value="name_asc">Name (A-Z)</option>
    <option value="name_desc">Name (Z-A)</option>
    <option value="language_asc">Language (oldest first)</option>
    <option value="language_desc">Language(newest first)</option>
    <option value="price_asc">Price(lowest first)</option>
    <option value="price_desc">Price (highest first)</option>
  </select>
  <input type="submit" value="Sort">
        </form>
         <?php while ($row = $statement->fetch()): ?>
            <form method="get">
                <div class="movies_description">
                 <a href="movieDescription.php?id=<?= $row['movie_id'] ?>"><h2><?= $row['movie_name'] ?><a href="delete.php?id=<?= $row['movie_id'] ?>" id="edit"> Delete</a></h2></a>
                 

                 <p><?= $row['description'] ?></p>
                 <ul>

                    
                    <li>Directed by: <?= $row['director_names'] ?></li>
                    <li>Actors: <?= $row['actor_names'] ?> </li>
                    <li>Language: <?= $row['language'] ?></li>
                    <li>Price: <?= $row['price'] ?></li>
                    <li><img src="uploads/<?= $row['image'] ?>"></li>
                 </ul>
                  
            
                </div>
            </form>
          <?php endwhile ?>
        </div>
        <div id="footer">
            <a href="index.php"><pre>Home</pre></a>
            <a href="viewMovies.php"><pre>View Movies</pre></a>
            <a href="addmovies.php"><pre>Add movies</pre></a>
        </div>
    </div>
    

</body>
</html>
