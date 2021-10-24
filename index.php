<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <title>Document</title>
</head>
<body>
<?php require ('process.php'); ?>

<?php

if(isset($_SESSION['message'])):?>
<div class="alert alert-<?php echo $_SESSION['msg_type']?>">

   <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
   ?>
</div>
<?php endif ?>

<?php
   $conn= new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($conn));
   $result= $conn->query("SELECT *FROM data") or die($conn->error);
?>
<div class="container">
<div class="d-flex justify-content-center">
<table class="table">
   <thead>
      <tr>
         <th>Name</th>
         <th>Location</th>
         <th colspan="2">Action</th>
      </tr>
   </thead>
<?php
while($row=$result->fetch_assoc()):?>
   <tr>
      <td><?php echo $row['name'];?></td>
      <td><?php echo $row['location'];?></td>
      <td>
         <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
         <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
      </td>
      <?php endwhile; ?>
   </tr>
</table>

</div>
<?php

   function pre_r($array){
      echo '<pre>';
      print_r($array);
      echo '</pre>';
   }
   ?>


<div class="d-flex justify-content-center">
   <form action="process.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $id;?>">
      <div class="form-group">
         <label>Name</label>
         <input type="text" name="name" class="form-control" value="<?php echo $name;?>" placeholder="Enter your name">
      </div>  
      <div class="form-group">    
         <label>Location</label>
         <input type="text" name="location" class="form-control" value="<?php echo $location;?>"" placeholder="Enter your location">
      </div>
      <div class="form-group">
        <?php if($update==true): ?>
            <button type="submit" class="btn btn-info" name="update">Update</button>
        <?php else: ?>
            <button type="submit" class="btn btn-primary" name="submit">Save</button>
         <?php endif; ?>
      </div>
   </form>
</div>
</div>
</body>
</html>