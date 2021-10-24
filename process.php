<?php

session_start();

$servername= 'localhost';
$username='root';
$password='';
$dbname='crud';

$conn = new mysqli($servername, $username, $password, $dbname);
$update= false;
$name='';
$location='';
$id=0;

// Check connection

if($conn->connect_error){
   exit('Error connecting to database');
}



if(isset($_POST['submit'])){
   $name= $_POST['name'];
   $location=$_POST['location'];

   $conn->query ("INSERT INTO data (name, location) VALUES ('$name', '$location')") or die($conn->error);

   $_SESSION['message']= "Record has been saved";
   $_SESSION['msg_type']= "success";

   header("location: index.php");
}

if(isset($_GET['delete'])){
   $id=$_GET['delete'];
   $conn->query("DELETE FROM data WHERE id=$id") or die($conn->error);

   $_SESSION['message']= "Record has been deleted";
   $_SESSION['msg_type']= "danger";

   header("location: index.php");
}



if(isset($_GET['edit'])){
   $id= $_GET['edit'];
   $result=$conn->query("SELECT * FROM data WHERE id=$id") or die($conn->error); 
   $update= true;
   if($result->num_rows){
      $row=$result->fetch_array();
      $name=$row['name'];
      $location=$row['location'];
   }

}

if(isset($_POST['update'])){
   $id=$_POST['id'];
   $name=$_POST['name'];
   $location=$_POST['location'];

   $conn->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or die ($conn->error);

   $_SESSION['message']="Record has been updated!";
   $_SESSION['msg_type']="warning";

   header('location:index.php');
}