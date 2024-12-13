<?php

/*******w******** 
    
    Name:Ramanjot kaur 
    Date:08-11-2024
    Description:Final project 

****************/

require('connect.php');
if(isset($_POST['btn'])){
    $category_id = $_POST['category_id'];
    if($category_id != " "){
     $query = "SELECT * FROM movies  WHERE category_id = $category_id 
              ORDER BY (movie_id) DESC";
    $statement = $db->prepare($query);
    $statement->execute(); 
 }
 else{
     $query = "SELECT * FROM movies   
              ORDER BY (movie_id) DESC";

     $statement = $db->prepare($query);
     $statement->execute(); 

 }
 }
 else{
  $query = "SELECT * FROM movies JOIN categories ON categories.category_id =movies.category_id 
              ORDER BY (movie_id) DESC";
  $statement = $db->prepare($query);
  $statement->execute(); 
    

}
$query2 = "SELECT * FROM categories";
$statement2 = $db->prepare($query2);
$statement2->execute();
$categoryRow = $statement2->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Blockbuster Movies - View Movies</title>
</head>
<body>
   <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Blockbuster Movies</a></h1>
        
        <ul id="menu">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="viewMovies.php">View Movies</a></li>
            <li><a href="Login.php">LogIn</a></li>
            <li><a href="authenticate.php">Admin</a></li>
        </ul>
        </div> 
       <h1>Movies List</h1>
    
            <form method="post">
                <p>
                    <label for="category">Genre: </label>
                    <select name="category_id">
                        <option value=" ">All</option>
                        <?php foreach($categoryRow as $results): ?>
                            <option value="<?= $results['category_id'] ?>"><?= $results['category_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <button type = "submit" name="btn">Search</button>

                </p>
                
            </form>
     <?php while ($row = $statement->fetch()): ?>
        
                <div class="movies_description">
                 <a href="movieDescription.php?id=<?= $row['movie_id'] ?>"><h2><?= $row['movie_name'] ?></h2></a>
                 <a href="movieDescription.php?id=<?=$row['movie_id'] ?>"><img src="uploads/<?= $row['image'] ?>"></a>
            
                </div>
            
          <?php endwhile ?>
        </div>
        <div id="footer">
            <a href="index.php"><pre>Home</pre></a>
            <a href="viewMovies.php"><pre>View Movies</pre></a>
            <a href="login.php"><pre>LogIn</pre></a>
            <a href="authenticate.php"><pre>Admin</pre></a>
        </div>
    </div>
    

</body>
</html>
