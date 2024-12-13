<?php
 define('BASEPATH',true);//access connection script if you omit this line file will be blank
require 'connect.php'; //require connection script

 if(isset($_POST['submit'])){  
        try {
            $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  
         $username = $_POST['username'];
         $email = $_POST['email'];
         $password = $_POST['password'];
         
         //encrypt password
         $password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
          
         //Check if username exists
         $query = "SELECT COUNT(user_name) AS user FROM users WHERE user_name = :username";
         $statement = $db->prepare($query);

         $statement->bindValue(':username', $username);
         $statement->execute();
         $row = $statement->fetch(PDO::FETCH_ASSOC);

         if($row['user_name'] > 0){
             echo '<script>alert("Username already exists")</script>';
        }
        
       else{

    $statement = $dsn->prepare("INSERT INTO users (user_name, email, password) 
    VALUES (:username,:email, :password)");
    $statement->bindParam(':username', $username);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':password', $password);
    
    

   if($statement->execute()){
    echo '<script>alert("Registered in blockbuster movies site")</script>';
    //redirect to another page
    echo '<script>window.location.replace("index.php")</script>';
     
   }else{
       echo '<script>alert("An error occurred")</script>';
   }
}
}catch(PDOException $e){
    $error = "Error: " . $e->getMessage();
    echo '<script type="text/javascript">alert("'.$error.'");</script>';
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

<form action="registered.php" method="post">
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
            <a href="authenticate.php"><pre>LogIn</pre></a>
        </div>
    </body>
    </html>

