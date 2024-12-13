<?php
define('BASEPATH', true); // This must be declared before requiring 'connect.php'

require 'connect.php';

session_start();

// If the user is already logged in, redirect them to the dashboard page
if (isset($_SESSION['admin_id'])) {
  header('Location: admin.php');
  exit();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the username and password from the form
  $adminname = $_POST['adminname'];
  $password = $_POST['password'];

  // Connect to the database using PDO

  //$db = new PDO($dsn, $user, $password);

  // Prepare the SQL query
  $sql = "SELECT * FROM admin WHERE admin_name = :adminname";

  // Execute the query and fetch the result
  $stmt = $db->prepare($sql);
  $stmt->execute(['adminname' => $adminname]);
  $row = $stmt->fetch();

  // Verify the password
  if ($row && password_verify($password, $row['password'])) {
    // Password is correct, start a new session
    session_regenerate_id();
    $_SESSION['admin_id'] = $row['admin_id'];
    $_SESSION['adminname'] = $row['admin_name'];

    // Redirect the user to the dashboard page
    header('Location: admin.php');
    exit();
  } else {
    // Password is incorrect, show an error message
    $error = 'Invalid adminname or password';
  }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
  </head>
  <body>
    <h1>Login As admin</h1>   
    <?php if (isset($error)): ?>
      <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="admin.php" method="post">
      <label for="adminname">Admin Name:</label>
      <input type="text" id="adminname" name="adminname" required><br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br><br>
      <input type="submit" value="Signin">
      
    </form>
  </body>
</html>

