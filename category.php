<?php
/*******w******* 
    
    Name:Pawanpreet Kaur
    Date:
    Description:

***********/
require 'connect.php';
$query = 'SELECT * FROM categories';
$statement = $db->prepare($query);
$statement->execute();


     



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <title>Blockbuster Movies - Genres</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="admin.php">Blockbuster Movies</a></h1>    
        
        <ul id="menu">
            <li><a href="Category.php">Genres</a></li>
            <li><a href="addcategories.php">Add Genre Type</a></li>
            <li><a href="admin.php">Return Back</a></li>


        </ul>
    </div>
    <div class="category_content">
    	<table>
         <thead>
         	<th>Genre</th>
         	<th>Description</th>
         </thead>
    	<tbody>
    		<?php while ($row = $statement->fetch()): ?>
    			<tr>
    				<td><?= $row['category_name'] ?></td>
    				<td><?= $row['category_description'] ?></td>
                    <td><a href="editcategory.php?id=<?= $row['category_id'] ?>">Edit</a></td>
                    <td><a href="deletecategory.php?id=<?= $row['category_id'] ?>">Delete</a><td>

    			</tr>
                <input type="hidden" name="id" value="<?= $row['category_id'] ?>">
    		<?php endwhile ?>
    	</tbody>
    	</table>
    </div>
    <div id="footer">
        <a href="Category.php"><pre>Genres</pre></a>
        <a href="addcategories.php"><pre>Add Genre Type</pre></a>
        <a href="admin.php"><pre>Return Back</pre></a>
    </div>
    </div>
</body>
</html>
