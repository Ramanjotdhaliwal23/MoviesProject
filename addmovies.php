<?php

/*******w******** 
    
    Name:Ramanjot kaur 
    Date:28 novemebr 2024
    Description:Movies project

****************/

require('connect.php');


    if ( !empty($_POST['name']) && !empty($_POST['description'] && !empty($_POST['language']))) {
        
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $language = filter_input(INPUT_POST,'language',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $actors = filter_input(INPUT_POST,'actors',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $directors = filter_input(INPUT_POST,'directors',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $price = filter_input(INPUT_POST,'price',FILTER_SANITIZE_NUMBER_INT);
        $image = $_FILES['image']['name'];
        
       
            $query = "INSERT INTO movies (movie_name,description,language,actor_names,director_names,price,image) VALUES (:name,:description,:language,:actors,:directors,:price,:image)";
            $statement = $db->prepare($query);
        
        //  Bind values to the parameters
           $statement->bindValue(':name',$name);
           $statement->bindValue(':description',$description);
           $statement->bindValue(':language',$language);
           $statement->bindValue(':actors',$actors);
           $statement->bindValue(':directors',$directors);
           $statement->bindValue(':price',$price);
           $statement->bindValue(':image',$image);
        
        //  Execute the INSERT.
        //  execute() will check for possible SQL injection and remove if necessary
           if ($statement->execute()) {
               // code...
            echo "Success";
            header("Location: admin.php");
           }

}
    




    // file_upload_path() - Safely build a path String that uses slashes appropriate for our OS.
    // Default upload path is an 'uploads' sub-folder in the current folder.
    function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
       $current_folder = dirname(__FILE__);
       
       // Build an array of paths segment names to be joins using OS specific slashes.
       $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
       
       // The DIRECTORY_SEPARATOR constant is OS specific.
       return join(DIRECTORY_SEPARATOR, $path_segments);
    }

    // file_is_an_image() - Checks the mime-type & extension of the uploaded file for "image-ness".
    function file_is_an_image($temporary_path, $new_path) {
        $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png','image/pdf'];
        $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png','pdf'];
        
        $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
        $actual_mime_type        = getimagesize($temporary_path)['mime'];
        
        $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
        $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
        
        return $file_extension_is_valid && $mime_type_is_valid;
    }
    
    $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
    $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

    if ($image_upload_detected) { 
        $image_filename        = $_FILES['image']['name'];
        $temporary_image_path  = $_FILES['image']['tmp_name'];
        $new_image_path        = file_upload_path($image_filename);
        if (file_is_an_image($temporary_image_path, $new_image_path)) {
            move_uploaded_file($temporary_image_path, $new_image_path);
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
    
    <title>Blockbuster Movies - Add a new movie</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Blockbuster Movies</a></h1>    
        
        <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="viewMovies.php" class="active">View Movies</a></li>
            <li><a href="admin.php">Admin</a></li>

        </ul>
    </div>
        <div>
            <form action="addmovies.php" method="post" enctype='multipart/form-data'>
                <fieldset>
                    <legend>New Movie Information</legend>
                    <p>
                        <label for="name">Movie Name</label>
                        <input required = "required" type="text" name="name" id="name">
                    </p>
                    <p>
                        <label for="description">Description</label>
                        <textarea required = "required" name="description" id="description"></textarea>
                    </p>
                    <p>
                        <label for="language">Language</label>
                        <textarea required = "required" name="language" id="language"></textarea>
                    </p>
                    <p>
                        <label for="actors">Actors</label>
                        <textarea required = "required" name="actors" id="actors"></textarea>
                    </p>
                    <p>
                        <label for="directors">Directed By</label>
                        <textarea required = "required" name="directors" id="directors"></textarea>
                    </p>
                    <p>
                        <label for="price">Price</label>
                        <textarea required = "required" name="price" id="price"></textarea>
                    </p>
                 <p>
                        

                        
                        
         <label for='image'>Image Filename:</label>
         <input type='file' name='image' id='image'>
             
     </p>

            
                             <button name="button" type="submit">Create</button>
                </fieldset>
            </form>
                    
      

           
            <?php if(isset($_POST['button']) && (empty($_POST['name']) || empty($_POST['description']))): ?>
                <p id="error">**There should be at least one character in movie name and description**</p>
            
        <?php endif ?>
        </div>

    
    <div id="footer">
        <a href="index.php"><pre>Home</pre></a>
            <a href="viewMovies.php"><pre>View Movies</pre></a>
            <a href="admin.php"><pre>Admin</pre></a>
    </div>
</div>
    
</body>
</html>
