<?php
define('BASEPATH', true); // This must be declared before requiring 'connect.php'

require('connect.php');
/**
 * Name: Ramanjot kaur
 * Date: 13-11-2024
 * Description: project
 * */

  /*define('ADMIN_LOGIN','employee');

  define('ADMIN_PASSWORD','mypass');

  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])

      || ($_SERVER['PHP_AUTH_USER'] != ADMIN_LOGIN)

      || ($_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD)) {

    header('HTTP/1.1 401 Unauthorized');

    header('WWW-Authenticate: Basic realm="Our Blog"');

    exit("Access Denied: Username and password required.");

  }
  $sql = "SELECT admin_id,user_name,password FROM admin WHERE user_name = :username";
  $stmt = $db->prepare($sql);

  $stmt->bindValue(':username',$username);
*/
 /*
define('BASEPATH', true); 
require 'connect.php'; 

if(isset($_POST['submit']) && !empty($_POST['username'] && !empty($_POST['password']))){  
        
            $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //ensure fields are not empty
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    //Retrieve the user account information for the given username.
    $query = "SELECT user_id, user_name, password FROM users WHERE user_name = :username";
    $statement = $db->prepare($query);
   
    $statement->bindValue(':username', $username);
    
    
    $statement->execute();
    
    
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    
  
    if($username === false){
       echo '<script>alert("invalid username or password")</script>';
    } 
    else{
         
        $validPass = password_verify($passwordAttempt, $row['password']);
        
        //If $validPassword is TRUE, the login is done.
        if($validPass){
            
           
             
            $_SESSION['username'] = $username;
           echo '<script>window.location.replace("index.php");</script>';
            exit;
            
        } else{
            //$validPassword was FALSE. Passwords do not match.
            echo '<script>alert("invalid username or password, Please Try again")</script>';
        }
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
    <title>Blockbuster Movies - LogIn</title>
</head>
<body>
          <div id="header">
            <h1><a href="index.php">Blockbuster Movies</a></h1>
        
        <ul id="menu">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="viewMovies.php">View Movies</a></li>
            <li><a href="authenticate.php">login</a></li>
            
        </ul>
        </div> 

<form action="login.php" method="post" id="authenticateForm"> 
<header>Log In</header> 
<ul>
  <li>
<label for="username">Enter username</label>                        
 <input type="text" name="username">
</li>
<li>
 <label for="password">Enter Password</label>
 <input type="password" name="password">
 </li>
 <li>    
 <button name="submit" type="submit">Sign in</button>
</li>
</ul>
 <p>If not registerd, Please <a href="registered.php">Register here.</a>
 </form>
 <div id="footer">
            <a href="index.php"><pre>Home</pre></a>
            <a href="viewMovies.php"><pre>View Movies</pre></a>
            <a href="authenticate.php"><pre>LogIn</pre></a>
        </div>
</body>
</html>
*/
// Start the session (if it hasn't already been started)
session_start();

// If the user is already logged in, redirect them to the dashboard page
if (isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the username and password from the form
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Connect to the database using PDO

  //$db = new PDO($dsn, $user, $password);

  // Prepare the SQL query
  $sql = "SELECT * FROM users WHERE user_name = :username";

  // Execute the query and fetch the result
  $stmt = $db->prepare($sql);
  $stmt->execute(['username' => $username]);
  $row = $stmt->fetch();

  // Verify the password
  if ($row && password_verify($password, $row['password'])) {
    // Password is correct, start a new session
    session_regenerate_id();
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['username'] = $row['user_name'];

    // Redirect the user to the dashboard page
    header('Location: index.php');
    exit();
  } else {
    // Password is incorrect, show an error message
    $error = 'Invalid username or password';
  }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
  </head>
  <body>
    <h1>Login</h1>   <?php if (isset($error)): ?>
      <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required><br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br><br>
      <input type="submit" value="Login">
    </form>
  </body>
</html>

