<?php
    include 'db/db.php';
    if(session_status() == PHP_SESSION_NONE) {
       session_start();
    }
    if (isset($_SESSION['admin_name']))
    {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>STAYSPOT - Admin Panel</title>
</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1><i class="fas fa-house"></i>STAYSPOT</h1>
        </div>
        
        <ul>
            <li><a href="index.php"><i class="fa-solid fa-chess-board"></i><span>Dashboard</span></a></li>
            <li><a href="property.php"><i class="fa-solid fa-house"></i><span>Property</span></a></li>
            <li><a href="tenants.php"><i class="fa fa-user-friends"></i><span>Tenants</span></a></li>
            <li><a href="payments.php"><i class="fas fa-credit-card"></i><span>Payments</span></a></li>
            <li><a href="users.php"><i class="fa fa-users"></i><span>Users</span></a></li>
            <li><a href="feedback.php"><i class="fa-solid fa-comment"></i><span>Feedback</span></a></li>
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="account">
                    <div class="dropdown">
                        <button class="dropbtn"><i class="fa fa-user"></i> Account <i class="fa fa-caret-down"></i></button>
                        <div class="dropdown-content">
                            <a href="logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="main">
                <div class="h1">
                    <h1>Welcome Back Administrator!</h1>
                </div>
                <div class="cards">
                    
                    <a href="property.php" style="color: white;"><div class="card" style="background: #007bff;">
                        <div class="box">
                            <?php $sql = "SELECT COUNT(*) as total_property FROM property"; 
                                  $result = $con->query($sql); 
                                  if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                            ?>
                            <h1><?php echo $row["total_property"]; ?></h1>
                            <?php
                               } 
                            ?>
                            <h3>Property</h3>
                        </div>
                        <div class="icon-case">
                            <i class="fa-solid fa-house"></i>
                        </div>
                    </div></a>
                    <a href="tenants.php" style="color: white;"><div class="card" style="background: #ffc107;">
                        <div class="box">
                            <?php $sql = "SELECT COUNT(*) as total_tenant FROM tenant"; 
                                  $result = $con->query($sql); 
                                  if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                            ?>
                            <h1><?php echo $row["total_tenant"]; ?></h1>
                            <?php
                               } 
                            ?>
                            <h3>Tenants</h3>
                        </div>
                        <div class="icon-case">
                            <i class="fa fa-user-friends "></i>
                        </div>
                    </div></a>
                    <a href="payments.php" style="color: white;"><div class="card" style="background: #28a745;">
                        <div class="box">
                            <?php $sql = "SELECT sum(total_rent) as payments FROM payment"; 
                                  $result = $con->query($sql); 
                                  if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                            ?>
                            <h1 style="font-size: 25px;">₹<?php echo $row["payments"]; ?>.00</h1>
                            <?php
                               }
                            ?>
                            
                            <h3>Payment</h3>
                        </div>
                        <div class="icon-case">
                            <i class="fas fa-credit-card"></i>
                        </div>
                    </div></a>
                    <a href="users.php" style="color: white;"><div class="card" style="background: #ff6e07;">
                        <div class="box">
                            <?php $sql = "SELECT COUNT(*) as total_users FROM user_reg"; 
                                  $result = $con->query($sql); 
                                  if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                            ?>
                            <h1><?php echo $row["total_users"]; ?></h1>
                            <?php
                               } 
                            ?>
                            <h3>Users</h3>
                        </div>
                        <div class="icon-case">
                            <i class="fa fa-users "></i>
                        </div>
                    </div></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    }
    else{
        header("location: login.php");
    }
?>