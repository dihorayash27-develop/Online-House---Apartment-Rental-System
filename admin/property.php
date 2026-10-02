<?php
    include 'db/db.php';
    if(session_status() == PHP_SESSION_NONE) {
       session_start();
    }
    if (isset($_SESSION['admin_name']))
    {
        if(isset($_GET['delete']))
        {
            $id = $_GET['delete'];
            $sql = "DELETE FROM property WHERE property_id = $id";
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
    <title>STAYSPOT - Property</title>
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
                    <div><h1>Property List</h1></div>
                </div>
                <div class="btnn">
                    <a href="add_property.php"><button class="btn">Add Property</button></a>
                </div>
                <div class="info">
                    <table cellpadding="10px">
                        <tr>
                            <th>No.</th>
                            <th>name</th>
                            <th>address</th>
                            <th>type</th>
                            <th>price</th>
                            <th>status</th>
                            <th>bedrooms</th>
                            <th>bathrooms</th>
                            <th>balcony</th>
                            <th>area</th>
                            <th>description</th>
                            <th>image 1</th>
                            <th>image 2</th>
                            <th>image 3</th>
                            <th>image 4</th>
                            <th>actions</th>
                        </tr>
                        <?php 
                        $i=1;
                        $result = mysqli_query($con,"select * from property");
                        while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['type']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><?php echo $row['bedroom']; ?></td>
                            <td><?php echo $row['bathroom']; ?></td>
                            <td><?php echo $row['balcony']; ?></td>
                            <td><?php echo $row['area']; ?>sqft</td>
                            <td><?php echo $row['description']; ?></td>
                            <td><img src="uploads/<?php echo $row['img1']; ?>" height="50px" width="50px"></td>
                            <td><img src="uploads/<?php echo $row['img2']; ?>" height="50px" width="50px"></td>
                            <td><img src="uploads/<?php echo $row['img3']; ?>" height="50px" width="50px"></td>
                            <td><img src="uploads/<?php echo $row['img4']; ?>" height="50px" width="50px"></td>
                            <td><a href='edit_property.php?edit=<?php echo $row['property_id']; ?>' onclick="return confirm('edit this property?');"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href='property.php?delete=<?php echo $row['property_id']; ?>' onclick="return confirm('delete this property?');"><i class="fa-regular fa-trash-can"></i></a></td>
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