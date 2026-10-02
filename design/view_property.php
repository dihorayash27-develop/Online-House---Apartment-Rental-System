<?php
include "header.php"; 

// Handle button actions
if (isset($_POST['loginn'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['save'])) {
   $user_id = $_SESSION['user_id'];
   $property_id = $_GET['id'];
   $check_existing = mysqli_query($con, "SELECT * FROM wishlist WHERE user_id = $user_id AND property_id = $property_id");
   if (mysqli_num_rows($check_existing) == 0) {
       $insert_wishlist = mysqli_query($con, "INSERT INTO wishlist (user_id, property_id) VALUES ($user_id, $property_id)");
       if ($insert_wishlist) {
           header("Location: saved.php");
           exit();
       } 
   } else {
       echo "<script type='text/javascript'> 
                   alert('Property already saved!'); 
             </script>";
   }
}

if (isset($_POST['book'])) {
   $user_id = $_SESSION['user_id'];
   $property_id = $_GET['id'];
   header("Location: tenant.php?uid=$user_id&pid=$property_id");
   exit();
}
?>

<section class="view-property">
   <?php 
   $id = $_GET['id'];
   $result = mysqli_query($con, "SELECT * FROM property WHERE property_id = $id");
   while ($row = mysqli_fetch_assoc($result)) { ?>
   <div class="details">
      <div class="thumb">
         <div class="big-image">
            <img src="../admin/uploads/<?php echo $row['img1']; ?>" alt="">
         </div>
         <div class="small-images">
            <img src="../admin/uploads/<?php echo $row['img1']; ?>" alt="">
            <img src="../admin/uploads/<?php echo $row['img2']; ?>" alt="">
            <img src="../admin/uploads/<?php echo $row['img3']; ?>" alt="">
            <img src="../admin/uploads/<?php echo $row['img4']; ?>" alt="">
         </div>
      </div>
      <h3 class="name"><?php echo $row['name']; ?></h3>
      <p class="location"><i class="fas fa-map-marker-alt"></i><span><?php echo $row['address']; ?></span></p>
      <h3 class="title">Details</h3>
      <div class="flex">
         <div class="box">
            <p><i>Price(Monthly) :</i><span><?php echo $row['price']; ?>rs</span></p>
            <p><i>Property Type :</i><span><?php echo $row['type']; ?></span></p>
            <p><i>Status :</i><span><?php echo $row['status']; ?></span></p>
            <p><i>Carpet area :</i><span><?php echo $row['area']; ?>sqft</span></p>
         </div>
         <div class="box">
            <p><i>Bedroom :</i><span><?php echo $row['bedroom']; ?></span></p>
            <p><i>Bathroom :</i><span><?php echo $row['bathroom']; ?></span></p>
            <p><i>Balcony :</i><span><?php echo $row['balcony']; ?></span></p>
         </div>
      </div>
      <h3 class="title">Description</h3>
      <p class="description"><?php echo $row['description']; ?></p>
      <form action="" method="post">
         <?php if (isset($_SESSION['user_name'])) { ?>
                  <?php if($row['status'] == 'rented') { ?>
                     
                  <?php } else { ?>
                     <input type="submit" value="book property" name="book" class="inline-btn">
                     <input type="submit" value="save property" name="save" class="inline-btn">
                  <?php } ?>
         <?php } else { ?>
            <input type="submit" value="book property" name="loginn" class="inline-btn">
            <input type="submit" value="save property" name="loginn" class="inline-btn">
         <?php } ?>
      </form>
   </div>
   <?php } ?>
</section>

<?php include "footer.php"; ?>
