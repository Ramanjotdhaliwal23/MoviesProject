<?php
/*******w******* 
    
    Name:Ramanjot kaur 
    Date:28 november 2024
    Description:Movie proejct

***********/

require('connect.php');

    if(isset($_POST['button']) && !empty($_POST['email']) && !empty($_POST['user_name'])){
        $user_name = filter_input(INPUT_POST,'user_name',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
         $password = $_POST['password'];
         $password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

        $query = "INSERT INTO users(user_name,email,password) VALUES (:user_name ,:email,:password)";

            $statement = $db->prepare($query);

            $statement->bindValue(':user_name',$user_name);
            $statement->bindValue(':email',$email);
            $statement->bindValue(':password',$password);

            if($statement->execute()){
                echo " Sucessfully user created";
                header("Location:usersDetails.php");
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
    
    
    <title>Blockbuster Movies - Add a new user</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Blockbuster Movies</a></h1>    
        
        <ul id="menu">
            <li><a href="usersDetails.php">Users</a></li>
            <li><a href="admin.php">Return Home</a></li>

        </ul>
    </div>
    <div>
        <form action="adduser.php" method="post">
            <fieldset>
                <legend>Add New User</legend>
            <p>
                <label for="user_name">User Name: </label>
                <input required = "required" type="text" name="user_name">
            </p>
            <p>
                <label for="email">Email:</label>
                <input type="email" required name="email" id="email">
            </p>
            <p>
                <label for="password">Password:</label>
                <input type="password" required name="password" id="password">
            </p>
            <button name="button" type="submit">Add</button>
         </fieldset>
        </form>

    </div>
    <div id="footer">
        <a href="usersDetails.php"><pre>Users</pre></a>
        <a href="admin.php"><pre>Return Home</pre></a>
    </div>
</div>
</body>
</html>
