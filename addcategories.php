<?php
/*******w******* 
    
    Name:Ramanjot kaur 
    Date:28 november 2024
    Description:Movies project

***********/

require('connect.php');

    if(!empty($_POST['category_name'])){
        $category_name = filter_input(INPUT_POST,'category_name',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $category_description = filter_input(INPUT_POST,'category_description',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $query = "INSERT INTO categories(category_name,category_description) VALUES (:category_name , :category_description)";

            $statement = $db->prepare($query);

            $statement->bindValue(':category_name',$category_name);
            $statement->bindValue(':category_description',$category_description);

            if($statement->execute()){
                echo " Sucessfully category created";
                header("Location:admin.php");
            }

    }

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <title>Blockbuster Movies - Add a new Genre Type</title>
</head>
<body>
  <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Blockbuster Movies</a></h1>    
        
        <ul id="menu">
            <li><a href="Category.php">Genres</a></li>
            <li><a href="admin.php">Return Home</a></li>

        </ul>
    </div>
    <div>
        <form action="addcategories.php" method="post">
            <fieldset>
                <legend>Create New Genre Type</legend>
            <p>
                <label for="category_name">Genre Name: </label>
                <input required = "required" type="text" name="category_name">
            </p>
            <p>
                <label for="description">Description:</label>
                <input required = "required" type="text" name="category_description" id="description">
            </p>
            <button name="button" type="submit">Create</button>
        </fieldset>
        </form>
    </div>
    <div id="footer">
        <a href="Category.php"><pre>Genres</pre></a>
        <a href="admin.php"><pre>Return Home</pre></a>
    </div>
</div>
</body>
</html>
