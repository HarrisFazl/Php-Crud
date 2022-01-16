<?php

session_start();

$name='';
$country='';
$age='';
$id=0;
$search=false;
$update=false;
$mysqli = new mysqli('localhost','root','','crud') or die (mysqli_error($mysqli));

//Inserting into SQL if save button is clicked
if(isset($_POST['save'])){
    $name= $_POST['name'];
    $country= $_POST['country'];
    $age=$_POST['age'];
    $mysqli->query("INSERT INTO data (name ,country, age) Values('$name','$country','$age')") or 
            die($mysqli->error);
    $_SESSION['message']="Record saved!";
    header("location: index.php");
}

// Delete from Database if Delete is clicked
if (isset($_GET['delete'])){
    $id=$_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id")or die ($mysqli->error());
    $_SESSION['message']="Record deleted!"; //showing messaage 
    header("location: index.php"); //getting back to index page immediatly
}

//Edit selected query and update it.
if (isset($_GET['edit'])){
    $id=$_GET['edit'];
    $update=true;
    $result=$mysqli->query("SELECT * FROM data WHERE id=$id")or die ($mysqli->error());
    $tablee=$result->fetch_array();
    if(count($tablee)!=0){
        $name= $tablee['name'];
        $country=$tablee['country'];
        $age=$tablee['age'];
    }
}
//when save button is turned to update and clicked update it.. 
if(isset($_POST['update'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $country=$_POST['country'];
    $age=$_POST['age'];
    $mysqli->query("UPDATE data SET name='$name',country='$country', age='$age' WHERE id=$id")or die ($mysqli->error());
    $_SESSION['message']="Record updated!"; //showing messaage 
    header("location: index.php"); //getting back to index page immediatly
    
}

?>