<?php
define('BASEPATH', true); // Access connection script
require 'connect.php'; // Include connection file

if (isset($_POST['submit'])) {
    try {
        global $db; // Use the connection from connect.php

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Encrypt password
        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

        // Check if username exists
        $query = "SELECT COUNT(admin_name) AS admin FROM admin WHERE admin_name = :username";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $row = $statement->fetch();

        if ($row['admin'] > 0) {
            echo '<script>alert("Username already exists")</script>';
        } else {
            // Insert user details
            $statement = $db->prepare("INSERT INTO admin(admin_name, email, password) VALUES (:username, :email, :password)");
            $statement->bindParam(':username', $username);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $password);

            if ($statement->execute()) {
                echo '<script>alert("Registered in Blockbuster Movies site")</script>';
                echo '<script>window.location.replace("Authenticiate.php")</script>';
            } else {
                echo '<script>alert("An error occurred")</script>';
            }
        }
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
        echo '<script type="text/javascript">alert("' . $error . '");</script>';
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
    <title>Blockbuster Movies - Registeration</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    
        <div id="header">
            <h1><a href="index.php">Blockbuster Movies</a></h1>
        
        <ul id="menu">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="viewMovies.php">View Movies</a></li>
            <li><a href="login.php">login</a></li>
            
        </ul>
        </div>

<form action="registeradmin.php" method="post">
    <ul>
        <li>
    <label>Enter User Name</label>
  <input type="text" required="required" name="username" >
</li>
<li>
  <label>Enter Email ID</label>
  <input required="required" type="email" name="email" placeholder="ex: someone@gmail.com">
</li>
<li>
  <label>Enter Password</label>
  <input required="required" type="password" name="password"> 
  </li>
  <li>                 
  <button name="submit" type="submit">register</button>
</li>
</ul>
  </form>
  <div id="footer">
            <a href="index.php"><pre>Home</pre></a>
            <a href="viewMovies.php"><pre>View Movies</pre></a>
            <a href="Authenticiate.php"><pre>LogIn</pre></a>
        </div>
    </body>
    </html>

