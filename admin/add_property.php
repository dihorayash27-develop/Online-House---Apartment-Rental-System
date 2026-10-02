<?php
    include 'db/db.php';
    if(session_status() == PHP_SESSION_NONE) {
       session_start();
    }
    if (isset($_SESSION['admin_name']))
    {
        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $type = $_POST['type'];
            $price = $_POST['price'];
            $status = $_POST['status'];
            $bedrooms = $_POST['bedroom'];
            $bathrooms = $_POST['bathroom'];
            $balcony = $_POST['balcony'];
            $area = $_POST['area'];
            $description = $_POST['description'];
            $image_1 = $_FILES['img1']['name'];
            $image_2 = $_FILES['img2']['name'];
            $image_3 = $_FILES['img3']['name'];
            $image_4 = $_FILES['img4']['name'];

            $tempname = $_FILES["img1"]["tmp_name"];
            $target_dir = "uploads/".$image_1;
            move_uploaded_file($tempname, $target_dir);

            $tempname = $_FILES["img2"]["tmp_name"];
            $target_dir = "uploads/".$image_2;
            move_uploaded_file($tempname, $target_dir);

            $tempname = $_FILES["img3"]["tmp_name"];
            $target_dir = "uploads/".$image_3;
            move_uploaded_file($tempname, $target_dir);

            $tempname = $_FILES["img4"]["tmp_name"];
            $target_dir = "uploads/".$image_4;
            move_uploaded_file($tempname, $target_dir);
            // move_uploaded_file($_FILES['img2']['tmp_name'], $target_dir . $image_2);
            // move_uploaded_file($_FILES['img3']['tmp_name'], $target_dir . $image_3);
            // move_uploaded_file($_FILES['img4']['tmp_name'], $target_dir . $image_4);

            //insert property details to database
            $sql = "insert into property (name, address, type, price, status, bedroom, bathroom, balcony, area, description, img1, img2, img3, img4) values
            ('$name', '$address', '$type', '$price', '$status', '$bedrooms', '$bathrooms', '$balcony', '$area', '$description', '$image_1', '$image_2', '$image_3', '$image_4')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                header("location: property.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
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
                    <div><h1>Add Property Form</h1></div>
                </div>
                <div class="info">
                    <table cellpadding="10px" class="input">
                    <form method="POST" enctype="multipart/form-data">
                        <tr>
                            <th>Property Name:</th>
                            <td><input type="text" name="name" placeholder="Enter property name" required></td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td><input type="text" name="address" placeholder="Enter adddress" required></td>
                        </tr>
                        <tr>
                            <th>Property Type:</th>
                            <td>
                                <select name="type" required>
                                    <option value="house">house</option>
                                    <option value="apartment">apartment</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Price:</th>
                            <td><input type="number" name="price" placeholder="Enter price" required></td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <select name="status" required>
                                    <option value="available">available</option>
                                    <option value="rented">rented</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Bedrooms:</th>
                            <td><input type="number" name="bedroom" placeholder="Enter bedrooms number" required></td>
                        </tr>
                        <tr>
                            <th>Bathrooms:</th>
                            <td><input type="number" name="bathroom" placeholder="Enter bathrooms number" required></td>
                        </tr>
                        <tr>
                            <th>Balcony:</th>
                            <td><input type="number" name="balcony" placeholder="Enter balcony number" required></td>
                        </tr>
                        <tr>
                            <th>Area (sqft):</th>
                            <td><input type="number" name="area" placeholder="Enter Area in sqft" required></td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td><input type="text" name="description" placeholder="Enter description" required></td>
                        </tr>
                        <tr>
                            <th>House:</th>
                            <td><input type="file" name="img1" required></td>
                        </tr>
                        <tr>
                            <th>Bedroom:</th>
                            <td><input type="file" name="img2" required></td>
                        </tr>
                        <tr>
                            <th>kitchen:</th>
                            <td><input type="file" name="img3" required></td>
                        </tr>
                        <tr>
                            <th>Bathroom:</th>
                            <td><input type="file" name="img4" required></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Add Property" name="submit" class="btn"></td>
                        </tr>
                    </form>
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