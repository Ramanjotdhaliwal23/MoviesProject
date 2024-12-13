<?php

require 'connect.php';
if(isset($_GET['id'])){
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM categories WHERE category_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
        // Execute the SELECT and fetch the single row returned.
        $statement->execute();
        $row = $statement->fetch();
    } 

    else {
        $id = false; // False if we are not UPDATING or SELECTING.
}

if($_POST && isset($_POST['del'])){
     $category_name  = filter_input(INPUT_POST, 'category_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

         $query     = "DELETE FROM categories WHERE category_id = :id";

        
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

       $row = $statement->fetch();
        
        // Redirect after update.
        header("Location: Category.php");
        exit;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
     
    <title>Blockbuster Movies - Delete Genre Type  <?= $row['category_name'] ?></title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="admin.php">Blockbuster Movies - Delete genre Type</a></h1>
        
        <ul id="menu">
            <li><a href="admin.php">Home</a></li>
            <li><a href="Category.php">Return Back</a></li>
        </ul>
    </div>
        <div id="all_movies">
            <form method="post" >
                <fieldset>
                    <legend>Delete Genre Type</legend>
                    <p>Are you sure to delete this genre of movies <b><?= $row['category_name'] ?></b></p>     
                        





                        <input type="hidden" name="id" value="<?= $row['category_id'] ?>">
                        
                        <input type="submit" name="del" value="Delete">
                        
                </fieldset>

    
         
        
    </div>
        <div id="footer">
            <a href="admin.php"><pre>Home</pre></a>
            <a href="Category.php"><pre>Return Back</pre></a>
        </div>
</div>

    
</body>
</html>