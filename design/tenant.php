<?php
include "header.php";

$uid = $_GET['uid'];
$pid = $_GET['pid'];

// Fetch the price of the property before processing the form
$result = mysqli_query($con, "SELECT price FROM property WHERE property_id = $pid");
$row = mysqli_fetch_assoc($result);
$price = $row['price'];

if (isset($_POST['tenant_reg'])) {
    $tenant_fname = $_POST['tenant_fname'];
    $tenant_email = $_POST['tenant_email'];
    $tenant_phone = $_POST['tenant_phone'];
    $tenant_address = $_POST['tenant_address'];
    $rent_months = $_POST['rent_months'];
    $tenant_in = $_POST['tenant_in'];
    $tenant_out = $_POST['tenant_out'];
    $total_rent = $price * $rent_months;

    $sql = "INSERT INTO tenant (user_id, property_id, fullname, email, number, address, rent_month, date_from, date_to, total_rent) 
            VALUES ('$uid', '$pid', '$tenant_fname', '$tenant_email', '$tenant_phone', '$tenant_address', '$rent_months', '$tenant_in', '$tenant_out', '$total_rent')";

   
    if (mysqli_query($con, $sql)) {
        $result = mysqli_query($con, "SELECT tenant_id FROM tenant WHERE property_id = $pid");
        $row = mysqli_fetch_assoc($result);
        $tid = $row['tenant_id'];
        header("Location: payment.php?tid=$tid");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
?>

<section class="form-container">
    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
        <h3>Confirm Booking</h3>
        <input type="text" name="tenant_fname" required maxlength="100" placeholder="Enter your fullname" class="box">
        <input type="email" name="tenant_email" required maxlength="50" placeholder="Enter your email" class="box">
        <input type="number" name="tenant_phone" required maxlength="10" placeholder="Enter your number" class="box">
        <input type="text" name="tenant_address" required maxlength="100" placeholder="Enter your address" class="box">

        <select id="rent_months" name="rent_months" required class="box">
            <option value="" disabled selected>Select Rent Duration (Months):</option>
            <option value="1">1 Month</option>
            <option value="2">2 Months</option>
            <option value="3">3 Months</option>
            <option value="6">6 Months</option>
            <option value="12">12 Months</option>
        </select>

        <div class="date-container">
            <label for="tenant_in">Date From :</label>
            <input type="date" id="tenant_in" name="tenant_in" class="date" readonly> <br>
            <label for="tenant_out">Date To :</label>
            <input type="date" id="tenant_out" name="tenant_out" class="date" readonly>
        </div>

        <!-- <div id="total_rent_container" style="display: none;">
            <p>Total Amount to Pay : <span id="total_rent">₹0</span></p>
        </div> -->
            <div class="date-container total">
                <h3 class="title">TOTAL RENT : </h3>
                <h3 class="title" id="total_rent">₹0</h3>
            </div>

        <input type="submit" value="Register now" name="tenant_reg" class="btn">
    </form>
</section>

<?php include "footer.php"; ?>

<script>
    // Get the input fields
    const tenantIn = document.getElementById('tenant_in');
    const rentMonths = document.getElementById('rent_months');
    const tenantOut = document.getElementById('tenant_out');
    const totalRentElement = document.getElementById('total_rent');
    const totalRentContainer = document.getElementById('total_rent_container');

    // PHP price passed into JavaScript
    const pricePerMonth = <?php echo isset($price) ? $price : 0; ?>;

    // Function to get today's date in YYYY-MM-DD format
    function getTodayDate() {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Add leading zero
        const day = String(today.getDate()).padStart(2, '0'); // Add leading zero
        return `${year}-${month}-${day}`;
    }

    // Automatically set the "Date From" field to today's date
    window.onload = function() {
        tenantIn.value = getTodayDate();
    };

    // Function to calculate the total rent based on selected months
    function calculateRent() {
        const inDate = new Date(tenantIn.value);
        const months = parseInt(rentMonths.value);

        if (tenantIn.value && months > 0) {
            // Calculate the end date by adding the selected months
            let endDate = new Date(inDate);
            endDate.setMonth(endDate.getMonth() + months);

            // Calculate total rent based on the number of months
            const totalRent = pricePerMonth * months;

            // Show result
            tenantOut.value = endDate.toISOString().split('T')[0]; // Set the "Date To" field
            totalRentElement.textContent = '₹' + totalRent.toLocaleString(); // Update total rent
            totalRentContainer.style.display = 'block'; // Show total rent container
        } else {
            tenantOut.value = ''; // Clear the "Date To" field
            totalRentElement.textContent = '₹0'; // Reset total rent
            totalRentContainer.style.display = 'none'; // Hide total rent container
        }
    }

    // Add event listeners to recalculate when the fields change
    tenantIn.addEventListener('change', calculateRent);
    rentMonths.addEventListener('change', calculateRent);
</script>
