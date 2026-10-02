<?php
    include 'db/db.php';
    if(session_status() == PHP_SESSION_NONE) {
       session_start();
    }
    if (isset($_SESSION['admin_name']))
    {
        if(isset($_GET['tid']))
        {
            $id = $_GET['tid'];
            $sql = "DELETE FROM tenant WHERE tenant_id = $id";
            $result = mysqli_query($con, $sql);
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>STAYSPOT - Tenants</title>
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
                            <!-- <a href="manage-account.php"><i class="fa fa-cog"></i>Manage Account</a> -->
                            <a href="logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content">
            <div class="main">
                <div class="h1">
                    <h1>Tenants Management</h1>
                </div>
                <div class="info">
                    <table cellpadding="10px">
                        <tr>
                            <th>No.</th>
                            <th>Property</th>
                            <th>fullname</th>
                            <th>email</th>
                            <th>number</th>
                            <th>address</th>
                            <th>rent month</th>
                            <th>date from</th>
                            <th>date to</th>
                            <th>total rent</th>
                            <!-- <th>actions</th> -->
                        </tr>
                        <?php 
                        $i=1;
                        $result = mysqli_query($con, "SELECT tenant.*, property.name FROM tenant JOIN property ON tenant.property_id = property.property_id");
                        while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['fullname']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['number']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['rent_month']; ?></td>
                            <td><?php echo $row['date_from']; ?></td>
                            <td><?php echo $row['date_to']; ?></td>
                            <td>₹<?php echo $row['total_rent']; ?></td>
                         </tr>
                         <?php } ?>
                    </table>
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