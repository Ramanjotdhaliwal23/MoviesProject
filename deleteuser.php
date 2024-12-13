<?php

require 'connect.php';
if(isset($_GET['id'])){
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM users WHERE user_id = :id";
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
     $category_name  = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

         $query     = "DELETE FROM users WHERE user_id = :id";

        
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

       $row = $statement->fetch();
        
        // Redirect after update.
        header("Location: usersDetails.php");
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
     
    <title>Blockbuster Movies - Delete User -  <?= $row['user_name'] ?></title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="admin.php">Blockbuster Movies - Delete user</a></h1>
        
        <ul id="menu">
            <li><a href="admin.php">Home</a></li>
            <li><a href="usersDetails.php">Return Back</a></li>
        </ul>
    </div>
        <div id="all_movies">
            <form method="post" >
                <fieldset>
                    <legend>Delete User</legend>
                    <p>Are you sure to delete this user from the website <b><?= $row['user_name'] ?></b></p>     
                        





                        <input type="hidden" name="id" value="<?= $row['user_id'] ?>">
                        
                        <input type="submit" name="del" value="Delete">
                        
                </fieldset>

    
         
        
    </div>
        <div id="footer">
            <a href="admin.php"><pre>Home</pre></a>
            <a href="usersDetails.php"><pre>Return Back</pre></a>
        </div>
</div>

    
</body>
</html>