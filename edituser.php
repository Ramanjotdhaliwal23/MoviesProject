<?php
/*******w******* 
    
    Name:Ramanjot kaur
    Date:26 novemebr 2024
    Description:Movie project

***********/
require 'connect.php';

if(isset($_POST['button'])){

	$user_name = filter_input(INPUT_POST,'user_name',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $password = $_POST['password'];
         $password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
    
    
	$query = "UPDATE users SET user_name = :user_name , email = :email , password = :password WHERE user_id = :id";
	$statement = $db->prepare($query);
	$statement->bindValue(':user_name',$user_name);
	$statement->bindValue(':email',$email);
	$statement->bindValue(':id',$id,PDO::PARAM_INT);
 $statement->bindValue(':password',$password);
	$statement->execute();

	header("Location: usersDetails.php");
	exit;

}
elseif(isset($_GET['id'])){

	$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);

	// Build the parametrized SQL query using the filtered id.
        $query = "SELECT * FROM users WHERE user_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        
        // Execute the SELECT and fetch the single row returned.
        $statement->execute();
        $row = $statement->fetch();


}
else{
	$id = false;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 

	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Blockbuster Movies - Edit user details (<?= $row['user_name'] ?>)</title>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="admin.php">Blockbuster Movies - Edit User Details</a></h1>
        
        <ul id="menu">
            <li><a href="usersDetails.php">Users</a></li>
            <li><a href="admin.php">Return Home</a></li>
        </ul>
    </div>
    <div class="genres">
    	<form method="post" action="edituser.php">
    		<fieldset>
    			<legend>Edit User Data</legend>
    			<p>
    				<label for="user_name">User Name:</label>
    				<input required = "required" type="text" name="user_name" value="<?= $row['user_name'] ?>">
    			</p>
    			<p>
    				<label for="email">Email:</label>
    				<input type="email" name="email" id= "email" value = '<?= $row['email'] ?>'>
    			</p>
                <p>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id= "password" value = '<?= $row['password'] ?>'>
                </p>
    			<input type="submit" name="button" value="Update">
    			<input type="hidden" name="id" value="<?= $row['user_id'] ?>">
    			
    		</fieldset>
    	</form>
    </div>
    <div id="footer">
    	<a href="usersDetails.php"><pre>Users</pre></a>
    	<a href="admin.php"><pre>Return Home</pre></a>
    </div>
</div>


<script>     
 const form = document.querySelector('form');
  const textarea = document.getElementById('description');

  form.addEventListener('submit', function(event) {
    if (textarea.value=== '') {
      event.preventDefault();
      alert('Please add more than one character in the description!');
    }
  });
    </script>
</body>
</html>