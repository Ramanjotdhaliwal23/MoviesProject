<?php
/*******w******* 
    
    Name:Pawanpreet Kaur
    Date:
    Description:

***********/
require 'connect.php';

$query = 'SELECT * FROM users';
$statement1 = $db->prepare($query);
$statement1->execute();

 if(isset($_POST['btn']) ) {

    $search = $_POST['search'];
    $query = "SELECT * FROM users WHERE user_name LIKE '%$search%' ";
    $statement = $db->prepare($query);
    $statement->execute();
    $row1 = $statement->fetchAll();
  } 
     



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <title>Blockbuster Movies - Users</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="admin.php">Blockbuster Movies</a></h1>    
        
        <ul id="menu">
            <li><a href="usersDetails.php">Users</a></li>
            <li><a href="adduser.php">Add User</a></li>
            <li><a href="admin.php">Return Back</a></li>


        </ul>
    </div>
    <div class="category_content">
        <div class="content">
        <form method="post" >
          <label for="searchbar">Search user name: </label> 
          <input type="search" name="search" id = "searchbar">
          <button type="submit" name="btn">Search</button> 
        </form>
           <?php if(isset($_POST['btn'])): ?>
                
                <?php if((count($row1) > 0) && !empty($_POST['search'])): ?>
                    <h3>Search reasult for <?= $_POST['search'] ?> </h3>
                    <ul>
                    <?php foreach($row1 as $results): ?>
                        
                        <li>User: <?= $results['user_name']?> <a href="edituser.php?id=<?= $results['user_id'] ?>">Edit</a>  <a href="deleteuser.php?id=<?= $results['user_id'] ?>">Delete</a></li>
                        <li>Email: <?= $results['email'] ?></li>
                     
                    <?php endforeach ?>
                <ul>
            <?php else: ?>
                <h2> No search result found </h2>

                <?php endif ?>
            <?php endif ?>
        </div>
    	<table>
            <caption>All Users</caption>
         <thead>
         	<th>User</th>
         	<th>Email</th>
            <th>Date&time</th>
         </thead>
    	<tbody>
    		<?php while ($row = $statement1->fetch()): ?>
    			<tr>
    				<td><?= $row['user_name'] ?></td>
    				<td><?= $row['email'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><a href="edituser.php?id=<?= $row['user_id'] ?>">Edit</a></td>
                    <td><a href="deleteuser.php?id=<?= $row['user_id'] ?>">Delete</a><td>

    			</tr>
                <input type="hidden" name="id" value="<?= $row['user_id'] ?>">
    		<?php endwhile ?>
    	</tbody>
    	</table>
    </div>
    <div id="footer">
        <a href="usersDetails.php"><pre>Users</pre></a>
        <a href="adduser.php"><pre>Add User</pre></a>
        <a href="admin.php"><pre>Return Back</pre></a>
    </div>
    </div>
</body>
</html>
