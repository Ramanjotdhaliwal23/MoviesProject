<?php
/*******w******* 
    
    Name:Ramanjot kaur
    Date:28 novemebr 2024
    Description:Movie project

***********/
require 'connect.php';

if($_POST && isset($_POST['button'])){

	$category_name = filter_input(INPUT_POST,'category_name',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$category_description = filter_input(INPUT_POST,'category_description',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);


	$query = "UPDATE categories SET category_name = :category_name , category_description = :category_description WHERE category_id = :id";
	$statement = $db->prepare($query);
	$statement->bindValue(':category_name',$category_name);
	$statement->bindValue(':category_description',$category_description);
	$statement->bindValue(':id',$id,PDO::PARAM_INT);

	$statement->execute();

	header("Location: Category.php");
	exit;

}
elseif(isset($_GET['id'])){

	$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);

	// Build the parametrized SQL query using the filtered id.
        $query = "SELECT * FROM categories WHERE category_id = :id";
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
	<title>Blockbuster Movies - Edit Genre Type (<?= $row['category_name'] ?>)</title>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="admin.php">Blockbuster Movies - Edit</a></h1>
        
        <ul id="menu">
            <li><a href="Category.php">Genres</a></li>
            <li><a href="admin.php">Return Home</a></li>
        </ul>
    </div>
    <div class="genres">
    	<form method="post" action="editcategory.php">
    		<fieldset>
    			<legend>Edit Genre Type</legend>
    			<p>
    				<label for="category_name">Genre:</label>
    				<input required = "required" type="text" name="category_name" value="<?= $row['category_name'] ?>">
    			</p>
    			<p>
    				<label for="description">Description:</label>
    				<input type="text" name="category_description" value="<?= $row['category_description'] ?>">
    			</p>
    			<input type="submit" name="button" value="Update">
    			<input type="hidden" name="id" value="<?= $row['category_id'] ?>">
    		</fieldset>
    	</form>
    </div>
    <div id="footer">
    	<a href="Category.php"><pre>Genres</pre></a>
    	<a href="admin.php"><pre>Return Home</pre></a>
    </div>
</div>



</body>
</html>