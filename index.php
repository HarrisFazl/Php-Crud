<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>CRUD</title>
</head>
<body>
    <?php require_once 'process.php';?>


    <?php
    $mysqli = new mysqli('localhost','root','','crud') or die (mysqli_error($mysqli));
    $result= $mysqli->query("SELECT * FROM data") or 
            die($mysqli->error); 
    ?>

    <?php
    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
    
    ?>
    <h1 id='mainheading'>INFORMATION STORE PHP CRUD</h1>
        <form class="form"; action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="inputs">
        <label>Enter Your Name :</label>
        <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter Your Name" >
        </div>
        <div class="inputs">
        <label class='label'>Enter Your Country :</label>
        <input type="text" name="country" value="<?php echo $country; ?>" placeholder="Enter Country">
        </div>
        <div class="inputs">
        <label class='label'>Enter Your Age :</label>
        <input type="text" name="age" value="<?php echo $age; ?>" placeholder="Enter age">
        </div>
      
        <?php 
        if($update == true):
        ?>
        <button class='submitbutton' type="submit" name="update">Update</button>
        <?php else : ?>
        <button class='submitbutton' type="submit" name="save">Save</button>
        <?php endif ; ?>
        <?php
    
        if(isset($_SESSION['message'])): ?>
        <div class='message'>
        <?php echo $_SESSION['message'];
        unset($_SESSION['message']);
    
        ?>
    </div>
    
    <?php endif ;?>

    </form>
    <div class='paragraph'>
            <p>
                Hello Allians!!
                Here You can save Your Information rergarding Name country and age..
                This is a simple PhP CRUD where you can do following operations..
                <br>Create<br>Read <br>Update <br>Delete the Data...You can Also check the stored Data in Local host SQL Database:
            </p>
    </div>
    <div class="tablee">
    <table class="table">
        <thead>
        <tr><th colspan='5'>Database Table</th></tr>
        <tr>
            <th>Name</th>
            <th>Country</th>
            <th>Age</th>
            <th colspan="2">Action</th>
        </tr>
        </thead>
<?php 
    while ($tablee=$result->fetch_assoc()): ;?> 
    <tr>
    
        <td><?php echo $tablee['name'];?></td>
        <td><?php echo $tablee['country'];?></td>
        <td><?php echo $tablee['age'];?></td>
        <td>
            <button class='editbutton'><a href ="index.php?edit=<?php echo $tablee['id'];?>">Edit</a></button>
            <button class='delbutton'><a href ="process.php?delete=<?php echo $tablee['id'];?>">Delete</a></button>
        </td>
    </tr>
    <?php
    endwhile ; ?>
    </table>
    </div>
</body>
</html>
